import Vue from 'vue';
import Router from 'vue-router';
const _import = require('./_import_' + process.env.NODE_ENV);
// in development env not use Lazy Loading,because Lazy Loading large page will cause webpack hot update too slow.so only in production use Lazy Loading

/* layout */
import Layout from '../views/layout/Layout';

import {prefixUrl} from '../utils/env.js'

/* login */
const Login = _import('login/index');

/* home 主页 */
const home = _import('home/index');

/* 系统管理 */
const addUser = _import('manage/addUser');
const userList = _import('manage/userList');
const permission = _import('manage/permission');
const password = _import('manage/password');

/* 商品管理 */
const goodsList = _import('goods/goodsList');
const goodsDetail = _import('goods/goodsDetail');

/* 订单管理 */
const orderList = _import('order/orderList');
const orderDetail = _import('order/orderDetail');

/* 会员管理 */
const businessList = _import('member/businessList');

/* 财务管理 */
const cashLog = _import('finance/cashLog');

/* error page */
const Err404 = _import('404');

/* demo page */
const Form = _import('page/form');
const Table = _import('table/index');

Vue.use(Router);

 /**
  * icon : the icon show in the sidebar
  * hidden : if `hidden:true` will not show in the sidebar
  * redirect : if `redirect:noredirect` will not redirct in the levelbar
  * noDropdown : if `noDropdown:true` will not has submenu in the sidebar
  * meta : `{ role: ['admin'] }`  will control the page role
  **/
export const constantRouterMap = [
  { path: prefixUrl + '/login', component: Login, hidden: true },
  { path: prefixUrl + '/404', component: Err404, hidden: true },
  {
    path: prefixUrl,
    component: Layout,
    redirect: prefixUrl + '/home',
    hidden: true,
  },
  {
    path: prefixUrl + '/home',
    component: Layout,
    redirect: prefixUrl + '/home',
    hidden: true,
    children: [{ path: prefixUrl + '/home', component: home }]
  }
]

export default new Router({
  mode: 'history', //后端支持可开
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
});

export const asyncRouterMap = [
  {
    path: prefixUrl,
    component: Layout,
    redirect: prefixUrl + '/home',
    name: '',
    icon: 'fa-home',
    noDropdown: true,
    children: [
      { path: 'home', component: home, name: '首页' },
    ]
  },
  {
    path: prefixUrl + '/goods',
    component: Layout,
    redirect: prefixUrl + '/goods/goodsList',
    name: '商品管理',
    icon: 'fa-bars',
    noDropdown: false,
    children: [
      { path: 'goodsDetail', component: goodsDetail, name: '商品详情', meta: { role: ['goods'] }, hidden: true },
      { path: 'newGoodsDetail', component: goodsDetail, name: '新建商品', meta: { role: ['goods'] }, hidden: false },
      { path: 'goodsList', component: goodsList, name: '查看所有商品', meta: { role: ['goods'] }, hidden: false },
    ]
  },
  // {
  //   path: prefixUrl + '/order',
  //   component: Layout,
  //   redirect: prefixUrl + '/order/orderList',
  //   name: '订单管理',
  //   icon: 'fa-bars',
  //   noDropdown: false,
  //   children: [
  //     { path: 'orderDetail', component: orderDetail, name: '订单详情', meta: { role: ['order'] }, hidden: true },
  //     { path: 'orderList', component: orderList, name: '订单列表', meta: { role: ['order'] }, hidden: false },
  //   ]
  // },
  {
    path: prefixUrl + '/member',
    component: Layout,
    redirect: prefixUrl + '/member/memberList',
    name: '会员管理',
    icon: 'fa-bars',
    noDropdown: false,
    children: [
      { path: 'businessList', component: businessList, name: '微商管理', meta: { role: ['memberList'] }, hidden: false },
      // { path: 'storeList', component: storeList, name: '查看所有堂主', meta: { role: ['storeList'] }, hidden: false },
      // { path: 'areaList', component: areaList, name: '查看所有区代', meta: { role: ['areaList'] }, hidden: false },
      // { path: 'cityList', component: cityList, name: '查看所有市代', meta: { role: ['cityList'] }, hidden: false },
      // { path: 'giveStoreList', component: giveStoreList, name: '升级赠送堂主', meta: { role: ['giveStoreList'] }, hidden: false },
    ]
  },
  {
    path: prefixUrl + '/finance',
    component: Layout,
    redirect: prefixUrl + '/finance/cashLog',
    name: '财务管理',
    icon: 'fa-bars',
    noDropdown: false,
    children: [
      { path: 'cashLog', component: cashLog, name: '提现记录', meta: { role: ['cashLog'] }, hidden: false },
      // { path: 'storeList', component: storeList, name: '查看所有堂主', meta: { role: ['storeList'] }, hidden: false },
      // { path: 'areaList', component: areaList, name: '查看所有区代', meta: { role: ['areaList'] }, hidden: false },
      // { path: 'cityList', component: cityList, name: '查看所有市代', meta: { role: ['cityList'] }, hidden: false },
      // { path: 'giveStoreList', component: giveStoreList, name: '升级赠送堂主', meta: { role: ['giveStoreList'] }, hidden: false },
    ]
  },
  {
    path: prefixUrl + '/manage',
    component: Layout,
    redirect: prefixUrl + '/manage/userList',
    name: '系统管理',
    icon: 'fa-user-circle-o',
    noDropdown: false,
    children: [
      { path: 'addUser', component: addUser, name: '添加用户', meta: { role: ['manage'] }, hidden: false },
      { path: 'userList', component: userList, name: '用户列表', meta: { role: ['manage'] } },
      { path: 'permission', component: permission, name: '设置权限', meta: { role: ['manage'] }, hidden: true },
      { path: 'password', component: password, name: '修改密码', meta: { role: ['manage'] }, hidden: true },
    ]
  },

  // {
  //   path: prefixUrl + '/example',
  //   component: Layout,
  //   redirect: prefixUrl + '/noredirect',
  //   name: 'Example',
  //   icon: 'zujian',
  //   children: [
  //     { path: prefixUrl + '/index', component: Form, name: 'Form', icon: 'zonghe' }
  //   ]
  // },

  // {
  //   path: prefixUrl + '/table',
  //   component: Layout,
  //   redirect: prefixUrl + '/table/index',
  //   name: 'Table',
  //   icon: 'tubiaoleixingzhengchang',
  //   noDropdown: true,
  //   children: [{ path: 'index', component: Table, name: 'Table', meta: { role: ['admin'] } }]
  // },

  { path: '*', redirect: prefixUrl + '/404', hidden: true }
];
