import Vue from 'vue'
import App from './App'
import router from './router/'
import VueResource from 'vue-resource'
import './config/rem'
import store from './store/'
// import FastClick from 'fastclick'

Vue.config.productionTip = false
Vue.use(VueResource)

// router.beforeEach(() => {
//   FastClick.attach(document.body)
// })

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})
