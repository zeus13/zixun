<?php

namespace App\Listeners;

use App\Events\QiNiuEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Config;
use Qiniu\Auth as qiniuAuth;
use Qiniu\Storage\BucketManager;
use Session;
use Util;
use Log;
class QiNiuListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QiNiuEvent  $event
     * @return void
     */
    public function handle(QiNiuEvent $event)
    {
        $url = $event->url;
        $type = $event->type;
        if(empty($url)){
            return;
        }
        if($type === 1){ //聊天
            return $this->chat($url);
        }elseif($type === 2){ // 头像
            return $this->avatar($url);
        }else{
            return;
        }
    }

    /**
     * [avatar 获取头像url]
     * @param  [type] $mediaId [description]
     * @return [type]          [description]
     */
    private function avatar($url){
        $qiniuConfig = Config::get('base.qiniu');
        $openid = Session::get('openid');
        $key = $qiniuConfig['avatar_prefix'].$openid.'.jpg';
        
        return $this->upload($key,$url);
    }

    /**
     * [chat 获取图片url]
     * @param  [type] $mediaId [description]
     * @return [type]          [description]
     */
    private function chat($mediaId){
        $boolean = starts_with($mediaId,'http://') || starts_with($mediaId,'https://');
        if(!$boolean){ // 为mediaid
            $token = Util::app()->access_token->getToken();
            $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$mediaId;
        }else{ // 直接为url地址
            $url = $mediaId;
        }
        $qiniuConfig = Config::get('base.qiniu');
        $random = Util::generate_password(8);
        $key = $qiniuConfig['chat_prefix'].$random.time().'.jpg';

        return $this->upload($key,$url);
    }

    /**
     * [upload 上传图片到七牛]
     * @param  [type] $prefix [description]
     * @param  [type] $url    [description]
     * @return [type]         [description]
     */
    private function upload($key,$url){
        $qiniuConfig = Config::get('base.qiniu');
        $auth = new qiniuAuth($qiniuConfig['access_key'], $qiniuConfig['secret_key']);
        $bucketMgr = new BucketManager($auth);
        
        $bucket = $qiniuConfig['bucket'];
        list($ret, $err) = $bucketMgr->fetch($url,$bucket,$key);
        if ($err !== null) { // todo 出现问题，这里得处理下
            return;
        }
        $img = 'http://'.$qiniuConfig['domains']['custom'].'/'.$key;
        return $img;
    }
}
