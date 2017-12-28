<?php
namespace App\Http\Middleware;

use Closure;
use Response;
use Request;
use Session;
use Log;
use URL;
use Cookie;
use App\Models\ZiXun\Member;
use App\Models\WeiXin;
class ZiXunMember
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
        $member = Member::where('isdelete',0)->where('openid',$openid)->first();
        if(empty($member)){
            $weixin = WeiXin::where('openid',$openid)->select('nickname','headimgurl')->first();
            $member = new Member();
            $member->openid = $openid;
            $member->name = $weixin['nickname'];
            $member->avatar = $weixin['headimgurl'];
            $member->save();
        }
        Session::put('zixun_member',$member);
        $zixun_member = Session::get('zixun_member');
        Log::info($zixun_member);
        return $next($request);
    }
}
