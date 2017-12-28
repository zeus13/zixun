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
use Qiniu\Auth as qiniuAuth;
use Qiniu\Storage\BucketManager;
use Config;
use Redirect;
use DB;
use Log;
use Request;
use Exception;
use Session;
use App\Models\WeiXin;
use App\Models\ZiXun\Activity;
use App\Models\ZiXun\ActivityCategory;
use App\Models\ZiXun\ActivitySupplement;
use App\Models\ZiXun\ActivityImage;
use App\Models\ZiXun\VersionLog;
use App\Models\ZiXun\Category;
use App\Models\ZiXun\User;
use App\Models\ZiXun\Permission;
use App\Models\ZiXun\Role;
use App\Models\ZiXun\Supplement;
use App\Models\ZiXun\Ticket;
use App\Models\ZiXun\TicketType;

use Util;

class ZXController extends BaseController
{
    public function __construct()
    {

    }

    /**
     * [zx description]
     * @return [type] [description]
     */
    public function zx(){
        $jssdk = Util::jssdk(Request::getUri());
        Session::put('jssdk',$jssdk);
        return view('zx', []);
    }



    /**
     * [ajaxGetQiNiuToken 获取七牛token]
     * @return [type] [description]
     */
    public function ajaxGetQiNiuToken(){
        // 获取上传七牛的token和地址前缀
        $qiniuConfig = Config::get('filesystems.disks.qiniu');
        $auth = new qiniuAuth($qiniuConfig['access_key'], $qiniuConfig['secret_key']);
        $bucket = $qiniuConfig['bucket'];
        $token = $auth->uploadToken($bucket);
        $pre = 'http://'.$qiniuConfig['domains']['custom'].'/';
        $qiniu = array(
          'token' => $token,
          'pre' => $pre,
        );
        return $qiniu;
    }

    /**
     * [ajaxLoginByEmail 登录]
     * @return [type] [description]
     */
    public function ajaxLoginByEmail(){

        $email = trim(Request::input('email'));
        $password = trim(Request::input('password'));

        $user = User::where('isdelete',0)->where('account',$email)->firstOrFail();
        $token = $this->genToken();
        $user->token = $token;
        $user->save();

        $array = array(
            'token' => $token,
        );
        return $array;
    }

    /**
     * [ajaxGetUserInfo 获取用户信息]
     * @return [type] [description]
     */
    public function ajaxGetUserInfo(){

        $token = trim(Request::input('token'));

        $user = User::where('isdelete',0)->where('token',$token)->firstOrFail();

        $array = array(
            'uid' => $user['id'],
            'name' => $user['name'],
            'avatar' => $user['avatar'],
            'introduction' => $user['introduction'],
            'role' => $user['role'],
        );
        return $array;
    }

    /**
     * [ajaxLogout 登出]
     * @return [type] [description]
     */
    public function ajaxLogout(){
        return 'admin';
    }

    /**
     * [ajaxActivityIndex 活动列表]
     * @return [type] [description]
     */
    public function ajaxActivityIndex() {
        $activityList = Activity::where('isdelete',0)->orderBy('created_at','desc')->get();
        return $activityList;
    }

    /**
     * [ajaxActivityInfo 活动详情]
     * @return [type] [description]
     */
    public function ajaxActivityInfo(){
        $type = trim(Request::input('type'));
        $act_id = intval(Request::input('act_id'));
        switch ($type) {
            case 'commit':
                $activity = json_decode(Request::input('activity'),true);
                $name = !empty($activity['name']) ? trim($activity['name']) : '';
                $host = !empty($activity['host']) ? trim($activity['host']) : '';
                $time =!empty($activity['time']) ? trim($activity['time']) : '';
                $starttime = !empty($activity['starttime']) ? trim($activity['starttime']) : '';
                $endtime = !empty($activity['endtime']) ? trim($activity['endtime']) : '';
                $place = !empty($activity['place']) ? trim($activity['place']) : '';
                $join_notes = !empty($activity['join_notes']) ? ($activity['join_notes']) : '';
                $kindly_reminder = !empty($activity['kindly_reminder']) ? ($activity['kindly_reminder']) : '';
                $status = !empty($activity['status']) ? intval($activity['status']) : 0;
                $thumbnail = !empty($activity['thumbnail']) ? ($activity['thumbnail']) : [];
                $home_tips = !empty($activity['home_tips']) ? trim($activity['home_tips']) : '';
                $image = !empty($activity['image']) ? ($activity['image']) : [];
                $share_title = !empty($activity['share_title']) ? trim($activity['share_title']) : '';
                $share_text = !empty($activity['share_text']) ? trim($activity['share_text']) : '';
                $share_icon = !empty($activity['share_icon']) ? ($activity['share_icon']) : '';
                $activity_categorys = !empty($activity['activity_categorys']) ? ($activity['activity_categorys']) : [];
                $activity_supplements = !empty($activity['activity_supplements']) ? ($activity['activity_supplements']) : [];
                $is_limit = !empty($activity['is_limit']) ? ($activity['is_limit']) : 0;
                $limit_men = !empty($activity['limit_men']) ? ($activity['limit_men']) : 0;

                $activity = Activity::where('isdelete',0)->where('id',$act_id)->first();
                if(empty($activity)){
                  $activity = new Activity();
                }
                $activity->name = $name;
                $activity->host = $host;
                $activity->time = $time;
                $activity->name = $name;
                $activity->starttime = $starttime;
                $activity->endtime = $endtime;
                $activity->place = $place;
                $activity->join_notes = $join_notes;
                $activity->kindly_reminder = $kindly_reminder;
                $activity->status = $status;
                $activity->thumbnail = $thumbnail;
                $activity->home_tips = $home_tips;
                $activity->image = $image;
                $activity->share_title = $share_title;
                $activity->share_text = $share_text;
                $activity->share_icon = $share_icon;
                $activity->is_limit = $is_limit;
                $activity->limit_men = $limit_men;
                $activity->save();

                if ($activity['id'] > 0 && !empty($activity_categorys)) { // 分类保存
                  ActivityCategory::where('act_id',$activity['id'])->update(['isdelete'=>1]);
                  foreach ($activity_categorys as $key => $value) {
                    $activityCategory = ActivityCategory::where('act_id',$activity['id'])->where('name',$value['name'])->first();
                    if (empty($activityCategory)) {
                      $activityCategory = new ActivityCategory();
                    }
                    $activityCategory->isdelete = 0;
                    $activityCategory->act_id = $activity['id'];
                    $activityCategory->name = $value['name'];
                    $activityCategory->save();
                  }
                }

                if ($activity['id'] > 0 && !empty($activity_supplements)) { // 补充说明图标（如wifi等）
                  ActivitySupplement::where('act_id',$activity['id'])->update(['isdelete'=>1]);
                  foreach ($activity_supplements as $key => $value) {
                    $activitySupplement = ActivitySupplement::where('act_id',$activity['id'])->where('name',$value['name'])->first();
                    if (empty($activitySupplement)) {
                      $activitySupplement = new ActivitySupplement();
                    }
                    $activitySupplement->isdelete = 0;
                    $activitySupplement->act_id = $activity['id'];
                    $activitySupplement->name =$value['name'];
                    $activitySupplement->url = $value['url'];
                    $activitySupplement->save();
                  }
                }

                $data = array(
                  'act_id' => $activity['id'],
                );
                return Util::msg(200,'',$data);
                break;
            case 'online': // 上线

              Activity::where('isdelete',0)->where('id',$act_id)->update(['status' => 1]);
              return Util::msg(200,'');
              break;
            case 'finish': // 结束

              Activity::where('isdelete',0)->where('id',$act_id)->update(['status' => 2]);
              return Util::msg(200,'');
              break;
            case 'del': // 删除

              Activity::where('isdelete',0)->where('id',$act_id)->update(['isdelete' => 1]);
              return Util::msg(200,'');
              break;
            default:
                // 分类列表
                $categoryList = Category::where('isdelete',0)->get();
                // 活动补充图标（如有wifi，停车位等）
                $supplementList = Supplement::where('isdelete',0)->get();
                // 活动信息
                $activity = Activity::with([
                  'activitySupplements' => function($query){
                    $query->where('isdelete',0);
                  },
                  'activityCategorys' => function($query){
                    $query->where('isdelete',0);
                  },
                  ])->where('isdelete',0)->where('id',$act_id)->first();

                $data = array(
                  'categoryList' => $categoryList,
                  'supplementList' => $supplementList,
                  'activity' => $activity,
                );
                return Util::msg(200,'',$data);
                break;
        }
    }

    /**
     * [ajaxActivitySupplement 补充类型（如wifi，免费停车图标等）]
     * @return [type] [description]
     */
    public function ajaxActivitySupplement(){
      $type = trim(Request::input('type'));

      switch ($type) {
        case 'commit': // 新增或修改
          $supplement = json_decode(Request::input('supplement'),true);

          if ($supplement['id'] > 0) {
            Supplement::where('id',$supplement['id'])->update([
              'name' => $supplement['name'],
              'url' => $supplement['url'],
            ]);
          } else {
            Supplement::insert([
              'name' => $supplement['name'],
              'url' => $supplement['url'],
            ]);
          }

          return Util::msg(200,'');
          break;
        case 'del': // 删除
          $sup_id = intval(Request::input('sup_id'));
          Supplement::where('id',$sup_id)->update([
            'isdelete' =>1,
          ]);
          
          return Util::msg(200,'');
          break;
        default:
          $supplementList = Supplement::where('isdelete',0)->get();

          $data = array(
            'supplementList' => $supplementList,
          );
          return Util::msg(200,'',$data);
          break;
      }
    }

    /**
     * [ajaxActivityTicket 门票详情]
     * @return [type] [description]
     */
    public function ajaxActivityTicket(){
      $type = trim(Request::input('type'));

      $act_id = intval(Request::input('act_id'));
      switch ($type) {
        case 'commit':
          $act_id = intval(Request::input('act_id'));
          $ticketType = json_decode(Request::input('ticketType'),true);

          $activity = Activity::where('isdelete',0)->where('id',$act_id)->select('starttime','endtime')->first();
          if ($ticketType['id'] > 0) {
            $t = TicketType::where('act_id',$act_id)->where('id',$ticketType['id'])->first();
          } else {
            $t = new TicketType();
          }
          $t->act_id = $act_id;
          $t->name = $ticketType['name'];
          $t->price = $ticketType['price'];
          $t->rule = $ticketType['rule'];
          $t->is_homebuy = $ticketType['is_homebuy'];
          $t->homebuy_num = $ticketType['homebuy_num'];
          $t->is_seat_selection = $ticketType['is_seat_selection'];
          $t->is_give = $ticketType['is_give'];
          $t->is_through_ticket = $ticketType['is_through_ticket'];
          $t->rest = $ticketType['rest'];
          $t->starttime = $activity['starttime'];
          $t->endtime = $activity['endtime'];
          $t->save();

          $data = array(
            'ticktype_id' => $t['id'],
          );
          return Util::msg(200,'',$data);
          break;
        case 'del': // 删除
          $act_id = intval(Request::input('act_id'));
          $ticketType = json_decode(Request::input('ticketType'),true);

          TicketType::where('act_id',$act_id)->where('id',$ticketType['id'])->update([
            'isdelete' =>1,
          ]);
          
          return Util::msg(200,'');
          break;
        default:
          $ticketTypeList = TicketType::where('isdelete',0)->where('act_id',$act_id)->get();

          $data = array(
            'ticketTypeList' => $ticketTypeList,
          );
          return Util::msg(200,'',$data);
          break;
      }
    }

    /**
     * [ajaxActivityImage 图库]
     * @return [type] [description]
     */
    public function ajaxActivityImage(){

      $type = trim(Request::input('type'));

      $act_id = intval(Request::input('act_id'));
      switch ($type) {
        case 'commit':
          $content = Request::input('content');

          Activity::where('isdelete',0)->where('id',$act_id)->update(['detail'=>$content]);
          
          return Util::msg(200,'');
          break;
        case 'add':
          $image = json_decode(Request::input('image'),true);

          $activityImage = new ActivityImage();
          $activityImage->act_id = $image['act_id'];
          $activityImage->name = $image['name'];
          $activityImage->url = $image['url'];
          $activityImage->save();

          $data = array(
            'image_id' => $activityImage['id'],
          );
          return Util::msg(200,'',$data);
          break;
        case 'del': // 删除
          $image = json_decode(Request::input('image'),true);
          ActivityImage::where('isdelete',0)->where('id',$image['id'])->update(['isdelete'=>1]);
          
          return Util::msg(200,'');
          break;
        default:
          $activity = Activity::where('isdelete',0)->where('id',$act_id)->select('detail')->first();
          $activityImageList = ActivityImage::where('isdelete',0)->where('act_id',$act_id)->get();

          $data = array(
            'detail' => $activity['detail'],
            'activityImageList' => $activityImageList,
          );
          return Util::msg(200,'',$data);
          break;
      }
    }

    /**
     * [ajaxVersionIndex 版本]
     * @return [type] [description]
     */
    public function ajaxVersionIndex(){
      $type = trim(Request::input('type'));
      $version = json_decode(Request::input('version'),true);
      switch ($type) {
        case 'commit':
          $versionLog = VersionLog::where('isdelete',0)->where('id',$version['id'])->first();
          if (empty($versionLog)) {
            $versionLog = new VersionLog();
          }
          $versionLog->major = $version['major'];
          $versionLog->minor = $version['minor'];
          $versionLog->content = $version['content'];
          $versionLog->time = strtotime($version['time']);
          $versionLog->save();
          
          $data = array(
            'ver_id' => $versionLog['id'],
          );
          return Util::msg(200,'',$data);
          break;
        case 'del': // 删除
          VersionLog::where('isdelete',0)->where('id',$version['id'])->update(['isdelete'=>1]);
          
          return Util::msg(200,'');
          break;
        default:
          $versionLogList = VersionLog::where('isdelete',0)->orderBy('time','asc')->get();

          $data = array(
            'versionLogList' => $versionLogList,
          );
          return Util::msg(200,'',$data);
          break;
      }

    }

    /**
     * [genToken 获取token]
     * @param  integer $len [description]
     * @param  boolean $md5 [description]
     * @return [type]       [description]
     */
    private function genToken( $len = 32, $md5 = true ) {  
        mt_srand( (double)microtime()*1000000 );  
        $chars = array(  
          'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',  
          'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',  
          '/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',  
          'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',  
          '?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',  
          '=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',  
          'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'  
        );  
        # Array indice friendly number of chars;  
        $numChars = count($chars) - 1; $token = '';  
        # Create random token at the specified length  
        for ( $i=0; $i<$len; $i++ )  
          $token .= $chars[ mt_rand(0, $numChars) ];  
        # Should token be run through md5?  
        if ( $md5 ) {  
          # Number of 32 char chunks  
          $chunks = ceil( strlen($token) / 32 ); $md5token = '';  
          # Run each chunk through md5  
          for ( $i=1; $i<=$chunks; $i++ )  
              $md5token .= md5( substr($token, $i * 32 - 32, 32) );  
          # Trim the token  
          $token = substr($md5token, 0, $len);  
        } return $token;  
    }

}
