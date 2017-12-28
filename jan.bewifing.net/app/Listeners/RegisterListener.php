<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Util;
use App\Models\WeiXin;
use Config;
use DB;
use Log;
class RegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     * @param  RegisterEvent  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {

        $userinfo = $event->user;
        if(empty($userinfo)){
            return;
        }
        $openid = $userinfo['openid'];
        $weixin = WeiXin::where('openid',$openid)->first();
        
        // 更新七牛头像
        $now = time() - Config::get('base.avatar_update_time'); // 头像更新间隔时间
        if(empty($weixin) || (!empty($weixin) && $weixin->lasttime < $now)){
            $img = Util::upload_avatar($userinfo['headimgurl'],$openid);
            $lasttime = time();
        }else{
            $img = $weixin->avatar;
            $lasttime = $weixin->lasttime;
        }

        // 注册或更新微信信息
        if(isset($userinfo['subscribe']) && $userinfo['subscribe'] == 1){ // 关注进来
            // 注册
            $this->subscribe($userinfo,$img,$lasttime);
        }elseif(isset($userinfo['subscribe']) && $userinfo['subscribe'] == 0){ // 取消关注进来
            // 注册
            $this->unsubscribe($userinfo);
        }else{ // 授权进来
            // 注册
            $this->auth($userinfo,$img,$lasttime);
        }
    }

    protected function subscribe($userinfo,$img,$lasttime){
        try {
            WeiXin::updateOrCreate(array('openid' => $userinfo['openid']), array(
                'subscribe' => $userinfo['subscribe'],
                'nickname' => $userinfo['nickname'],
                'sex' => $userinfo['sex'],
                'city' => $userinfo['city'],
                'province' => $userinfo['province'],
                'country' => $userinfo['country'],
                'headimgurl' => $userinfo['headimgurl'],
                'subscribe_time' => $userinfo['subscribe_time'],
                'avatar' => $img,
                'lasttime' => $lasttime,
                ));
        } catch (Exception $e){
            Log::debug($e);
            return Util::msg(500,'系统繁忙');
        }

    }

    protected function unsubscribe($userinfo){
        try {
            WeiXin::updateOrCreate(array('openid' => $userinfo['openid']), array(
                'subscribe' => $userinfo['subscribe'],
                ));;
        } catch (Exception $e){
            Log::debug($e);
            return Util::msg(500,'系统繁忙');
        }

    }

    protected function auth($userinfo,$img,$lasttime){
        try {
            WeiXin::updateOrCreate(array('openid' => $userinfo['openid']), array(
                'nickname' => $userinfo['nickname'],
                'sex' => $userinfo['sex'],
                'city' => $userinfo['city'],
                'province' => $userinfo['province'],
                'country' => $userinfo['country'],
                'headimgurl' => $userinfo['headimgurl'],
                'avatar' => $img,
                'lasttime' => $lasttime,
                ));
        } catch (Exception $e){
            Log::debug($e);
            return Util::msg(500,'系统繁忙');
        }
    }
}
