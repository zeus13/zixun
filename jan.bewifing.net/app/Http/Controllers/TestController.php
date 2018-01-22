<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use EasyWeChat;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order as EasyWeChatOrder;
use EasyWeChat\Message\Raw;
use EasyWeChat\Message\Transfer;
use EasyWeChat\Message\Image;
use EasyWeChat\Message\Text;
use Session;
use Config;
use DB;
use Request;
use Redirect;
use Storage;
use Cache;
use Redis;
use Log;
use Exception;
use View;
use Event;
use URL;
use Util;
class TestController extends BaseController
{

    const CFG = array(
        'appKey' => '3935e7c26430410684acf28aa24331ad',
        'appSecret' => '60e472fb866c84e9b2a4a3cd8dc403a3',
        'deviceSerial' => '106330831', // 设备序列号
        'validateCode' => 'MIZBHE' // 设备验证码，设备机身上的六位大写字母
       );

    public function __construct()
    {
    }

    /**
     * [test]
     * @return [type] [description]
     */
    public function test () {
        $url = 'https://open.ys7.com/api/lapp/token/get';
        // $token = md5(strtotime(date('Y-m-d',time())));
        
        $params = array(
            'appKey' => self::CFG['appKey'],
            'appSecret' => self::CFG['appSecret'],
        );
        $result = Util::makeRequest($url, $params);
        dd($result);
    }


    public function clean(){
        echo '清除前'.Session::get('openid');
        Session::flush();
        Session::forget('openid');
        echo '清除后'.Session::get('openid');
        echo "<h1>清除成功</h1>";
    }
}
