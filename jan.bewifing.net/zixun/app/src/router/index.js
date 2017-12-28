import { prefixUrl } from '@/utils/env'
import Vue from 'vue'
import Router from 'vue-router'
import zixunGuide from '@/views/zixunGuide'
import zixunActivityIndex from '@/views/zixunActivityIndex'
import zixunActivityInfo from '@/views/zixunActivityInfo'
import zixunSelectTicket from '@/views/zixunSelectTicket'
import zixunBuyTicket from '@/views/zixunBuyTicket'
import zixunUserHome from '@/views/zixunUserHome'
import zixunUserEdit from '@/views/zixunUserEdit'
import zixunAbout from '@/views/zixunAbout'
import zixunTicketInfo from '@/views/zixunTicketInfo'

Vue.use(Router)
export default new Router({
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
    // return { x: 0, y: 450 }
    // return 期望滚动到哪个的位置
  },
  routes: [
    {
      name: '导航',
      path: prefixUrl + '/zixunGuide',
      component: zixunGuide
    },
    {
      name: '主页',
      path: prefixUrl + '/zixunActivityIndex',
      component: zixunActivityIndex
    },
    {
      name: '活动详情', // 活动详情
      path: prefixUrl + '/zixunActivityInfo',
      component: zixunActivityInfo
    },
    {
      name: '购票', // 选票
      path: prefixUrl + '/zixunSelectTicket',
      component: zixunSelectTicket
    },
    {
      name: '购票确认', // 购票确认
      path: prefixUrl + '/zixunBuyTicket',
      component: zixunBuyTicket
    },
    {
      name: '票券信息', // 票券信息
      path: prefixUrl + '/zixunTicketInfo',
      component: zixunTicketInfo
    },
    {
      name: '个人中心', // 个人中心
      path: prefixUrl + '/zixunUserhome',
      component: zixunUserHome
    },
    {
      name: '编辑个人资料', // 个人中心
      path: prefixUrl + '/zixunUserEdit',
      component: zixunUserEdit
    },
    {
      name: '关于', // 关于我们
      path: prefixUrl + '/zixunAbout',
      component: zixunAbout
    }
  ]
})
