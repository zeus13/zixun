import Vue from 'vue'
import Router from 'vue-router'
import zixunGuide from '@/page/zixunGuide'
import zixunActivityIndex from '@/page/zixunActivityIndex'
import zixunActivityInfo from '@/page/zixunActivityInfo'
import zixunSelectTicket from '@/page/zixunSelectTicket'
import zixunBuyTicket from '@/page/zixunBuyTicket'
import zixunVerifyTicket from '@/page/zixunVerifyTicket'
import zixunOrderList from '@/page/zixunOrderList'
import zixunOrderInfo from '@/page/zixunOrderInfo'
import zixunUserHome from '@/page/zixunUserHome'
import zixunUserEdit from '@/page/zixunUserEdit'
import zixunTicketList from '@/page/zixunTicketList'
import zixunTicketInfo from '@/page/zixunTicketInfo'
import zixunActivityCommentList from '@/page/zixunActivityCommentList'
import zixunAboutMe from '@/page/zixunAboutMe'
import zixunVersion from '@/page/zixunVersion'

Vue.use(Router)

export default new Router({
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
    // return { x: 0, y: 450 }
    // return 期望滚动到哪个的位置
  },
  routes: [
    {
      name: 'zixunGuide', // 向导
      path: '/zixunGuide',
      component: zixunGuide
    },
    {
      name: 'zixunActivityIndex', // 活动首页
      path: '/zixunActivityIndex',
      component: zixunActivityIndex
    },
    {
      name: 'zixunActivityInfo', // 活动详情
      path: '/zixunActivityInfo',
      component: zixunActivityInfo
    },
    {
      name: 'zixunSelectTicket', // 选票
      path: '/zixunSelectTicket',
      component: zixunSelectTicket
    },
    {
      name: 'zixunBuyTicket', // 购票
      path: '/zixunBuyTicket',
      component: zixunBuyTicket
    },
    {
      name: 'zixunVerifyTicket', // 验票
      path: '/zixunVerifyTicket',
      component: zixunVerifyTicket
    },
    {
      name: 'zixunOrderList', // 订单列表
      path: '/zixunOrderList',
      component: zixunOrderList
    },
    {
      name: 'zixunOrderInfo', // 订单详情
      path: '/zixunOrderInfo',
      component: zixunOrderInfo
    },
    {
      name: 'zixunUserHome', // 个人信息
      path: '/zixunUserHome',
      component: zixunUserHome
    },
    {
      name: 'zixunUserEdit', // 个人信息编辑
      path: '/zixunUserEdit',
      component: zixunUserEdit
    },
    {
      name: 'zixunTicketList', // 门票列表
      path: '/zixunTicketList',
      component: zixunTicketList
    },
    {
      name: 'zixunTicketInfo', // 门票信息
      path: '/zixunTicketInfo',
      component: zixunTicketInfo
    },
    {
      name: 'zixunActivityCommentList', // 评论列表
      path: '/zixunActivityCommentList',
      component: zixunActivityCommentList
    },
    {
      name: 'zixunAboutMe', // 关于我们
      path: '/zixunAboutMe',
      component: zixunAboutMe
    },
    {
      name: 'zixunVersion', // 版本维护
      path: '/zixunVersion',
      component: zixunVersion
    }
  ]
})
