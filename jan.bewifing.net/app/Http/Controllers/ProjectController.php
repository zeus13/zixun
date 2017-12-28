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
class ProjectController extends BaseController
{

    public function __construct()
    {

    }

    /**
     * [demo]
     * @return [type] [description]
     */
    public function test(){
        return view('game/test');
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
        return view('oppo');
    }

    /**
     * [ajaxluckyDraw 抽奖]
     * @return [type] [description]
     */
    public function ajaxluckyDraw(){
       //概率算法,6个奖项
        $prize_arr = array(
            '0' => array('id'=>1,'prize'=>'一等奖','v'=>3),
            '1' => array('id'=>2,'prize'=>'二等奖','v'=>5),
            '2' => array('id'=>3,'prize'=>'三等奖','v'=>10),
            '3' => array('id'=>4,'prize'=>'未中奖','v'=>10),
        );
           
        //每个奖品的中奖几率,奖品ID作为数组下标
        foreach($prize_arr as $val){
            $item[$val['id']] = $val['v'];
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
            'id' => $prize_arr[$res-1]['id'],
            'prize' => $prize_arr[$res-1]['prize']
        );
        return json_encode($prizeInfo);
    }
    

    /**
     * [ajaxOppoIndex oppo首页]
     * @return [type] [description]
     */
    public function ajaxOppoIndex() {
        $user = DB::table('db_userinfo')->get();
        return json_encode($user);
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


    public function ajaxOppoLogin () {
      $tel = Request::input('tel');
      $pwd = Request::input('pwd');
      $check = DB::table('oppo_user')->where([
        'tel' => $tel,
        'pwd' => $pwd
      ])->first();
    //   return  json_encode($check);

      if ($check) {
        return '正确';
      }
      else {
        return '错误';
      }
    //   if ($check) {
    //     $msg['state'] = 1;
    //     return json_encode;
    //   }else {
    //       $msg['state']=2;
    //       return json_encode;
    //   }

    //   return json_encode($user);

    //   $tel = Request::input('tel');
    //   $pwd = Request::input('pwd');
    //   $check = DB::table('oppo_user')->where([
    //     'tel' => $tel,
    //     'pwd' => $pwd
    //   ])-> first();

    //   if($check) {
    //     $msg['state']= 1;
    //     return json_encode;
    //   } else {
    //     $msg['state']=2;
    //     return json_encode;
    //   }
    }
}