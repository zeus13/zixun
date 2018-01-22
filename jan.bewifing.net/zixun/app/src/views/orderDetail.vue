<template>
  <section>
    <div class="orderDetail">
      <div>
        <div class="row">
          <div class="title">【{{order.cat_name}}】{{order.goods_name}}</div>
          <div class="fr">
            <div class="number">X{{order.goods_amount}}</div>
            <div class="price">￥{{order.goods_price / 100}}</div>
          </div>
          <div class="cb"></div>
        </div>
        <div class="row" v-show="order.spec_name != ''">
          <div class="title">{{order.spec_name}}</div>
          <div class="fr">
            <div class="price">￥{{order.spec_price / 100}}</div>
          </div>
          <div class="cb"></div>
        </div>
        <div class="row" v-show="order.use_gold > 0">
          <div class="title">使用{{order.use_gold}}个金币</div>
          <div class="fr">
            <div class="price">- ￥{{order.use_gold * 10}}</div>
          </div>
          <div class="cb"></div>
        </div>

        <div class="row total fw no-border">
          合计：<span class="fr">￥{{parseInt(order.total_price) / 100}}</span>
        </div>
      </div>
      <div class="service-info">
        <div class="row fw">订单信息</div>
        <div class="row" v-show="order.spec_name != ''">
          <img src="../assets/img/aimaspa/icon27.png" class="icon">
          <span>{{order.spec_name}}</span>
        </div>
        <div class="row" v-show="order.is_go_door == 1">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>预约时间：{{getStamp(order.go_door_time,'mdhm')}}</span>
        </div>
        <div class="row">
          <img src="../assets/img/aimaspa/icon8.png" class="icon">
          <span>地址：{{order.dispatch_province + order.dispatch_city + order.dispatch_area + order.dispatch_address}}</span>
        </div>
        <div class="row no-border">
          <img src="../assets/img/aimaspa/icon26.png" class="icon">
          <span>备注：{{order.remark}}</span>
        </div>
      </div>
      
      <div class="orderStatus">
        <div class="row fw">订单状态</div>
        <div class="row">
          <span>订单状态：{{getOrderStatus(0)}}</span>
        </div>
        <div class="row no-border" v-show="!isEmpty(getOrderStatus(2))"><span>{{getOrderStatus(1)}}: {{getStamp(getOrderStatus(2),'mdhm')}}</span></div>
      </div>

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
import { getOrderInfo } from '../api/getData'
import { Loading } from 'vux'
var JsBarcode = require('jsbarcode')

export default {
  components: {
    XLoading,
    Loading,
    Popup
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
      ordersn: '', // 订单号
      order: {}, // 订单信息
      qrcode: 0 // 二维码
    }
  },
  created () {
    if (!isEmpty(this.$route.query.ordersn)) {
      this.ordersn = this.$route.query.ordersn
    } else {
      this.$router.go(-1)
    }
  },
  mounted () {
    this.fetchData()
  },
  computed: {
  },
  methods: {
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
    getOrderStatus (index) { // 获取订单状态
      var val = this.order
      var arr = []
      if (val.refund_status === 1) {
        arr = ['已退款', '退款时间', val.refund_time]
        return arr[index]
      }
      if (val.close_status === 1) {
        arr = ['已取消', '关闭时间', val.cloes_time]
        return arr[index]
      }
      if (val.pay_status === 0) {
        arr = ['待付款', '下单时间', val.created_at]
        return arr[index]
      }
      if (val.pay_status === 1 && val.get_status === 0) {
        arr = ['待接单', '付款时间', val.pay_time]
        return arr[index]
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 0 && val.complete_status === 0 && val.is_express === 1) {
        arr = ['待发货', '接单时间', val.get_time]
        return arr[index]
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 0 && val.complete_status === 0 && val.is_express === 0) {
        arr = ['待安排', '接单时间', val.get_time]
        return arr[index]
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 0 && val.is_express === 1) {
        arr = ['已发货', '发货时间', val.send_time]
        return arr[index]
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 0 && val.is_express === 0) {
        arr = ['上门途中', '出发时间', val.send_time]
        return arr[index]
      }
      if (val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 1) {
        arr = ['订单完成', '完成时间', val.complete_time]
        return arr[index]
      }
    },
    getStatus () { // 获取订单状态
      var val = this.order
      if (val.pay_status === 0) { // 立即支付
        return 1
      }
      if (val.complete_status === 0) { // 完成交易
        return 2
      }
      if (val.complete_status === 1) { // 查看详情
        return 3
      }
    },
    checkWuLiu (val) { // 查看物流信息
      window.location.href = 'http://m.kuaidi100.com/index_all.html?type=kdby&postid=' + val
    },
    showBarcode (val) { // 条形码
      if (val === 0) {
        return
      }
      console.log(val)
      JsBarcode('#barcode', val, {
        format: 'CODE128',
        displayValue: true,
        fontSize: 24,
        lineColor: '#000'
      })
    },
    fetchData () {
      var self = this
      getOrderInfo(self.type, self.ordersn).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.order)) {
            self.order = data.obj.order
            // self.showBarcode(self.order.goods_qrcode)
          }
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.orderStatus {
  margin-top: .2rem;
}
.service-info {
  margin-top: .2rem;
}
.icon {
  width: .3rem;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
  margin-right: .1rem;
}
.row {
  padding: .2rem;
  position: relative;
  background: white;
  border-bottom: 1px solid #ecdec2;
  font-size: .25rem;
}
.no-border {
  border: 0;
}

.title {
  width: 4rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  display: inline-block;
}
.number {
  display: inline-block;
  text-align: right;
}
.price {
  display: inline-block;
  text-align: right;  
  width: 1.3rem;
}
.total {
  font-size: .28rem;
}
.mr-01 {margin-right: .1rem;}
.fw {font-weight: bolder;}
.fs-028 {font-size: .28rem;}
.ml-03 {margin-left: .3rem;}
.cb {clear: both;}
.fr {float:right;}
</style>
