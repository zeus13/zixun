// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
// import rem from './utils/rem.js'
import Vue from 'vue'
import FastClick from 'fastclick'
import Vuex from 'vuex'
import App from './App'
import './utils/rem'
import router from './router/'
// import { getNowJssdk } from './api/getData'
// import wx from 'weixin-js-sdk'

Vue.use(Vuex)

// 这里放了一个初始的数据源哦~可以通过像hellofromvux的组件里面那样改变，然后再通过这个里面的方法调用~~~
// const vuexStore = new Vuex.Store({
//   state: {
//     user_name: ''
//   },
//   mutations: {
//     showUserName (state) {
//       alert(state.user_name)
//     }
//   }
// })

router.beforeEach((to, from, next) => {
  document.title = to.name
  document.toname = from.name
  document.path = from.path
  next()
})

// 去掉点击的300延迟~
FastClick.attach(document.body)

Vue.config.productionTip = false

// Vue.prototype.wxShareFun = function (title = '度研美学美业商城上线了！', desc = '更多优质美容项目认准度研！', link = 'http://aimaspa.afxeon.net/app/goodsIndex', imgUrl = 'http://aimaspa.afxeon.net/headimg.jpg?v=1') {
//   // var encodelink = encodeURIComponent(link)
//   // 当前url
//   // const url = encodeURIComponent(location.href.split('#')[0])
//   // const url = encodeURIComponent(window.location.href.split('#')[0])
//   const url = encodeURIComponent(window.location.href.split('#')[0])
//   getNowJssdk(url).then(response => { // 获取jssdk
//     let result = response.data
//     if (result.code === 200) {
//       wx.config(result.obj.jssdk)
//     }
//   })
//   wx.ready(function () {
//     // 2.1 监听“分享给朋友”
//     wx.onMenuShareAppMessage({
//       title: title,
//       desc: desc,
//       link: link,
//       imgUrl: imgUrl,
//       trigger: function (res) {
//       },
//       success: function (res) {
//       },
//       cancel: function (res) {
//       },
//       fail: function (res) {
//       }
//     })
//     // 2.2 监听“分享到朋友圈”
//     wx.onMenuShareTimeline({
//       title: title,
//       desc: desc,
//       link: link,
//       imgUrl: imgUrl,
//       trigger: function (res) {
//       },
//       success: function (res) {
//       },
//       cancel: function (res) {
//       },
//       fail: function (res) {
//       }
//     })
//     // 2.3 监听“分享到QQ”
//     wx.onMenuShareQQ({
//       title: title,
//       desc: desc,
//       link: link,
//       imgUrl: imgUrl,
//       success: function (res) {
//       },
//       cancel: function (res) {
//       }
//     })
//     wx.hideMenuItems({
//       // 阅读模式 复制链接
//       menuList: ['menuItem:readMode', 'menuItem:copyUrl'],
//       success: function (res) {
//       },
//       fail: function (res) {
//       }
//     })
//   })
//   return wx
// }

/* eslint-disable no-new */
new Vue({
  router,
  render: h => h(App)
}).$mount('#app-box')
