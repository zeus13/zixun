import {
  INIT_TIME,
  RECORD_TIME,
  INIT_SHOP,
  RECORD_SHOP,
  INIT_BUYCART,
  ADD_BUYCART,
  REDUCE_BUYCART,
  CLEAR_BUYCART,
  ADD_ORDER,
  SAVE_SHOPID,
  INIT_ORDER,
  SAVE_ORDER,
  CLEAR_ORDER
} from './mutation-types.js'

import {
  setStore,
  getStore
} from '../config/mUtils'

import { isEmpty } from '@/components/common/utils'

export default {
  // 初始化时间（清缓存）
  [INIT_TIME] (state) {
    let initCart = parseInt(getStore('timestamp'))
    let nowTime = parseInt((new Date().getTime()) / 1000)
    let overTime = initCart + 60 * 15 // 当前过期时间为900秒
    if (!isEmpty(initCart) && initCart > 0 && overTime < nowTime) { // 过期，清缓存
      // 清空购物车
      setStore('buyCart', null)
      state.cartList = {}
      setStore('buyCart', state.cartList)
    }
  },
  // 更新时间
  [RECORD_TIME] (state) {
    let nowTime = parseInt((new Date().getTime()) / 1000)
    setStore('timestamp', nowTime)
  },
  // 初始化商店信息
  [INIT_SHOP] (state) {
    let shopInfo = getStore('shopInfo')
    if (shopInfo) {
      state.shop = JSON.parse(shopInfo)
    }
  },
  // 更新商店信息
  [RECORD_SHOP] (state, {
    shop
  }) {
    state.shop = {...shop}
    setStore('shopInfo', state.shop)
  },
  // 初始化购物车
  [INIT_BUYCART] (state) {
    let buyCart = getStore('buyCart')
    if (buyCart) {
      state.cartList = JSON.parse(buyCart)
    }
    console.log(buyCart)
  },
  // 加入购物车
  [ADD_BUYCART] (state, {
    goods
  }) {
    let cart = state.cartList
    let category = cart[goods.cat_id] = (cart[goods.cat_id] || {})
    if (category[goods.id]) {
      category[goods.id]['num']++
      category[goods.id]['sell_time'] = goods.sell_time
    } else {
      category[goods.id] = {
        'id': goods.id,
        'num': 1,
        'cat_id': goods.cat_id,
        'goods_name': goods.goods_name,
        'actual_price': parseFloat(goods.actual_price),
        'goods_spec': goods.goods_spec,
        'sell_time': goods.sell_time,
        'thumbnail': goods.thumbnail
      }
    }
    state.cartList = {...cart}
    console.log(state)
    console.log(state.cartList)
    // 存入localStorage
    setStore('buyCart', state.cartList)
  },
  // 移出购物车
  [REDUCE_BUYCART] (state, {
    goods
  }) {
    let cart = state.cartList
    let category = cart[goods.cat_id] = (cart[goods.cat_id] || {})
    if (category && category[goods.id]) {
      if (category[goods.id]['num'] > 0) {
        category[goods.id]['num']--
        if (category[goods.id]['num'] === 0) {
          category[goods.id]['sell_time'] = 0
        }
        state.cartList = {...cart}
        // 存入localStorage
        setStore('buyCart', state.cartList)
      } else {
        // 商品数量为0，则清空当前商品的信息
        category[goods.id] = null
      }
    }
  },
  // 清空当前商品的购物车信息
  [CLEAR_BUYCART] (state) {
    state.cartList = null
    state.cartList = {...state.cartList}
    setStore('buyCart', state)
  },
  // 保存商铺id
  [SAVE_SHOPID] (state, shopId) {
    state.shopId = shopId
  },
  // 加入订单
  [ADD_ORDER] (state, {
    goodses
  }) {
    let order = state.orderList
    let shop = order
    if (shop) {
    } else {
      shop = {
      }
    }
    state.orderList = {...order}
    // 存入localStorage
    setStore('initData', state.orderList)
  },

  // 初始化订单信息
  [INIT_ORDER] (state) {
    let orderInfo = getStore('orderInfo')
    if (orderInfo) {
      state.orderList = JSON.parse(orderInfo)
    }
  },
  // 保存订单信息
  [SAVE_ORDER] (state, {
    dispatch_type,
    remark
  }) {
    let orderList = state.orderList
    orderList = {
      'dispatch_type': dispatch_type,
      'remark': remark
    }
    state.orderList = {...orderList}
    // 存入localStorage
    setStore('orderInfo', state.orderList)
  },
  // 清空订单信息
  [CLEAR_ORDER] (state) {
    state.orderList = null
    state.orderList = {...state.orderList}
    setStore('orderInfo', state)
  }
}
