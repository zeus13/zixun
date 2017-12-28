<?php

namespace App\Http\Controllers\ZiXun;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Cache;
use EasyWeChat;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Notice\Notice;
use EasyWeChat\Message\Text;
use EasyWeChat\Payment\Order as EasyWeChatOrder;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Config;
use Redirect;
use DB;
use Log;
use Request;
use Exception;
use Session;
use App\Models\WeiXin;
use App\Models\ZiXun\Member;
use App\Models\ZiXun\Activity;
use App\Models\ZiXun\ActivityLog;
use App\Models\ZiXun\ActivityComment;
use App\Models\ZiXun\ActivityCommentFans;
use App\Models\ZiXun\ActivitySupplement;
use App\Models\ZiXun\ActivityCategory;
use App\Models\ZiXun\Order;
use App\Models\ZiXun\Ticket;
use App\Models\ZiXun\TicketLog;
use App\Models\ZiXun\TicketType;
use App\Models\ZiXun\VersionLog;
use App\Models\ZiXun\MemberComment;
use Util;
use Qcloud\Sms\SmsSingleSender;

class ZiXunController extends BaseController
{


    const ORDER_PREFIX = 'zx'; // 订单号前缀

    public function __construct()
    {

    }

    /**
     * [zixun description]
     * @return [type] [description]
     */
    public function zixun(){

        // $appid = 1400029234;
        // $appkey = "051ec8448cf7e400a456e319fedf4798";
        // $phoneNumber = 13617712121;
        // $templId = 17054;
        // $singleSender = new SmsSingleSender($appid, $appkey);
        // $params = array('1', '2', '3');
        // $result = $singleSender->sendWithParam("86", $phoneNumber, $templId, $params, "", "", "");

        // return $result;


        $jssdk = Util::jssdk(Request::getUri());
        Session::put('jssdk',$jssdk);
        return view('zixun', []);
    }

    /**
     * [ajaxZixunGetJssdk 获取前端Jssdk]
     * @return [type] [description]
     */
    public function ajaxZixunGetJssdk(){
        $data = array(
            'jssdk' => str_contains($_SERVER['HTTP_USER_AGENT'],'Android') ? (Util::jssdk($_SERVER['HTTP_REFERER'])) : (Session::get('jssdk')),
        );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunActivityIndex 活动首页]
     * @return [type] [description]
     */
    public function ajaxZixunActivityIndex(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $activityList = Activity::where('isdelete',0)->where('status','>',0)->orderByRaw("case when status = 1 then 1 when status = 2 then 2 ELSE 3 END")->orderBy('starttime','desc')->get();
        
        $shareArr = array(
            'share_title' => '周末去哪浪 | 拯救无聊指南',
            'share_text' => 'wdf，与其宅到发霉，不如和ta去浪',
            'share_icon' => 'http://bewifing.net/shareIcon.jpg?v=1'
        );

        $data = array(
            'activityList' => $activityList,
            'shareArr' => $shareArr,
        );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunActivityInfo 活动详情]
     * @return [type] [description]
     */
    public function ajaxZixunActivityInfo(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $act_id = intval(Request::input('act_id'));
        if(empty($act_id)){
            return Util::msg(400,'缺少必要的参数');
        }
        $activity = Activity::with([
            'activitySupplements' => function($query){
                $query->where('isdelete',0);
            },
            'activityCategorys' => function($query){
                $query->where('isdelete',0);
            },
            'ticketTypes' => function($query){
                $query->where('isdelete',0);
            },
            ])->where('isdelete',0)->where('id',$act_id)->first();
        $ticket = TicketType::with([
                    'ticket' => function($query){
                        $query->where('pay_status', 1)->select('ticktype_id');
                    },
                ])->where('isdelete',0)->where('act_id', $act_id)->get();
        // dd($ticket->toArray());
        if(empty($activity)){
            return Util::msg(500,'该活动不存在');
        }
        // 写活动浏览记录
        $activityLog = new ActivityLog();
        $activityLog->act_id = $activity['id'];
        $activityLog->mem_id = $member['id'];
        $activityLog->num = 1;
        $activityLog->ip = Request::ip();
        $activityLog->agent = Request::server('HTTP_USER_AGENT');
        $activityLog->save();

        $data = array(
            'activity' => $activity,
            'ticket' => $ticket
        );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunActivityInfoMember 活动详情-参与人数]
     * @return [type] [description]
     */
    public function ajaxZixunActivityInfoMember(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $act_id = intval(Request::input('act_id'));
        // $subscribe = WeiXin::where('openid',$openid)->first()->subscribe;
        $subscribe = WeiXin::where('openid',$openid)->first();
        $joinNum = Ticket::where('isdelete',0)->where('act_id',$act_id)->where('pay_status',1)->count();
        $ids = Ticket::where('isdelete',0)->where('act_id',$act_id)->where('pay_status',1)->orderBy('created_at','desc')->take(5)->pluck('mem_id');
        $avatarList = Member::where('isdelete',0)->whereIn('id',$ids)->pluck('avatar');

        $data = array(
            'joinNum' => $joinNum,
            'avatarList' => $avatarList,
            'subscribe' => $subscribe,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunCreateOrder 生成订单]
     * @return [type] [description]
     */
    public function ajaxZixunCreateOrder(){

        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }
        
        $ticktype_id = intval(Request::input('ticktype_id'));
        $num = intval(Request::input('num'));
        if(empty($ticktype_id) || empty($num)){
            return Util::msg(400,'缺少必要的参数');
        }

        $tel = trim(Request::input('tel'));

        DB::beginTransaction();
        try{
            $ticketType = TicketType::where('isdelete',0)->where('id',$ticktype_id)->first(); // 门票类型
            if(empty($ticketType)){
                $code = 500;
                $msg = '该门票类型不存在';
                $data = [];
                throw new Exception("TicketType Is Null", 1);
            }
            if($ticketType['is_limit_buy'] == 1){ // 门票有限，限购类型，进行判断
                $buy_num = Ticket::where('isdelete',0)->where('pay_status', 1)->where('act_id', $ticketType['act_id'])->where('ticktype_id',$ticktype_id)->count();
                if (($num + $buy_num) > $ticketType['limit_buy_num']){
                    $code = 500;
                    $msg = '该类型门票已售空';
                    $data = [];
                    throw new Exception("Ticket Is Homebuy", 1);
                }
            }
            if($ticketType['is_homebuy'] == 1){ // 门票每次只能购买一定数量，限购类型，进行判断
                $homebuy_num = Ticket::where('isdelete',0)->where('mem_id',$member['id'])->where('ticktype_id',$ticktype_id)->count();
                if (($num + $homebuy_num) > $ticketType['homebuy_num']){
                    $code = 500;
                    $msg = '该类型门票限购'.$ticketType['homebuy_num'].'张';
                    $data = [];
                    throw new Exception("Ticket Is Homebuy", 1);
                }
            }
            $activity = Activity::where('isdelete',0)->where('id',$ticketType['act_id'])->first(); // 活动信息
            if(empty($activity)){
                $code = 500;
                $msg = '该门活动不存在';
                $data = [];
                throw new Exception("Activity Is Null", 1);
            }
            if($activity['status'] == 2 || time() > $activity['endtime']){
                $code = 500;
                $msg = '活动已结束';
                $data = [];
                throw new Exception("Activity Is Null", 1);
            }

            // 生成订单号
            $prefix = self::ORDER_PREFIX;
            $random = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            $ordersn = $prefix.$random;
            
            // 生成门票码
            $tickeOrdersnMiddle = substr($random,4); 
            $codeArr = [];
            for ($i=1; $i <= $num; $i++) { 
                $tickeOrdersnPrefix = rand(100,999);
                if($i >= 1 && $i < 10){
                    $tickeOrdersnEnd = '00'.$i;
                }else if($i >= 10 && $i < 99){
                    $tickeOrdersnEnd = '0'.$i;
                }else{
                    $tickeOrdersnEnd = $i;
                }
                $rand =$tickeOrdersnPrefix.$tickeOrdersnMiddle.$tickeOrdersnEnd;
                array_push($codeArr,$rand);
            }

            // 生成门票价格
            $index = 0;
            $price = floatval($ticketType['price']);
            while(!empty($ticketType['discount'][$index])) {
                if ($num < $ticketType['discount'][$index]['amount']) {
                    $index = -1;
                } else {
                    $price = floatval($ticketType['price']) * round($ticketType['discount'][$index]['off'],2);
                    $index = $index + 1;
                }
            }
            $ticketType['price'] = $price;


            // 生成订单
            $total_price = floatval($ticketType['price']) * $num;
            $pay_status = $total_price > 0 ? 0 : 1; // 收费和免费
            $order = new Order();
            $order->isdelete = 0;
            $order->ordersn = $ordersn;
            $order->price = floatval($ticketType['price']);
            $order->num = $num;
            $order->total_price = $total_price;
            $order->pay_status = $pay_status;
            $order->pay_time = 0;
            $order->mem_id = $member['id'];
            $order->mem_name = $member['name'];
            $order->mem_tel = $tel;
            $order->act_id = $activity['id'];
            $order->act_name = $activity['name'];
            $order->act_place = $activity['place'];
            $order->act_time = $activity['time'];
            $order->ticktype_id = $ticketType['id'];
            $order->ticktype_name = $ticketType['name'];
            $order->save();
            // 生成门票
            foreach ($codeArr as $key => $value) {
                $ticket = new Ticket();
                $ticket->isdelete = 0;
                $ticket->code = $value;
                $ticket->mem_id = $member['id'];
                $ticket->ordersn = $ordersn;
                $ticket->pay_status = $pay_status;
                $ticket->price = floatval($ticketType['price']);
                $ticket->num = 1;
                $ticket->act_id = $activity['id'];
                $ticket->act_name = $activity['name'];
                $ticket->act_place = $activity['place'];
                $ticket->act_time = $activity['time'];
                $ticket->ticktype_id = $ticketType['id'];
                $ticket->ticktype_name = $ticketType['name'];
                $ticket->is_seat_selection = $ticketType['is_seat_selection'];
                $ticket->seat_selection = $ticketType['seat_selection'];
                $ticket->is_give = $ticketType['is_give'];
                $ticket->is_through_ticket = $ticketType['is_through_ticket'];
                $ticket->starttime = $ticketType['starttime'];
                $ticket->endtime = $ticketType['endtime'];
                $ticket->rule = $ticketType['rule'];
                $ticket->is_check = 0;
                $ticket->check_time = 0;
                $ticket->rest = $ticketType['rest'];
                $ticket->image = !empty($activity['image']) ? $activity['image'][0] : '';
                $ticket->thumbnail = !empty($activity['thumbnail']) ? $activity['thumbnail'][0] : '';
                $ticket->save();
            }

            $code = 200;
            $msg = '下单成功,请前往付款';
            $data = array(
                'ordersn' => $ordersn,
                'total_price' => $total_price,
            );
        }catch(Exception $e){
            Log::debug($e);
            DB::rollBack();
        }
        DB::commit();

        return Util::msg($code,$msg,$data);

    }

    /**
     * [ajaxZixunBuyTicket 购票]
     * @return [type] [description]
     */
    public function ajaxZixunBuyTicket(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $ordersn = trim(Request::input('ordersn'));
        if(empty($ordersn)){
            return Util::msg(400,'缺少必要的参数');
        }

        $order = Order::where('isdelete',0)->where('ordersn',$ordersn)->first();
        if(empty($order)){
            return Util::msg(500,'该订单不存在');
        }
        if($order['pay_status'] == 1){
            return Util::msg(500,'该订单已付款');
        }

        $temp = $order['act_name'].' '.$order['ticktype_name'].'*'.$order['num'];
        $body = $temp;
        $detail = $temp;
        $out_trade_no = $order['ordersn'];
        $total_fee = $order['total_price'] * 100;
        $notify_url = Config::get('wechat.payment.notify_url');
        $trade_type = 'JSAPI';
        // 创建支付订单
        $attributes = [
            'body' => $body,
            'detail' => $detail,
            'out_trade_no' => $out_trade_no,
            'total_fee' => $total_fee,
            'notify_url' => $notify_url, // 支付结果通知网址
            'trade_type' => $trade_type,
            'openid' => $openid,
        ];
        $easyWeChatOrder = new EasyWeChatOrder($attributes);
        // 统一下单
        $result = EasyWeChat::payment()->prepare($easyWeChatOrder);
        if($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            // $config = EasyWeChat::payment()->configForPayment($prepayId); // WeixinJSBridge
            $config = EasyWeChat::payment()->configForJSSDKPayment($prepayId); // JSSDK

            $data = array(
                'config' => $config,
                );
            return Util::msg(200,'支付成功',$data);
        }else{
            return Util::msg(500,'支付失败',$result);
        }
    }

    /**
     * [ajaxZixunOrderList 订单列表]
     * @return [type] [description]
     */
    public function ajaxZixunOrderList(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $type = trim(Request::input('type'));
        switch ($type) {
            case 'pay':
                $orderList = Order::where('isdelete',0)->where('mem_id',$member['id'])->where('pay_status',0)->get();
                break;
            default:
                $orderList = Order::where('isdelete',0)->where('mem_id',$member['id'])->get();
                break;
        }
        $data = array(
            'orderList' => $orderList,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunOrderInfo 订单详情]
     * @return [type] [description]
     */
    public function ajaxZixunOrderInfo(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $ordersn = trim(Request::input('ordersn'));
        if(empty($ordersn)){
            return Util::msg(400,'缺少必要的参数');
        }

        $order = Order::where('isdelete',0)->where('ordersn',$ordersn)->first();

        $data = array(
            'order' => $order,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunUserHome 个人信息]
     * @return [type] [description]
     */
    public function ajaxZixunUserHome(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        // $member = DB::table('zixun_member')->where('openid', $openid)->first();
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        // 浏览记录
        // $actIds = ActivityLog::where('isdelete',0)->where('mem_id',$member['id'])->orderBy('num','desc')->orderBy('updated_at','desc')->lists('act_id');

        $data = array(
            'member' => $member,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunUserEdit 个人信息编辑]
     * @return [type] [description]
     */
    public function ajaxZixunUserEdit(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');

        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $temp = json_decode(Request::input('member'));

        $member = Member::where('isdelete',0)->where('openid',$openid)->first();
        if (empty($member)) {
            $member = new Member;
        }
        $member->name = $temp->name;
        $member->tel = $temp->tel;
        $member->gender = $temp->gender;
        $member->save();

        return Util::msg(200,'保存成功');
    }

    /**
     * [ajaxZixunTicketList 门票列表]
     * @return [type] [description]
     */
    public function ajaxZixunTicketList(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        // 门票列表
        $now = time();
        $attendList = Ticket::where('isdelete',0)->where('mem_id',$member['id'])->where('endtime','>',$now)->orderBy('created_at','desc')->get(); // TODO ->where('pay_status',1)
        $allList = Ticket::where('isdelete',0)->where('mem_id',$member['id'])->orderBy('created_at','desc')->get(); // TODO ->where('pay_status',1)

        $data = array(
            'attendList' => $attendList,
            'allList' => $allList,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunTicketInfo 门票信息]
     * @return [type] [description]
     */
    public function ajaxZixunTicketInfo(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $code = trim(Request::input('code'));
        if(empty($code)){
            return Util::msg(400,'缺少必要的参数');
        }

        $now = time();
        $ticket = Ticket::where('isdelete',0)->where('code',$code)->first(); // TODO ->where('pay_status',1)
        if (empty($ticket)) {
            return Util::msg(500,'该门票不存在');
        }

        $data = array(
            'ticket' => $ticket,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunCheckTicket 核对门票]
     * @return [type] [description]
     */
    public function ajaxZixunCheckTicket(){

        $code = trim(Request::input('code'));
        if(empty($code)){
            return Util::msg(400,'缺少必要的参数');
        }

        $ticket = Ticket::where('isdelete',0)->where('code',$code)->first();
        if(empty($ticket)){
            return Util::msg(500,'该门票不存在');
        }
        if($ticket['pay_status'] == 0){
            return Util::msg(500,'该门票未付款');
        }
        if($ticket['rest'] <= 0){
            return Util::msg(500,'该门票次数已使用完');
        }
        if($ticket['is_through_ticket'] == 0 && $ticket['is_check'] == 1){ // 单次票已使用
            return Util::msg(500,'单次票已使用');
        }
        $date = date('Y-m-d');
        if($ticket['is_through_ticket'] == 1 && date('Y-m-d',$ticket['check_time']) == $date){ // 通票今日已使用
            return Util::msg(500,'通票今日已使用');
        }

        $ticket->is_check = 1;
        $temp = $ticket['rest'] - 1;
        $ticket->rest = $temp <= 0 ? 0 : $temp;
        $ticket->check_time = time();
        $ticket->save();
        // 写入日志
        $ticketLog = new TicketLog();
        $ticketLog->code = $code;
        $ticketLog->mem_id = $ticket['mem_id'];
        $ticketLog->ticktype_id = $ticket['ticktype_id'];
        $ticketLog->act_id = $ticket['act_id'];
        $ticketLog->save();
        $data = array(
            'ticket' => $ticket,
            );
        return Util::msg(200,'',$data);
    }

    /**
     * [ajaxZixunActivityCommentList 活动评论列表]
     * @return [type] [description]
     */
    public function ajaxZixunActivityCommentList(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $act_id = intval(Request::input('act_id'));
        if(empty($act_id)){
            return Util::msg(400,'缺少必要的参数');
        }

        $activityCommentList = ActivityComment::where('isdelete',0)->where('act_id',$act_id)->where('is_show',1)->orderBy('created_at','desc')->get();
        $cmtIdList = ActivityCommentFans::where('isdelete',0)->where('act_id',$act_id)->where('mem_id',$member['id'])->lists('cmt_id');
        $data = array(
            'activityCommentList' => $activityCommentList,
            'cmtIdList' => $cmtIdList,
            );
        return Util::msg(200,'',$data); 
    }

    /**
     * [ajaxZixunActivityComment 活动评论]
     * @return [type] [description]
     */
    public function ajaxZixunActivityComment(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $act_id = intval(Request::input('act_id'));
        if(empty($act_id)){
            return Util::msg(400,'缺少必要的参数');
        }
        
        $content = trim(Request::input('commentContent'));
        $evaluate = trim(Request::input('evaluate'));
        $imageArr = Request::input('imageArr');

        $activityComment = new ActivityComment();
        $activityComment->act_id = $act_id;
        $activityComment->mem_id = $member['id'];
        $activityComment->mem_name = $member['name'];
        $activityComment->mem_avatar = $member['avatar'];
        $activityComment->content = $content;
        $activityComment->fans = 0;
        $activityComment->is_show = 1;
        $activityComment->image = !empty($imageArr) ? $imageArr : [];
        $activityComment->save();

        return Util::msg(200,'提交成功'); 
    }

    /**
     * [ajaxZixunActivityCommentFans 活动评论-点赞]
     * @return [type] [description]
     */
    public function ajaxZixunActivityCommentFans(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $cmt_id = intval(Request::input('cmt_id'));
        if(empty($cmt_id)){
            return Util::msg(400,'缺少必要的参数');
        }
        $activityComment = ActivityComment::where('isdelete',0)->where('id',$cmt_id)->first();

        $fans = ActivityCommentFans::where('isdelete',0)->where('mem_id',$member['id'])->where('cmt_id',$cmt_id)->first();
        if (!empty($activityComment) && empty($fans)) {
            $fans = new ActivityCommentFans();
            $fans->mem_id = $member['id'];
            $fans->act_id = $activityComment['act_id'];
            $fans->cmt_id = $activityComment['id'];
            $fans->save();
            $activityComment->fans = $activityComment['fans'] + 1;
            $activityComment->save();
        }

        return Util::msg(200,'提交成功'); 
    }

    /**
     * [ajaxZixunAboutMe 关于我们]
     * @return [type] [description]
     */
    public function ajaxZixunAboutMe(){
        $openid = Session::get('openid');
        if(empty($openid)){
            throw new Exception("Openid Is Null", 1);
        }
        $member = Session::get('zixun_member');
        if(empty($member)){
            throw new Exception("Member Is Null", 1);
        }

        $type = trim(Request::input('type'));
        switch ($type) {
            case 'commit':
                # code...
                break;
            
            default:
                $versionLogList = VersionLog::where('isdelete',0)->orderBy('time','desc')->get();

                $data = array(
                    'versionLogList' => $versionLogList,
                );
                return Util::msg(200,'',$data); 
                break;
        }
    }
    
    /**
     * [mobile_gcw_vote 根据队伍编号返回队伍数据]
     * @return [type] [description]
     */
    public function mobile_gcw_vote(){
        header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问  
        header("Access-Control-Allow-Method:POST,GET"); 
        $number = intval(Request::input('number'));
        $vote_count = rand(1000, 9999);
        $result = array(
                  "status" => 1,
                  "number" => $number,
                  "vote_count" => $vote_count,
                  "number" => "获取票数成功"
                );
        return json_encode($result);
    }
    
    /**
     * [mobile_gcw_vote_p 根据队伍编号返回队伍数据（jsonp）]
     * @return [type] [description]
     */
    public function mobile_gcw_vote_p(){
        $number = intval(Request::input('number'));
        $vote_count = rand(1000, 9999);
        $result = array(
                  "status" => 1,
                  "number" => $number,
                  "vote_count" => $vote_count,
                  "number" => "获取票数成功"
                );
        return "successCallback(".json_encode(Util::msg(200, '不符合抽奖条件', $result)).")";
    }
}
