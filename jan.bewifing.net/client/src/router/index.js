import Vue from 'vue'
import Router from 'vue-router'
import NotFoundComponent from '@/page/notFoundComponent'

import oppoIndex from '@/page/oppo/oppoIndex'
import oppoSuccess from '@/page/oppo/oppoSuccess'
import oppoAppeal from '@/page/oppo/oppoAppeal'
import oppoAppealSuccess from '@/page/oppo/oppoAppealSuccess'
import oppoDayList from '@/page/oppo/oppoDayList'
import demotest from '@/page/oppo/demotest'
import oppoLogin from '@/page/oppo/Login'
import test from '@/page/oppo/test'

import boringIndex from '@/page/boring/boringIndex'
import boringDetail from '@/page/boring/boringDetail'
import boringBuyTicket from '@/page/boring/boringBuyTicket'
import boringPay from '@/page/boring/boringPay'
import boringUser from '@/page/boring/boringUser'
// import boringTicketDetail from '@/page/boring/boringTicketDetail'
import boringUserEdit from '@/page/boring/boringUserEdit'

import pinduoduoIndex from '@/page/pinduoduo/pinduoduoIndex'
import newgoods from '@/page/pinduoduo/pinduoduoNewGoods' // 新品
import pinduoduoSeckill from '@/page/pinduoduo/pinduoduoSeckill' // 秒杀
import pinduoduoClearance from '@/page/pinduoduo/pinduoduoClearance' // 清仓页面
import goodsDetail from '@/page/pinduoduo/goodsDetail' // 商品详情介绍页面
import pinduoduoUser from '@/page/pinduoduo/pinduoduoUser' // 个人中心
import pinduoduoService from '@/page/pinduoduo/pinduoduoService' // 客服
import address from '@/page/pinduoduo/address' // 收货地址
import test2 from '@/page/test2' // 测试
import test3 from '@/page/test3' // 测试
import test4 from '@/page/test4' // 测试
import test5 from '@/page/test5' // 测试

import zixunActivityIndex from '@/page/haowuliao/zixunActivityIndex' // 测试

Vue.use(Router)

export default new Router({
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
      // return { x: 0, y: 450 }
      // return 期望滚动到哪个的位置
  },

  routes: [
    {
      path: '*',
      component: NotFoundComponent
    },
    {
      name: 'oppoIndex',
      path: '/oppoIndex',
      component: oppoIndex
    },
    {
      name: 'oppoSuccess',
      path: '/oppoSuccess',
      component: oppoSuccess
    },
    {
      name: 'oppoAppeal',
      path: '/oppoAppeal',
      component: oppoAppeal
    },
    {
      name: 'oppoAppealSuccess',
      path: '/oppoAppealSuccess',
      component: oppoAppealSuccess
    },
    {
      name: 'oppoDayList',
      path: '/oppoDayList',
      component: oppoDayList
    },
    {
      name: 'demotest',
      path: '/demotest',
      component: demotest
    },
    {
      name: 'oppoLogin',
      path: '/oppoLogin',
      component: oppoLogin
    },
    {
      name: 'test',
      path: '/test',
      component: test
    },
    {
      name: 'boringIndex',
      path: '/boringIndex',
      component: boringIndex
    },
    {
      name: 'boringDetail',
      path: '/boringDetail',
      component: boringDetail
    },
    {
      name: 'boringBuyTicket',
      path: '/boringBuyTicket',
      component: boringBuyTicket
    },
    {
      name: 'boringPay',
      path: '/boringPay',
      component: boringPay
    },
    {
      name: 'boringUser',
      path: '/boringUser',
      component: boringUser
    },
    // {
    //   name: 'boringTicketDetail',
    //   path: '/boringTicketDetail',
    //   component: boringTicketDetail
    // }
    {
      name: 'boringUserEdit',
      path: '/boringUserEdit',
      component: boringUserEdit
    },
    {
      name: 'pinduoduoIndex',
      path: '/pinduoduoIndex',
      component: pinduoduoIndex
    },
    {
      name: 'newgoods',
      path: '/newgoods',
      component: newgoods
    },
    {
      name: 'pinduoduoSeckill',
      path: '/pinduoduoSeckill',
      component: pinduoduoSeckill
    },
    {
      name: 'pinduoduoClearance',
      path: '/pinduoduoClearance',
      component: pinduoduoClearance
    },
    {
      name: 'goodsDetail',
      path: '/goodsDetail',
      component: goodsDetail
    },
    {
      name: 'pinduoduoUser',
      path: '/pinduoduoUser',
      component: pinduoduoUser
    },
    {
      name: 'pinduoduoService',
      path: '/pinduoduoService',
      component: pinduoduoService
    },
    {
      name: 'address',
      path: '/address',
      component: address
    },
    { // 测试
      name: 'test2',
      path: '/test2',
      component: test2
    },
    { // 测试
      name: 'test3',
      path: '/test3',
      component: test3
    },
    { // 测试
      name: 'test4',
      path: '/test4',
      component: test4
    },
    { // 测试
      name: 'test5',
      path: '/test5',
      component: test5
    },
    {
      name: 'zixunActivityIndex', // 活动首页
      path: '/zixunActivityIndex',
      component: zixunActivityIndex
    },
  ]
})
