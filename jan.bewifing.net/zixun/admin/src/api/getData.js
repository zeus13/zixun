import fetch from '@/utils/fetch';

import {prefixApi} from '../utils/env.js'

/**
 * [getQiNiuToken 获取七牛token]
 * @return {[type]}          [description]
 */
export function getQiNiuToken(account, password) {
  return fetch({
    url: prefixApi + '/getQiNiuToken',
    method: 'post',
    data: {
    }
  });
}

/**
 * [login 登录]
 * @param  {[type]} account    [账号]
 * @param  {[type]} password [密码]
 * @return {[type]}          [description]
 */
export function login(account, password) {
  return fetch({
    url: prefixApi + '/login',
    method: 'post',
    data: {
      account,
      password
    }
  });
}

/**
 * [getUserInfo 获取用户信息]
 * @param  {[type]} token [description]
 * @return {[type]}       [description]
 */
export function getUserInfo(token) {
  return fetch({
    url: prefixApi + '/getUserInfo',
    method: 'get',
    params: { token }
  });
}

/**
 * [logout 登出]
 * @return {[type]} [description]
 */
export function logout() {
  return fetch({
    url: prefixApi + '/logout',
    method: 'post'
  });
}

/**
 * [getUserList 获取用户列表]
 * @return {[type]} [description]
 */
export function getUserList() {
  return fetch({
    url: prefixApi + '/getUserList',
    method: 'post',
    params: {}
  });
}

/**
 * [getUserDetail 指定用户信息]
 * @return {[type]} [description]
 */
export function getUserDetail(userId) {
  return fetch({
    url: prefixApi + '/getUserDetail',
    method: 'post',
    params: { user_id: userId }
  });
}

/**
 * [getPermissionList 获取权限列表]
 * @return {[type]} [description]
 */
export function getPermissionList() {
  return fetch({
    url: prefixApi + '/getPermissionList',
    method: 'post'
  });
}

/**
 * [addUser 新增用户]
 * @return {[type]} [description]
 */
export function addUser(user) {
  return fetch({
    url: prefixApi + '/addUser',
    method: 'post',
    params: { user }
  });
}

/**
 * [updatePermit 更新权限]
 * @return {[type]} [description]
 */
export function updatePermit(user) {
  return fetch({
    url: prefixApi + '/updatePermit',
    method: 'post',
    params: { user }
  });
}

/**
 * [updatePassword 修改密码]
 * @return {[type]} [description]
 */
export function updatePassword(user) {
  return fetch({
    url: prefixApi + '/updatePassword',
    method: 'post',
    params: { user }
  });
}

/**
 * [delUser 删除用户]
 * @return {[type]} [description]
 */
export function delUser(user) {
  return fetch({
    url: prefixApi + '/delUser',
    method: 'post',
    params: { user }
  });
}

/**
 * [getAdminCategoryList 分类列表]
 * @return {[type]} [description]
 */
export function getAdminCategoryList() {
  return fetch({
    url: prefixApi + '/getAdminCategoryList',
    method: 'post',
    params: {}
  });
}

/**
 * [getAdminGoodsList 获取商品列表]
 * @return {[type]} [description]
 */
export function getAdminGoodsList(where, whereIn, orderBy, pageSize, page, time) {
  return fetch({
    url: prefixApi + '/getAdminGoodsList',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time}
  });
}

/**
 * [getAdminGoodsDetail 获取商品详情]
 * @return {[type]} [description]
 */
export function getAdminGoodsDetail(type, goodsId, goods) {
  return fetch({
    url: prefixApi + '/getAdminGoodsDetail',
    method: 'post',
    params: {type, goods_id: goodsId, goods}
  });
}

/**
 * [getAdminDispatchTypeList 快递公司列表]
 * @return {[type]} [description]
 */
export function getAdminDispatchTypeList() {
  return fetch({
    url: prefixApi + '/getAdminDispatchTypeList',
    method: 'post',
    params: {}
  });
}

/**
 * [getAdminOrderList 订单列表]
 * @return {[type]} [description]
 */
export function getAdminOrderList(where, whereIn, orderBy, pageSize, page, time) {
  return fetch({
    url: prefixApi + '/getAdminOrderList',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time}
  });
}

/**
 * [getAdminOrderDetail 订单详情]
 * @return {[type]} [description]
 */
export function getAdminOrderDetail(type, ordersn, object = null) {
  return fetch({
    url: prefixApi + '/getAdminOrderDetail',
    method: 'post',
    params: {type, ordersn, object}
  });
}

/**
 * [getAdminMemberList 会员列表]
 * @return {[type]} [description]
 */
export function getAdminMemberList(where, whereIn, orderBy, pageSize, page, time) {
  return fetch({
    url: prefixApi + '/getAdminMemberList',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time}
  });
}

/**
 * [getAdminBusinessList 微商列表]
 * @return {[type]} [description]
 */
export function getAdminBusinessList(where, whereIn, orderBy, pageSize, page, time) {
  return fetch({
    url: prefixApi + '/getAdminBusinessList',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time}
  });
}

/**
 * [getAdminMemberDetail 会员管理]
 * @return {[type]} [description]
 */
export function getAdminMemberDetail(type, memberId, object = null) {
  return fetch({
    url: prefixApi + '/getAdminMemberDetail',
    method: 'post',
    params: {type, member_id: memberId, object}
  });
}

/**
 * [getAdminBankList 银行列表]
 * @return {[type]} [description]
 */
export function getAdminBankList() {
  return fetch({
    url: prefixApi + '/getAdminBankList',
    method: 'post',
    params: {}
  });
}

/**
 * [getAdminCashoutList 提现申请列表]
 * @return {[type]} [description]
 */
export function getAdminCashoutList(where, whereIn, orderBy, pageSize, page, time) {
  return fetch({
    url: prefixApi + '/getAdminCashoutList',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time}
  });
}

/**
 * [getAdminCashoutDetail 提现申请详情]
 * @return {[type]} [description]
 */
export function getAdminCashoutDetail(type, cashoutId, object = null) {
  return fetch({
    url: prefixApi + '/getAdminCashoutDetail',
    method: 'post',
    params: {type, cashout_id: cashoutId, object}
  });
}

/**
 * [getAdminIncomeList 收入列表]
 * @return {[type]} [description]
 */
export function getAdminIncomeList(where, whereIn, orderBy, pageSize, page, time, query) {
  return fetch({
    url: prefixApi + '/getAdminIncomeList',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time, query}
  });
}

/**
 * [getAdminIncomeDetail 收入详情]
 * @return {[type]} [description]
 */
export function getAdminIncomeDetail(type, incomeId, object = null) {
  return fetch({
    url: prefixApi + '/getAdminIncomeDetail',
    method: 'post',
    params: {type, income_id: incomeId, object}
  });
}

/**
 * [setMemberConsume 设置会员产品消费]
 * @return {[type]} [description]
 */
export function setMemberConsume(type, val, name) {
  return fetch({
    url: prefixApi + '/setMemberConsume',
    method: 'post',
    params: {type, val, name}
  });
}

/**
 * [setDevelopStore 设置开发店长]
 * @return {[type]} [description]
 */
export function setDevelopStore(type, val, name) {
  return fetch({
    url: prefixApi + '/setDevelopStore',
    method: 'post',
    params: {type, val, name}
  });
}

/**
 * [setMonthGive 设置每月赠品]
 * @return {[type]} [description]
 */
export function setMonthGive(type, val, name) {
  return fetch({
    url: prefixApi + '/setMonthGive',
    method: 'post',
    params: {type, val, name}
  });
}

/**
 * [setCardHouse 设置车+房福利]
 * @return {[type]} [description]
 */
export function setCardHouse(type, val, name) {
  return fetch({
    url: prefixApi + '/setCardHouse',
    method: 'post',
    params: {type, val, name}
  });
}

/**
 * [getAdminCashLog 消费记录]
 * @return {[type]} [description]
 */
export function getAdminCashLog(where, whereIn, orderBy, pageSize, page, time) {
  return fetch({
    url: prefixApi + '/getAdminCashLog',
    method: 'post',
    params: {where, whereIn, orderBy, pageSize, page, time}
  });
}
