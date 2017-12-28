<?php 
namespace App\Services;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Notice\Notice;
use EasyWeChat;
use DB;
use Storage;
use Log;
use Session;
use Config;
use Qiniu\Auth as qiniuAuth;
use Qiniu\Storage\BucketManager;
class PublicUtil{
    
    public function __construct()
    {
    }
// ======================以下是微信通用的API方法==================

    /**
     * [app 微信应用实例]
     * @return [type] [description]
     */
    public function app() {

        $wechat = Config::get('base.wechat');
        if(empty($wechat['app_id']) || empty($wechat['secret']) ||empty($wechat['token'])) {
            return false;
        }
        $options = [
          'app_id'  => $wechat['app_id'],
          'secret'  => $wechat['secret'],
          'token'   => $wechat['token'],
          'aes_key' => $wechat['aes_key'],
          'oauth' => [
              'scopes'   => ['snsapi_userinfo'],
              'callback' => "authx",
          ]
        ];
        $app = new Application($options);
        return $app;
    }

    /**
     * [jssdk 微信js接口]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function jssdk($url=null) {
        $app=$this->app();
        if(!empty($url)){
          $app->js->setUrl($url);
        }
        // 获取微信分享jssdk
        $APIs = array('onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','hideMenuItems','showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','translateVoice','startRecord','stopRecord','onRecordEnd','playVoice','pauseVoice','stopVoice','uploadVoice','downloadVoice','chooseImage','previewImage','uploadImage','downloadImage','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu','closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard');
        $jssdk = $app->js->config($APIs, $debug = false, $beta = false, $json = true); 
        return $jssdk;
    }

// ======================以下是七牛通用的API方法===============
    /**
     * [upload_chat 上传图片到七牛]
     * @param  [type] $mediaId [description]
     * @return [type]          [description]
     */
    public function upload_chat($mediaId){
        if(empty($mediaId)){
            return false;
        }
        $token = $this->app()->access_token->getToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$mediaId;
        
        $qiniuConfig = Config::get('base.qiniu');
        $auth = new qiniuAuth($qiniuConfig['access_key'], $qiniuConfig['secret_key']);
        $bucketMgr = new BucketManager($auth);
        
        $bucket = $qiniuConfig['bucket'];
        $random = $this->generate_password(8);
        $key = $qiniuConfig['chat_prefix'].$random.time().'.jpg';
        list($ret, $err) = $bucketMgr->fetch( $url, $bucket, $key );
        if ($err !== null) {
            return false;
        }
        $img = 'http://'.$qiniuConfig['domains']['custom'].'/'.$key;
        return $img;
    }

    /**
     * [upload_avatar 上传头像到七牛]
     * @param  [type] $mediaId [description]
     * @return [type]          [description]
     */
    public function upload_avatar($url,$openid){
        if(empty($url) || empty($openid)){
            return false;
        }
        $qiniuConfig = Config::get('base.qiniu');
        $auth = new qiniuAuth($qiniuConfig['access_key'], $qiniuConfig['secret_key']);
        $bucketMgr = new BucketManager($auth);
        
        $bucket = $qiniuConfig['bucket'];
        $key = $qiniuConfig['avatar_prefix'].$openid.'.jpg';
        list($ret, $err) = $bucketMgr->fetch($url,$bucket,$key);
        if ($err !== null) {
            return false;
        }
        $img = 'http://'.$qiniuConfig['domains']['custom'].'/'.$key;
        return $img;
    }

    /**
     * [qiniu_token 获取七牛token]
     * @param  [type] $mediaId [description]
     * @return [type]          [description]
     */
    public function qiniu_token(){
        // 获取上传七牛的token和地址前缀
        $qiniuConfig = Config::get('base.qiniu');
        $auth = new qiniuAuth($qiniuConfig['access_key'], $qiniuConfig['secret_key']);
        $bucket = $qiniuConfig['bucket'];
        return $auth->uploadToken($bucket);
    }

    /**
     * [upload_ 上传各种图片到七牛]
     * @param  [type] $mediaId [description]
     * @return [type]          [description]
     */
    public function upload_image($mediaId,$type){
        if(empty($mediaId)){
            return false;
        }
        $token = $this->app()->access_token->getToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$mediaId;
        
        $qiniuConfig = Config::get('base.qiniu');
        $auth = new qiniuAuth($qiniuConfig['access_key'], $qiniuConfig['secret_key']);
        $bucketMgr = new BucketManager($auth);
        
        $bucket = $qiniuConfig['bucket'];
        $random = $this->generate_password(8);
        $key = $qiniuConfig[$type].$random.time().'.jpg';
        list($ret, $err) = $bucketMgr->fetch( $url, $bucket, $key );
        if ($err !== null) {
            return false;
        }
        $img = 'http://'.$qiniuConfig['domains']['custom'].'/'.$key;
        return $img;
    }


// ======================以下是各项目通用方法==================
    /**
     * [msg 返回数据]
     * @param  [type]  $code  [200：成功，203：非授权信息，400：错误请求，500：服务器错误]
     * @param  string  $msg   [description]
     * @param  [type]  $obj   [description]
     * @param  string  $url   [description]
     * @param  integer $count [description]
     * @return [type]         [description]
     */
    public function msg($code,$msg='',$obj=null,$url='',$count=0){
        $vars = array (
          'code' => $code,
          'msg' => $msg,
          'obj' => $obj,
          'url' => $url,
          'count' => $count,
          );
        return json_encode($vars);
    }

    /**
     * [transformTime 时间戳转换日期]
     * @param  [type] $time [时间戳]
     * @return [type]       [description]
     */
    public function transformTime($time) {

        $dtime = date("H:i",$time);
        $mtime = date("m-d H:i",$time);
        $ytime = date("Y-m-d H:i",$time);
        $ddtime = time() - strtotime(date("Y-m-d"));    //获取距离当天的时间戳差
        $dytime = time() - strtotime(date("Y-1"));    //获取距离当年的时间戳差
        $time = time() - $time;
        if($time < 60){
            $str = '刚刚';
        }
        elseif($time < 60 * 60){
            $min = floor($time/60);
            $str = $min.'分钟前';
        }
        elseif($time < $ddtime){
            $h = floor($time/(60*60));
            $str = $h.'小时前';
        }
        elseif($time < ($ddtime + 86400)){
            $str = '昨天 '.$dtime;
        }
        elseif($time < $dytime){
            $str = $mtime;
        }
        else{
            $str = $ytime;
        }
        return $str;
    }

    /**
     * [generate_password 随机字符]
     * @param  integer $length [description]
     * @return [type]          [description]
     */
    public function generate_password( $length = 32 ) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $password;
    }

    /**
     * [generate_password 纯数字]
     * @param  integer $length [description]
     * @return [type]          [description]
     */
    public function generate_number( $length = 6 ) {
        $chars = '0123456789';
        $password = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $password;
    }


// ======================以下是本项目用到的公共方法==================

}