<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('wechat', 'WechatController@auth');
Route::any('menu', 'WechatController@menu');
Route::get('auth', 'WechatController@auth');
Route::get('tailorImg', 'WechatController@tailorPhoto');
Route::get('yule', 'WechatController@foolhappy');
Route::get('shake', 'ProjectController@shake');
Route::get('demo', 'ProjectController@demo');



Route::get('doc', 'ProjectController@doc');
Route::get('luckyDrawPages', 'ProjectController@luckyDrawPages');
Route::get('ajaxluckyDraw', 'ProjectController@ajaxluckyDraw');
Route::any('ajaxOppoIndex', 'ProjectController@ajaxOppoIndex');


Route::get('login', 'ProjectController@login'); // 后台登录
Route::get('admin', 'ProjectController@admin'); // 后台框架
Route::get('home', 'ProjectController@home'); // 主页
Route::get('dialGame', 'ProjectController@dialGame'); // 大转盘游戏
Route::get('guessGame', 'ProjectController@guessGame'); // 竞猜型游戏
Route::get('diglettGame', 'ProjectController@diglettGame'); // 打地鼠游戏
Route::get('shakeGame', 'ProjectController@shakeGame'); // 摇一摇游戏
Route::get('answerGame', 'ProjectController@answerGame'); // 答题游戏
Route::get('activityList', 'ProjectController@activityList'); // 活动列表
Route::get('test', 'ProjectController@test'); // 活动列表


// Route::get('oppoIndex', 'ProjectController@oppoIndex'); // oppo主页
Route::get('oppoLogin', 'oppoController@oppoIndex'); // oppo登录页面
Route::get('test', 'oppoController@test');
Route::any('ajaxOppoIndex', 'oppoController@ajaxOppoIndex'); // 主页获取奖金金额
Route::any('ajaxOppoLogin', 'oppoController@ajaxOppoLogin'); // oppo登陆验证
Route::any('ajaxOppoInput', 'oppoController@ajaxOppoInput'); // oppo录入串码
Route::any('ajaxOppoAppeal', 'oppoController@ajaxOppoAppeal'); // oppo申诉
Route::any('ajaxOppoDayList', 'oppoController@ajaxOppoDayList'); // oppo每日抽奖，串码列表
Route::any('ajaxOppoChouJiang', 'oppoController@ajaxOppoChouJiang'); // oppo每日抽奖，消耗串码
Route::any('ajaxOppoDayBouns', 'oppoController@ajaxOppoDayBouns'); // oppo每日奖金查询
Route::any('ajaxOppoSaveDayBonus', 'oppoController@ajaxOppoSaveDayBonus'); // 每日奖金结算


Route::get('boringIndex', 'BoringController@boringIndex'); // 好无聊周末平台主页
Route::get('boringDetail', 'BoringController@boringDetail'); // 详细页面
Route::get('boringBuyTicket', 'BoringController@boringBuyTicket'); // 购票页面
Route::get('boringPay', 'BoringController@boringPay'); // 支付界面
Route::get('boringUser', 'BoringController@boringUser'); // 用户界面



Route::any('redirect_wx', 'WechatController@redirect_wx'); // 南宁好无聊公众号微信授权 - 桥接
Route::any('wx', 'WechatController@wx'); // 获取微信基本信息 - 桥接

Route::any('authx', 'WechatController@authx'); // 南宁好无聊公众号微信授权

Route::get('pinduoduoIndex', 'PinduoduoController@pinduoduoIndex'); // 拼多多主页



Route::any('/api/mobile_gcw_vote', 'ZiXun\ZiXunController@mobile_gcw_vote'); // 根据队伍编号返回队伍数据
Route::any('/api/mobile_gcw_vote_p', 'ZiXun\ZiXunController@mobile_gcw_vote_p'); // 根据队伍编号返回队伍数据（jsonp）

// *********************************************************************************
// ***************************************资讯start*********************************
// *********************************************************************************
// =========================前端start===================
Route::group(['middleware' => ['web']], function () {
	Route::any('ajaxZixunCheckTicket', 'ZiXun\ZiXunController@ajaxZixunCheckTicket'); // 核对门票
});
Route::group(['middleware' => ['web','auth.openid','zixun.member']], function () {
	Route::any('/api/ajaxZixunGetJssdk', 'ZiXun\ZiXunController@ajaxZixunGetJssdk'); // 获取jssdk
	Route::any('/api/ajaxZixunActivityIndex', 'ZiXun\ZiXunController@ajaxZixunActivityIndex'); // 活动首页
	Route::any('/api/ajaxZixunActivityInfo', 'ZiXun\ZiXunController@ajaxZixunActivityInfo'); // 活动详情
	Route::any('/api/ajaxZixunActivityInfoMember', 'ZiXun\ZiXunController@ajaxZixunActivityInfoMember'); // 活动详情-参与人数
	Route::any('/api/ajaxZixunCreateOrder', 'ZiXun\ZiXunController@ajaxZixunCreateOrder'); // 生成订单
	Route::any('/api/ajaxZixunBuyTicket', 'ZiXun\ZiXunController@ajaxZixunBuyTicket'); // 购票
	Route::any('/api/ajaxZixunOrderList', 'ZiXun\ZiXunController@ajaxZixunOrderList'); // 订单列表
	Route::any('/api/ajaxZixunOrderInfo', 'ZiXun\ZiXunController@ajaxZixunOrderInfo'); // 订单详情
	Route::any('/api/ajaxZixunUserHome', 'ZiXun\ZiXunController@ajaxZixunUserHome'); // 个人信息
	Route::any('/api/ajaxZixunUserEdit', 'ZiXun\ZiXunController@ajaxZixunUserEdit'); // 个人信息编辑
	Route::any('/api/ajaxZixunTicketList', 'ZiXun\ZiXunController@ajaxZixunTicketList'); // 门票列表
	Route::any('/api/ajaxZixunTicketInfo', 'ZiXun\ZiXunController@ajaxZixunTicketInfo'); // 门票信息
	Route::any('/api/ajaxZixunActivityCommentList', 'ZiXun\ZiXunController@ajaxZixunActivityCommentList'); // 活动评论列表
	Route::any('/api/ajaxZixunActivityComment', 'ZiXun\ZiXunController@ajaxZixunActivityComment'); // 活动评论
	Route::any('/api/ajaxZixunActivityCommentFans', 'ZiXun\ZiXunController@ajaxZixunActivityCommentFans'); // 活动评论-点赞
	Route::any('/api/ajaxZixunAboutMe', 'ZiXun\ZiXunController@ajaxZixunAboutMe'); // 关于我们

	Route::get('app/zixun{name}', 'ZiXun\ZiXunController@zixun')->where('name', '[/A-Za-z]*[/\d]*'); // 登录界面，放最后面
});
// =========================前端end======================
// =========================后台start====================
Route::group(['middleware' => ['web']], function () {
	Route::any('/zx/ajaxGetQiNiuToken', 'ZiXun\ZXController@ajaxGetQiNiuToken'); // 获取七牛token
	// ======================登录模块==============================
	Route::any('/zx/ajaxLoginByEmail', 'ZiXun\ZXController@ajaxLoginByEmail'); // 登录
	Route::any('/zx/ajaxGetUserInfo', 'ZiXun\ZXController@ajaxGetUserInfo'); // 获取用户信息
	Route::any('/zx/ajaxLogout', 'ZiXun\ZXController@ajaxLogout'); // 登出
	// =====================活动模块===============================
	Route::any('/zx/ajaxActivityIndex', 'ZiXun\ZXController@ajaxActivityIndex'); // 活动列表
	Route::any('/zx/ajaxActivityInfo', 'ZiXun\ZXController@ajaxActivityInfo'); // 活动详情
	Route::any('/zx/ajaxActivitySupplement', 'ZiXun\ZXController@ajaxActivitySupplement'); // 补充类型（如wifi，免费停车图标等）
	Route::any('/zx/ajaxActivityTicket', 'ZiXun\ZXController@ajaxActivityTicket'); // 门票详情
	Route::any('/zx/ajaxActivityImage', 'ZiXun\ZXController@ajaxActivityImage'); // 图库
	// ======================版本模块==============================
	Route::any('/zx/ajaxVersionIndex', 'ZiXun\ZXController@ajaxVersionIndex'); // 版本


	Route::get('/zx/{name}', 'ZiXun\ZXController@zx')->where('name', '[/A-Za-z]*[/\d]*'); // 登录界面，放最后面
});