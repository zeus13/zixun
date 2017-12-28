<template>
  <section class="staffOrderList">
    <div v-if="!showXLoading">
      <tab>
        <tab-item :selected="status === 0" @on-item-click="onItemClick(0)" style="color:#858585;">新订单</tab-item>
        <tab-item :selected="status === 1" @on-item-click="onItemClick(1)" style="color:#858585;">已接单</tab-item>
        <tab-item :selected="status === 2" @on-item-click="onItemClick(2)" style="color:#858585;">正在服务</tab-item>
        <tab-item :selected="status === 3" @on-item-click="onItemClick(3)" style="color:#858585;">已完成</tab-item>
      </tab>
        <div class="orderList-box" v-for="(item, index) in orderList" :key="index">
        <div class="hd">
          订单编号：{{item.ordersn}}<span class="fr">{{getOrderStatus(item)}}</span>
        </div>
        <div class="bd">
          <div class="bd-cont">
            <h3>【{{item.cat_name}}】{{item.goods_name}}</h3>
            <h4>{{item.spec_name}}</h4>
            <div>姓名：{{item.dispatch_name}}</div>
            <div>电话：{{item.dispatch_tel}}</div>
            <div v-show="item.is_go_door === 1">预约时间：{{getStamp(item.go_door_time,'mdhm') }}</div>
            <div>地址：{{item.dispatch_province + item.dispatch_city + item.dispatch_area + item.dispatch_address }}</div>
            <span class="total">合计：￥{{ item.total_price / 100 }}</span>
          </div>
        </div>
        <div class="ft" >
          <div class="btn" @click="goToPage(item.ordersn)">详情</div>
          <div class="btn" @click="refundOrder(item.ordersn, index)" v-show="getStatus(item) === 1">退款</div>
          <div class="btn" @click="getOrder(item.ordersn, index)" v-show="getStatus(item) === 1">接单</div>
          <div class="btn" @click="sendOrder(item.ordersn, index)" v-show="getStatus(item) === 2">上门服务</div>
          <div class="btn" @click="sendOrder(item.ordersn, index)" v-show="getStatus(item) === 3">发货</div>
          <div class="btn" @click="completeOrder(item.ordersn, index)" v-show="getStatus(item) === 4">完成</div>
        </div>

      </div>

      <div class="no-data" v-if="isEmpty(orderList)">还没有相关数据</div>
    </div>

    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>

    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { manageOrderList, manageOrderDetail } from '../api/getData'
import { Loading, Tab, TabItem, XDialog, XButton, XInput } from 'vux'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Tab,
    TabItem,
    XDialog,
    XButton,
    XInput
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      type: '', // 提交类型
      status: 0, // 0新订单1已接单2正在服务3已完成
      orderList: [], // 订单列表
      ordersn: '',
      showToast: false
    }
  },
  created () {
    if (!isEmpty(this.$route.query.status)) {
      this.status = parseInt(this.$route.query.status)
      console.log(this.status)
    }
  },
  mounted () {
    this.fetchData()
  },
  computed: {
  },
  methods: {
    onItemClick (index) {
      this.status = index
      this.fetchData()
      console.log('on item click:', index)
    },
    goHome () { // 返回首页
      this.$router.push({path: prefixUrl + '/goodsList', query: {}})
    },
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    },
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    goToPage (val) { // 查看详情
      this.$router.push({path: prefixUrl + '/staffOrderDetail', query: {ordersn: val}})
    },
    getOrderStatus (val) { // 获取订单状态
      if (val.refund_status === 1) {
        return '已退款'
      }
      if (val.close_status === 1) {
        return '已取消'
      }
      if (val.pay_status === 0) {
        return '待付款'
      }
      if (val.pay_status === 1 && val.get_status === 0) {
        return '待接单'
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 0 && val.complete_status === 0 && val.is_express === 1) {
        return '待发货'
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 0 && val.complete_status === 0 && val.is_express === 0) {
        return '待安排'
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 0 && val.is_express === 1) {
        return '已发货'
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 0 && val.is_express === 0) {
        return '上门途中'
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 1) {
        return '订单完成'
      }
    },
    getStatus (val) { // 获取订单状态
      if (val.close_status === 0 && val.refund_status === 0 && val.pay_status === 1 && val.get_status === 0) { // 接单/退款
        return 1
      }
      if (val.close_status === 0 && val.refund_status === 0 && val.get_status === 1 && val.send_status === 0 && val.complete_status === 0 && val.is_express === 0) { // 上门服务
        return 2
      }
      if (val.close_status === 0 && val.refund_status === 0 && val.get_status === 1 && val.send_status === 0 && val.complete_status === 0 && val.is_express === 1) { // 发货
        return 3
      }
      if (val.close_status === 0 && val.refund_status === 0 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 0) { // 完成
        return 4
      }
    },
    getOrder (ordersn, index) { // 接单
      var self = this
      self.type = 'getOrder'
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageOrderDetail(ordersn, index)
    },
    refundOrder (ordersn, index) { // 退款
      var self = this
      self.type = 'refundOrder'
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageOrderDetail(ordersn, index)
    },
    sendOrder (ordersn, index) { // 上门服务/配送
      var self = this
      self.type = 'sendOrder'
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageOrderDetail(ordersn, index)
    },
    completeOrder (ordersn, index) { // 完成
      var self = this
      self.type = 'completeOrder'
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageOrderDetail(ordersn, index)
    },
    manageOrderDetail (ordersn, index, object = null) {
      var self = this
      self.showLoadingText = '提交中...'
      self.showLoading = true
      manageOrderDetail(self.type, ordersn, object).then(response => {
        var data = response.data
        if (data.code === 200) {
          self.fetchData()
        } else {
          self.openPopupFun('alert', data.msg, 2)
          self.showLoading = false
        }
      })
    },
    fetchData () {
      var self = this
      manageOrderList(self.status).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.orderList)) {
            self.orderList = data.obj.orderList
          } else {
            self.orderList = []
          }
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.orderList-box {
  margin-top: .2rem;
  background: #fff;
}
.fr {
  float: right;
}
.orderList-box .hd{
  padding: .1rem .15rem;
  border-bottom: 1px solid #eee;
}
.orderList-box .bd{
  // margin: .1rem .15rem;
  position: relative;
  min-height: 1.6rem;
  line-height: .45rem;
}
.bd-img{
  width: 1.6rem;
  height: 1.6rem;
  display: block;
  position: absolute;
  top: 0;
  left: 0;
}
.bd-cont{
  // margin-left: 1.8rem;
  background: #d2bf97;
  padding: .2rem;
  color: #716862;
}
.bd-cont h3{
  width: 100%;
  font-size: .28rem;
  display: block;
  // height: .8rem;
  overflow: hidden;
  // margin-bottom: .4rem;
}
.bd .price{
  font-size: .24rem;
  position: absolute;
  top: 0;
  right: 0;
  text-align: right;
}
.bd-cont span{

}
.bd-cont em{
  color: #a9a9a9;
  font-size: .2rem;
}
.orderList-box .ft{
  border-top: 1px solid #eee;
  text-align: right;
}
.btn {
  background: #016735;
  color: #fff;
  display: inline-block;
  padding: .06rem .15rem;
  margin: .15rem;
  border-radius: 3px;
}
.btn-gray {
  background: #f2f4e7;
  color: #4d4d4d;
  display: inline-block;
  padding: .06rem .15rem;
  margin: .15rem;
  border-radius: 3px;
}
.no-data {
  text-align: center;
  margin: .6rem 0;
  color: #5c656c;
}
.no-data a {
  color: #5c656c;
  text-decoration: underline;
}
.no-data a:hover {
  color: #5c656c;
}
.total {
  font-size: .28rem;
  font-weight: bolder;
}
.btn-box {float: right;}

.btn {
  padding: .1rem .4rem;
  background: black;
  color: #d2bf97;
  border-radius: 5px;
}
.row {
  background: white;
}
.cb {clear: both;}
</style>
