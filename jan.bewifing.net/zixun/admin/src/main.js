// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import {prefixUrl} from './utils/env.js'
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import 'normalize.css/normalize.css'
// import '@/assets/iconfont/iconfont'
import '@/assets/font-awesome-4.7.0/less/font-awesome.less';
// import IconSvg from '@/components/Icon-svg/index.vue'
import IconAwesome from '@/components/Icon-awesome/index.vue'
import { getToken } from '@/utils/auth'

Vue.config.productionTip = false

Vue.use(ElementUI);
// Vue.component('icon-svg', IconSvg)
Vue.component('icon-awesome', IconAwesome)

const whiteList = [prefixUrl + '/login'];
router.beforeEach((to, from, next) => {
  NProgress.start();
  if (getToken()) {
    if (to.path === prefixUrl + '/login') {
      next({ path: prefixUrl + '/home' });
    } else {
      if (store.getters.roles.length === 0) {
        store.dispatch('GetUserInfo').then(res => {
          const roles = res.obj.role;
          store.dispatch('GenerateRoutes', { roles }).then(() => {
            router.addRoutes(store.getters.addRouters);
            next({ ...to });
          })
        })
      } else {
        next();
      }
    }
  } else {
    if (whiteList.indexOf(to.path) !== -1) {
      console.log('if')
      next()
    } else {
      console.log('else')
      next(prefixUrl + '/login');
      NProgress.done();
    }
  }
});

router.afterEach(() => {
  NProgress.done();
});

new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})
