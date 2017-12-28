import fetch from '@/utils/fetch'
import { prefixApi } from '@/utils/env'

/**
 * [getJssdk 获取jssdk]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunGetJssdk () {
  return fetch({
    url: prefixApi + '/ajaxZixunGetJssdk',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunActivityIndex 活动首页]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunActivityIndex () {
  return fetch({
    url: prefixApi + '/ajaxZixunActivityIndex',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunActivityInfo 活动详情]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunActivityInfo (actId) {
  return fetch({
    url: prefixApi + '/ajaxZixunActivityInfo',
    method: 'post',
    params: {act_id: actId}
  })
}

/**
 * [ajaxZixunActivityInfoMember 活动详情-参与人数]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunActivityInfoMember (actId) {
  return fetch({
    url: prefixApi + '/ajaxZixunActivityInfoMember',
    method: 'post',
    params: {act_id: actId}
  })
}

/**
 * [ajaxZixunCreateOrder 生成订单]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunCreateOrder (ticktypeId, tel, num) {
  return fetch({
    url: prefixApi + '/ajaxZixunCreateOrder',
    method: 'post',
    params: {ticktype_id: ticktypeId, tel: tel, num: num}
  })
}

/**
 * [ajaxZixunBuyTicket 购票]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunBuyTicket () {
  return fetch({
    url: prefixApi + '/ajaxZixunBuyTicket',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunOrderList 订单列表]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunOrderList () {
  return fetch({
    url: prefixApi + '/ajaxZixunOrderList',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunOrderInfo 订单详情]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunOrderInfo () {
  return fetch({
    url: prefixApi + '/ajaxZixunOrderInfo',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunUserHome 个人信息]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunUserHome () {
  return fetch({
    url: prefixApi + '/ajaxZixunUserHome',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunUserEdit 个人信息编辑]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunUserEdit (member) {
  return fetch({
    url: prefixApi + '/ajaxZixunUserEdit',
    method: 'post',
    params: {member}
  })
}

/**
 * [ajaxZixunTicketList 门票列表]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunTicketList () {
  return fetch({
    url: prefixApi + '/ajaxZixunTicketList',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunTicketInfo 门票信息]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunTicketInfo (code) {
  return fetch({
    url: prefixApi + '/ajaxZixunTicketInfo',
    method: 'post',
    params: {code: code}
  })
}

/**
 * [ajaxZixunActivityCommentList 活动评论列表]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunActivityCommentList () {
  return fetch({
    url: prefixApi + '/ajaxZixunActivityCommentList',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunActivityComment 活动评论]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunActivityComment () {
  return fetch({
    url: prefixApi + '/ajaxZixunActivityComment',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunActivityCommentFans 活动评论-点赞]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunActivityCommentFans () {
  return fetch({
    url: prefixApi + '/ajaxZixunActivityCommentFans',
    method: 'post',
    params: {}
  })
}

/**
 * [ajaxZixunAboutMe 关于我们]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
export function ajaxZixunAboutMe () {
  return fetch({
    url: prefixApi + '/ajaxZixunAboutMe',
    method: 'post',
    params: {}
  })
}

/**
 * [register 注册或者登陆]
 * @param  {[type]} val [url]
 * @return {[type]}
 */
// export function register (account, code, qrcode) {
//   return fetch({
//     url: prefixApi + '/register',
//     method: 'post',
//     params: {account, code, qrcode}
//   })
// }
