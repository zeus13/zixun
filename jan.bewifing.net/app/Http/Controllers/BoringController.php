<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
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
use Util;
class BoringController extends BaseController
{

    public function __construct()
    {

    }

    public function boringIndex(){
        // $dd = strtotime(date("Y-m-d"));
        // dd($dd);
        // $todayStart = strtotime(date("Y-m-d",strtotime("-1 day")));
        // $todayEnd = strtotime(date("Y-m-d",strtotime("-1 day"))) + 86400;
        // $check = DB::table('oppo_input')->where('input_time','>',$todayStart)->where('input_time','<',$todayEnd)->get();
        // dd($check->toArray());
        return view('oppo');
    }

}