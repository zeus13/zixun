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
class OppoController extends BaseController
{

    public function __construct()
    {

    }

    /**
     * [demo]
     * @return [type] [description]
     */
    public function test(){
        // return view('game/test');
        return view('oppo');
    }
    /**
     * [demo]
     * @return [type] [description]
     */
    public function demo(){
        $did = intval(Request::input('did'));
        return view('demo/demo'.$did);
    }


    /**
     * [adminLTE 后台登录]
     * @return [type] [description]
     */
    public function shake(){
        return view('game/shake');
    }


    /**
     * [adminLTE 后台登录]
     * @return [type] [description]
     */
    public function login(){
        return view('adminLTE/login');
    }

    /**
     * [adminLTE 后台管理]
     * @return [type] [description]
     */
    public function admin(){
        return view('adminLTE/index');
    }

    /**
     * [adminLTE 主页]
     * @return [type] [description]
     */
    public function home(){
        return view('adminLTE/home');
    }

    /**
     * [adminLTE 大转盘游戏]
     * @return [type] [description]
     */
    public function dialGame(){
        return view('adminLTE/dialGame');
    }

    /**
     * [adminLTE 竞猜型游戏]
     * @return [type] [description]
     */
    public function guessGame(){
        return view('adminLTE/guessGame');
    }

    /**
     * [adminLTE 打地鼠游戏]
     * @return [type] [description]
     */
    public function diglettGame(){
        return view('adminLTE/diglettGame');
    }

    /**
     * [adminLTE 摇一摇游戏]
     * @return [type] [description]
     */
    public function shakeGame(){
        return view('adminLTE/shakeGame');
    }

    /**
     * [adminLTE 答题游戏]
     * @return [type] [description]
     */
    public function answerGame(){
        return view('adminLTE/answerGame');
    }

    /**
     * [adminLTE 活动列表]
     * @return [type] [description]
     */
    public function activityList(){
        return view('adminLTE/activityList');
    }


    public function foolhappy(){
        return view('foolhappy/index');
    }

    public function doc(){
        return view('foolhappy/doc');
    }

    public function tailorPhoto(){
        return view('tailorPhoto/index');
    }

    public function game1(){
        return view('game/index');
    }

    public function oppoIndex(){
        // $dd = strtotime(date("Y-m-d"));
        // dd($dd);
        // $todayStart = strtotime(date("Y-m-d",strtotime("-1 day")));
        // $todayEnd = strtotime(date("Y-m-d",strtotime("-1 day"))) + 86400;
        // $check = DB::table('oppo_input')->where('input_time','>',$todayStart)->where('input_time','<',$todayEnd)->get();
        // dd($check->toArray());
        return view('oppo');
    }

    /**
     * [ajaxOppoInputDayBonus 保存每日奖金]
     * @return [type] [description]
     */
     public function ajaxOppoSaveDayBonus () {
        $todayStart = strtotime(date('y-m-d'));
        $todayEnd = strtotime(date('y-m-d'))+ 86400;
        $check = DB::table('oppo_input')->where('input_time','>',$todayStart)->where('input_time','<',$todayEnd)->where('state', '0')->count();
        $bonus = $check * 2;
        DB::table('oppo_day_bonus')->insert(['date'=>time(), 'bonus'=> $bonus]);
        return Util::msg(200, '每日奖金已结算');
     }

    /**
     * [ajaxluckyDraw 抽奖]
     * @return [type] [description]
     */
    public function ajaxluckyDraw(){
       //概率算法,6个奖项
        $prize_arr = array(
            '0' => array('prize_id'=>1,'prize'=>'88元红包','v'=>3),
            '1' => array('prize_id'=>2,'prize'=>'字母符','v'=>5),
            '2' => array('prize_id'=>3,'prize'=>'未中奖','v'=>10),
        );
        //    $prize_arr = DB::table('oppo_prize')->get();
        //    dd($prize_arr);
        //每个奖品的中奖几率,奖品ID作为数组下标
        foreach($prize_arr as $val){
            $item[$val['prize_id']] = $val['v'];
            // dd($item[$val['prize_id']]);
        }
           
        function get($item){
            //中奖概率基数 
            $num = array_sum($item);//当前一等奖概率1/2000
           
            foreach($item as $k=>$v){
                //获取一个1到当前基数范围的随机数
                $rand = mt_rand(1,$num);
                if($rand <= $v){
                    //假设当前奖项$k=2,$v<=5才能中奖
                    $res = $k;
                    break;
                }else{
                    //假设当前奖项$k=6,$v>1900,则没中六等奖,总获奖基数2000-1900,前五次循环都没中则2000-1-5-10-24-60=1900,必中6等奖,哈哈
                    $num -= $v;
                }
            }
            return $res;
        }
           
        $res = get($item);

        $prizeInfo = array(
            'prize_id' => $prize_arr[$res-1]['prize_id'],
            'prize' => $prize_arr[$res-1]['prize']
        );
        return json_encode($prizeInfo);
        // return $prizeInfo;
    }
    



    /**
     * [ajaxDoctorApply 医生注册界面]
     * @return [type] [description]
     */
    public function ajaxDoctorApply() {

        $type = trim(Request::input('type'));
        $wid = WeiXin::id();

        $name = trim(Request::input('name'));
        $tel = trim(Request::input('tel'));
        $sex = trim(Request::input('sex'));
        $birth_time = trim(Request::input('birth_time'));
        $work_time = trim(Request::input('work_time'));
        $hid = intval(Request::input('hid'));
        $deid = intval(Request::input('deid'));
        $job = trim(Request::input('job'));

    }

    /**
     * [ajaxOppoIndex oppo首页]
     * @return [type] [description]
     */
    public function ajaxOppoIndex() {
        // $user = DB::table('db_userinfo')->get();
        // return json_encode($user);
        $tel = Session::get('tel');
        $todayStart = strtotime(date('y-m-d'));
        $todayEnd = strtotime(date('y-m-d'))+ 86400;
        $checkTel = DB::table('oppo_user')->where('tel', $tel)->first();
        // dd($checkTel);
        if ($checkTel) {
                $check = DB::table('oppo_input')->where('input_time','>',$todayStart)->where('input_time','<',$todayEnd)->where('state', '0')->count();
                $bonus = $check *2;
                $data = array(
                    'bonus' => $bonus
                );
                return Util::msg(200, '获取数据成功', $data);
        } else {
            return Util::msg(500, '没有登陆');
        }
    }
    
    /**
     * [ajaxOppoLogin 登陆]
     * @return [type] [description]
     */
    public function ajaxOppoLogin () {
      $tel = Request::input('tel');
      $pwd = Request::input('pwd');
      $check = DB::table('oppo_user')->where([
        'tel' => $tel,
        'pwd' => $pwd
      ])->first();
    //   return  json_encode($check);

      if ($check) {
        Session::put('tel',$tel);
        return Util::msg(200,'正确');
      }
      else {
        return Util::msg(500,'错误');
      }
    }

    //录入串码验证
    /**
     * [ajaxOppoInput 验证录入串码]
     * @return [type] [description]
     */
    public function ajaxOppoInput () {
        // $date = date("Y-m-d H:i:s", time()); // 直接要时间戳了，所以这里不需要了
        // $time = strtotime($date);
        // dd($time);
        $tel = Session::get('tel');
        // $tel = Request::input('tel'); // 测试没有tel参数进入此页面的情况
        $checkTel = DB::table('oppo_user')->where(['tel'=> $tel])->first();
        if ($checkTel == '' || !$checkTel) {
            return Util::msg(500,'请重新登陆');
        }
        // dd($tel);
        $chuanma = Request::input('chuanma');
        $check = DB::table('oppo_input')->where(['string_code'=> $chuanma])->first();
     
        if ($check || !$check == '') {
            return Util::msg(501,'已被录入过了');
        } else {
            $t = time();
            DB::table('oppo_input')->insert(['tel' => $tel, 'string_code' => $chuanma, 'input_time' => $t, 'state'=> '0']);
            return Util::msg(200,'成功被录入');
        }
    }

    /**
     * [ajaxOppoAppeal 申述]
     * @return [type] [description]
     */
    public function ajaxOppoAppeal () {
        $string_code = Request::input('string_code');
        $content = Request::input('content');
        $tel = Session::get('tel');
        $checkTel = DB::table('oppo_user')->where(['tel'=> $tel])->first();
        if ($checkTel == '' || !$checkTel) {
            return Util::msg(500,'请重新登陆');
        }else {
            DB::table('oppo_appeal')->insert(['tel'=>$tel, 'string_code'=> $string_code, 'content'=> $content]);
            return Util::msg(200,'已反馈');
        }
    }

    /**
     * [ajaxOppoDayList 串码列表]
     * @return [type] [description]
     */
    public function ajaxOppoDayList () {
        $tel = Session::get('tel');
        $checkTel = DB::table('oppo_user')->where(['tel'=>$tel])->first();
        if ($checkTel) {
            $check = DB::table('oppo_input')->where(['tel'=>$tel])->orderBy('input_time', 'desc')->get();
            $todayStart = strtotime(date('y-m-d'));
            $todayEnd = strtotime(date('y-m-d'))+ 86400;
            $check2 = DB::table('oppo_input')->where('input_time','>',$todayStart)->where('input_time','<',$todayEnd)->where('state', '0')->count();
            $bonus = $check2 * 2;
            $data = array(
                'check' => $check,
                'bonus' => $bonus
            );
            return Util::msg(200,'提交成功',$data);
        } else if($checkTel == '' || !$checkTel) {
            return Util::msg(500,'请重新登陆');
        }
    }

    /**
     * [ajaxOppoChouJiang 抽奖]
     * @return [type] [description]
     */
    public function ajaxOppoChouJiang () {
        $tel = Session::get('tel');
        // $string_code = Request::input('string_code');
        $checkTel = DB::table('oppo_user')->where(['tel'=>$tel])->first(); // 查询是否有这个手机号码

        if ($checkTel) {
            $check = DB::table('oppo_input')->where(['tel'=> $tel, 'state'=> '0' ])->orderBy('input_time')->first(); // 查询这条串码是否使用
            // dd($check);  
            if ($check) {
                $string_code = $check->string_code;
                // dd($check);
                $update = DB::table('oppo_input')->where(['tel'=>$tel, 'string_code'=>$string_code])->update(['state'=>1]);
                $prizeInfo = $this->ajaxluckyDraw();
                $b = json_decode($prizeInfo);
                $prize_name = $b->prize;
                $prize_id = $b->prize_id;
                // dd($b->prize. $b->prize_id);
                // $prize_name = '';
                // foreach ($b as $v) {
                //     # code...
                //     $prize_name = $v->prize;
                // }
                // dd($prizeInfo);
                $prize_cord = DB::table('oppo_prize_record')->insert(['tel'=>$tel, 'prize'=>$prize_name, 'prize_id'=>$prize_id, 'string_code'=>$string_code, 'time'=>time()]);
                $data = array (
                    'prize_name' => $prize_name,
                    'prize_id' => $prize_id
                );
                return Util::msg(201, '可以抽奖' ,$data);
            } else {
                return Util::msg(501, '该串码已使用');
            }
        } else if ($checkTel == '' || !$checkTel) {
            return Util::msg(500, '请重新登录');
        }
    }
    

}