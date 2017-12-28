<?php
namespace App\Http\Middleware;

use Closure;
use Response;
use Request;
use Session;
use Agent;
use Log;
use URL;
use Cookie;
class AuthOpenid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $openid = Session::get('openid');
        if(empty($openid)){
            $env = env('APP_ENV');
            if($env == 'local') { //本地测试
                $openid = env('APP_OPENID');
                Session::put('openid',$openid);
                $userinfo = array(
                    'openid' => $openid,
                    'nickname' => '王坚',
                    'headimgurl' => 'http://boringcdn.bewifing.net/wxheadimg/opxjft-WUN9Af5S15_Q-Nfj6guxU.jpg',
                );
                Session::put('user',$userinfo);
            }else{
                if(strpos(Agent::getUserAgent(), 'MicroMessenger') !== false){// 微信登录
                    // Session::put('target_url',Request::getUri());
                    // return redirect("authx");
                    $uri = Request::getUri();
                    Session::put('target_url', $uri);
                    return redirect('redirect_wx');
                }else{ // 电脑登陆
                    // $openid = env('APP_OPENID');
                    // Session::put('openid',$openid);
                    // Session::put('target_url',Request::getUri());
                    return Response::make('404');
                }
            }
        }
        return $next($request);
    }
}
