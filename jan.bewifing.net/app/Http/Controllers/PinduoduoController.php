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
class PinduoduoController extends BaseController
{

    public function __construct()
    {

    }

    public function pinduoduoIndex () {
        return view('oppo');
    }

}