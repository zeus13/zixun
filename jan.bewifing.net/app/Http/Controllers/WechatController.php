<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use EasyWeChat\Message\News;
use Cache;
use EasyWeChat;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Transfer;
use Session;
use Config;
use Log;
use DB;
use Event;
use Request;
use Redirect;
use App\Events\RegisterEvent;
use Util;
class WechatController extends BaseController
{
    /**
     * 建立一个新的 UserController 实例。
     */

    public function __construct()
    {
    }

    public function serve(){
        Log::info("1");
        EasyWeChat::server()->setMessageHandler(function($message){
            //$openId=$message->FromUserName;
            switch ($message->MsgType) {
                case 'event':

                Log::info("event");
                    // 当 $message->MsgType 为 event 时为事件
                    if ($message->MsgType == 'event') {
 
                        switch ($message->Event) {
                            case 'subscribe':

                             Log::info("subscribe");
                                // $userinfo = EasyWeChat::user()->get($openId);
                                // Wx_userinfo::saveuser($userinfo); 
                    

                                return "欢迎来到乐仔的小窝～\r\r这里你会发现很多好吃、好玩的美食攻略哟~";          
                                break;
                            case 'CLICK':
                                break;
                            case 'SCAN':
                                //  扫码关注
                                
                                return '扫码';

                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                    break;
                case 'text':

                        Log::info("text");
                    if ($message->Content=='更新菜单') {
                        return '更新成功';
                    }

                    if ($message->Content=='发红包') {
                        return '不发';
                    }
                    if ($message->Content=='验证码') {
                        $code = $this->generate_number(6);

                        return $code;
                    } 
                    break;

                case 'transfer':

                    break;
                case 'image':
                    //return json_encode($message);
                    break;
                case 'voice':
                    //return json_encode($message);
                    break;
                // ... 其它消息
                default:
                    break;
            }
            
        });
        return EasyWeChat::server()->serve();
    }

    private function generate_number( $length = 6 ) {
        $chars = '0123456789';
        $password = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $password;
    }

    // 微信菜单
    public function menu(){

        $newmenu =  array(

                    array('name'=>'乐仔首页','type'=>'view','url'=>'http://lezaigo.com/ci/foods/index4phone'),
                   
                    array('type'=>'view','name'=>'加入我们','url'=>'http://lezaigo.com/netbar/apply_netbar')
          
        );

        EasyWeChat::menu()->add($newmenu);
        //EasyWeChat::menu()->destroy();;
    }
    
    public function authx(){
        $oauth = Util::app()->oauth;
        $code = Request::input('code');
        if (empty($code)) {
            return $oauth->redirect();
        }
        $user = $oauth->user();

        if(empty($user['original'])){
            return $oauth->redirect();
        }
        Event::fire(new RegisterEvent($user['original']));
        Session::put('user',$user['original']);
        Session::put('openid',$user['original']['openid']);
        $targetUrl = Session::get('target_url');
        
        return Redirect::to($targetUrl, 301);
    }
    
    public function auth(){

        $options = [
          'app_id'  => 'wx8df2c09c26125419',
          'secret'  => 'd6040b9190f63ea7c7904df57132fe7d',
          'token'   => 'ki5rPFT9bEiM4TDK',
          'aes_key' => 'z0j9rYlMLiYIA1HnauIpnetNEJxQ7OQz0mRLASY7aRE'
        ];
        $app = new Application($options);
        // 从项目实例中得到服务端应用实例。
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            return "您好！欢迎关注我!";
        });
        $response = $server->serve();
        return $response->send(); 
        // $oauth = $app->oauth;

        // $code = Request::input('code');
        // if (empty($code)) {
        //     return $oauth->redirect();
        // }

        // $user = $oauth->user();
        // $temp = $user['original'];
        // if(empty($temp)){
        //     return $oauth->redirect();
        // }

        // $userinfo = array(
        //     'openid' => $temp['openid'],
        //     'nickname' => $temp['nickname'],
        //     'headimgurl' => $temp['headimgurl'],
        // );

        // //Wx_userinfo::saveuser($temp); 

        // Session::put('openid',$temp['openid']);
        // Session::put('userinfo',$userinfo);
          
        // $targetUrl = Session::get('target_url');

        // return Redirect::to($targetUrl, 301);
    }

    

    /**
     * [redirect_wx 获取微信code]
     * @return [type] [description]
     */
    public function redirect_wx(){
        $wechat = Config::get('wechat');
        $appid = $wechat['app_id']; // 授权的公众号
        
        $redirect_uri = urlencode("http://bewifing.net/soboring/wx");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        return redirect($url);//跳转到domain/articles/1
    }    

    /**
     * [wx 获取微信基本信息]
     * @return [type] [description]
     */
    public function wx(){
        $wechat = Config::get('wechat');
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
              'callback' => "auth",
          ]
        ];
        $app = new Application($options);
        $user = $app->oauth->user();
        $original = $user['original'];
        if(empty($original)){
            return redirect('redirect_wx');
        }
        Event::fire(new RegisterEvent($original));
        Session::put('openid',$original['openid']);

        $targetUrl = Session::get('target_url');
        return Redirect::to($targetUrl, 301);
    }
}
