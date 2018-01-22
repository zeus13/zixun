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
use App\Models\Token;
class YingShiController extends BaseController
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
     * [demo] 萤石云视频demo
     * @return [type] [description]
     */
    public function demo () {
        return view('videoDemo');
    }

    /**
     * [getAccessToken] 获取token http://open.ys7.com/doc/zh/book/index/address.html
     * @return [type] [description]
     */
    public function getAccessToken () {
        $tokenRow = Token::first();
        if (!empty($tokenRow) && $tokenRow['expireTime'] > time()) {
            return $tokenRow->accessToken;
        }
        if (empty($token)) {
            $tokenRow = new Token;
        }

        $url = 'https://open.ys7.com/api/lapp/token/get';

        $params = array(
            'appKey' => self::CFG['appKey'],
            'appSecret' => self::CFG['appSecret'],
        );

        $arrTemp1 = Util::makeRequest($url, $params);
        $arrTemp2 = json_decode($arrTemp1['result']);

        if ($arrTemp1['code'] == 200 && $arrTemp2->code == 200) {
            $accessToken = $arrTemp2->data->accessToken;
            $expireTime = $arrTemp2->data->expireTime;
            $tokenRow->accessToken = $accessToken;
            $tokenRow->expireTime = round($expireTime / 1000);
            $tokenRow->save();
            return $accessToken;
        }
        return '';
    }

    /**
     * [getVideoList] 获取用户下直播视频列表
     * @return [type] [description]
     */
    public function getVideoList () {
        $url = 'https://open.ys7.com/api/lapp/live/video/list';
        $accessToken = $this->getAccessToken();
        $params = array(
            'accessToken' => $accessToken,
        );
        $arrTemp1 = Util::makeRequest($url, $params);
        $arrTemp2 = json_decode($arrTemp1['result']);
        if ($arrTemp1['code'] == 200 && $arrTemp2->code == 200) {
            // dd($arrTemp2->data);
            return Util::msg($arrTemp2->code, $arrTemp2->msg, $arrTemp2->data);
        }
    }

    /**
     * [getVideoAddress] 获取指定有效期的直播地址
     * @return [type] [description]
     */
    public function getVideoAddress () {
        $url = 'https://open.ys7.com/api/lapp/live/address/limited';
        $accessToken = $this->getAccessToken();
        $params = array(
            'accessToken' => $accessToken,
            'deviceSerial' => self::CFG['deviceSerial'],
            'channelNo' => 1,
            'expireTime' => 86400,
        );
        $arrTemp1 = Util::makeRequest($url, $params);
        $arrTemp2 = json_decode($arrTemp1['result']);
        if ($arrTemp1['code'] == 200 && $arrTemp2->code == 200) {
            // dd($arrTemp2->data);
            return Util::msg($arrTemp2->code, $arrTemp2->msg, $arrTemp2->data);
        }
    }

    /**
     * [setVideoOpen] 开通直播功能
     * @return [type] [description]
     */
    public function setVideoOpen () {
        $url = 'https://open.ys7.com/api/lapp/live/video/open';
        $accessToken = $this->getAccessToken();
        $params = array(
            'accessToken' => $accessToken,
            'source' => self::CFG['deviceSerial'].':1', // 直播源，[设备序列号]:[通道号],[设备序列号]:[通道号]的形式，例如427734222:1,423344555:3，均采用英文符号
        );
        $arrTemp1 = Util::makeRequest($url, $params);
        $arrTemp2 = json_decode($arrTemp1['result']);
        if ($arrTemp1['code'] != 200) {
            return Util::msg(500, '网络出错');
        }
        return Util::msg($arrTemp2->code, $arrTemp2->msg, $arrTemp2->data);
    }

    /**
     * [setVideoClose] 关闭直播功能
     * @return [type] [description]
     */
    public function setVideoClose () {
        $url = 'https://open.ys7.com/api/lapp/live/video/close';
        $accessToken = $this->getAccessToken();
        $params = array(
            'accessToken' => $accessToken,
            'source' => self::CFG['deviceSerial'].':1', // 直播源，[设备序列号]:[通道号],[设备序列号]:[通道号]的形式，例如427734222:1,423344555:3，均采用英文符号
        );
        $arrTemp1 = Util::makeRequest($url, $params);
        $arrTemp2 = json_decode($arrTemp1['result']);
        if ($arrTemp1['code'] != 200) {
            return Util::msg(500, '网络出错');
        }
        return Util::msg($arrTemp2->code, $arrTemp2->msg, $arrTemp2->data);
    }

    public function clean(){
        echo '清除前'.Session::get('openid');
        Session::flush();
        Session::forget('openid');
        echo '清除后'.Session::get('openid');
        echo "<h1>清除成功</h1>";
    }
}
