import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './action'
import getters from './getters'

Vue.use(Vuex)

const state = {
  cartList: {}, // 加入购物车的商品列表
  shop: {}, // 商店信息
  orderList: {} // 订单列表
}

export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations
})
