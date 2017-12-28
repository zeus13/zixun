<template>
  <section>
    <div class="staffOrderDetail">
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
            <div class="number">X{{order.goods_amount}}</div>
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


<!--         <div class="row" v-for="(item,index) in subOrder" :key="index">
          <span>补差价</span>
          <span class="btn-qrcode" v-show="item.pay_status === 0" @click="qrcodeShowFunBefore(item.ordersn)">待支付</span>
          <span class="u-sty1" v-show="item.pay_status === 1">支付成功</span>
          <span class="sty1" :class="{'red-c':item.pay_status === 0}">¥{{item.total_price / 100}} </span>
        </div> -->
<!--         <div class="row" v-show="sub_order_price > 0">
          <div class="title">补差价</div>
          <div class="fr">
            <div class="price">￥{{sub_order_price / 100}}</div>
          </div>
          <div class="cb"></div>
        </div> -->

        <div class="row total fw">
          合计：<span class="fr">￥{{parseInt(order.total_price) / 100}}</span>
        </div>
      </div>

<!--       <div class="service-info">
        <div class="row fw">其他</div>
        <div class="row arrow" @click="showToast=true">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>补差价</span>
        </div>
      </div> -->

      <div class="service-info">
        <div class="row fw">订单信息</div>
        <div class="row">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>订单编号：{{order.ordersn}}</span>
        </div>
        <div class="row">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>订单状态：{{getOrderStatus(0)}}</span>
        </div>
        <div class="row" v-show="order.is_go_door == 1">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>预约时间：{{getStamp(order.go_door_time,'mdhm')}}</span>
        </div>
        <div class="row">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>联系方式：{{order.dispatch_tel}}({{order.dispatch_name}})</span>
        </div>
        <div class="row">
          <img src="../assets/img/aimaspa/icon8.png" class="icon">
          <span>地址：{{order.dispatch_province + order.dispatch_city + order.dispatch_area + order.dispatch_address}}</span>
        </div>
        <div class="row">
          <img src="../assets/img/aimaspa/icon26.png" class="icon">
          <span>备注：{{order.remark}}</span>
        </div>
      </div>
      
<!--       <div class="orderStatus" v-show="!isEmpty(subOrder)">
        <div class="row fw">补差价订单</div>
        <div class="row" v-for="(item,index) in subOrder" :key="index">
          <img src="../assets/img/aimaspa/icon24.png" class="icon">
          <span>订单：¥{{item.total_price / 100}} <span class="sty1">({{item.ordersn}})</span></span>
          <span class="btn-qrcode" style="float:right" v-show="item.pay_status === 0" @click="qrcodeShowFunBefore(item.ordersn)">二维码</span>
          <span class="u-sty1" v-show="item.pay_status === 1">支付成功</span>
        </div>
      </div> -->

    </div>

<!--     <x-dialog v-model="showToast" class="dialog-demo">
      <div class="dialogTitle">填写差价(整数) <img src="../assets/img/close.png" @click="showToast=false" class="dialogClose"></div>
      <x-input  v-model="amount" class="weui-vcode" placeholder="填写差价(整数)"><x-button slot="right" type="primary" mini @click.native="repairPrice()">确定</x-button></x-input> 
        
    </x-dialog> -->

    <div class="qrcode-mask" v-show="qrcodeShow">
      <div class="qrcode-cont">
        <svg @click="qrcodeShowFun()" t="1499318480086" class="icon-close" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2465" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M512 66C264.6 66 64 266.6 64 514c0 247.4 200.6 448 448 448 247.4 0 448-200.6 448-448C960 266.6 759.4 66 512 66zM728.6 665c3 3 4.6 7 4.6 11.2 0 4.2-1.6 8.4-4.6 11.2l-43.2 43.4c-3.2 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6L512 579.6l-150.8 151.4c-3 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6l-43.2-43.4c-3-3-4.6-7-4.6-11.2 0-4.2 1.6-8.4 4.6-11.2l151.4-152-151.8-150c-6.2-6.2-6.2-16.4 0-22.6l43.2-43.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l151.4 149.4 151.4-149.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l43.2 43.4c6.2 6.2 6.2 16.4 0 22.6l-151.8 150L728.6 665z" p-id="2466" fill="#165f46"></path></svg>
        <div class="qrcode-vue">
          <qrcode-vue :value="qrcode" :size="150" level="H"></qrcode-vue>
        </div>
        <p>扫一扫即可补差价哟~</p>
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
import { manageOrderDetail } from '../api/getData'
import { Loading, XDialog, XButton, XInput } from 'vux'
import QrcodeVue from 'qrcode.vue'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    XDialog,
    XButton,
    XInput,
    QrcodeVue
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
      subOrder: [], // 补差价订单
      sub_order_price: 0, // 补差价
      amount: 1, // 补差价金额（1相当于1块）
      showToast: false, // 补差价弹窗
      qrcodeShow: false, // 是否打开微信关注弹窗
      qrcode: '' // 二维码
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
    this.manageOrderDetail()
  },
  // updated () {
  //   var self = this
  //   self.subOrder = self.subOrder
  // },
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
    qrcodeShowFunBefore (val) {
      this.qrcode = 'http://aimaspa.afxeon.net/app/pay?ordersn=' + val
      console.log(this.qrcode)
      this.qrcodeShow = true
    },
    qrcodeShowFun () { // 关注弹窗
      this.qrcodeShow = !this.qrcodeShow
    },
    repairPriceBefore (val, val1) { // 补差价（前）
      this.showToast = true
      this.ordersn = val
      this.index = val1
    },
    repairPrice () { // 补差价
      this.showToast = false
      var self = this
      if (parseInt(self.amount) < 1 || self.amount === '') {
        self.openPopupFun('alert', '至少1元', 2)
        return
      }
      self.type = 'repairPrice'
      var object = {
        amount: self.amount // 1相当于1块
      }
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageOrderDetail(object)
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
    manageOrderDetail (object = null) {
      var self = this
      manageOrderDetail(self.type, self.ordersn, object).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (self.type === '') {
            if (!isEmpty(data.obj.order)) {
              self.order = data.obj.order
              self.sub_order_price = data.obj.sub_order_price
              // if (!isEmpty(data.obj.order.sub_orders)) {
              //   self.subOrder = data.obj.order.sub_orders
              // }
            }
          }
          // if (self.type === 'repairPrice') {
          //   // self.$router.go(0)
          //   var temp = {
          //     ordersn: data.obj,
          //     pay_status: 0,
          //     total_price: self.amount * 100
          //   }
          //   // self.subOrder.push(temp)
          // }
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
        self.showLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.staffOrderDetail {
  padding-bottom: .2rem;
}
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
  top: -.03rem;
  margin-right: .1rem;
}
.arrow::after {
  content: '';
  display: inline-block;
  width: .14rem;
  height: .14rem;
  border-right: 1px solid #d2bf97;
  border-bottom: 1px solid #d2bf97;
  transform: rotate(-45deg);
  margin-right: .1rem;
  margin-top: .16rem;
  float: right;
}
.row {
  padding: .2rem;
  position: relative;
  background: white;
  border-bottom: 1px solid #ecdec2;
  font-size: .25rem;
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

/* 微信关注弹窗 */
.qrcode-mask{
  position:fixed;
  left:0;
  top:0;
  z-index: 8;
  width:100%;
  height:100%;
  pointer-events:auto;
  background-color:rgba(0,0,0,.6);
  pointer-events:auto;
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content: center;
  -webkit-justify-content: center;
  align-items: center;
  -webkit-align-items: center;
}
.qrcode-cont{
  background: #fff;
  position: relative;
  z-index: 999;
  border-radius: .1rem;
  padding: .5rem .5rem .2rem;
}
.qrcode-cont .qrcode-vue{
  width: 150px;
  display: block;
  margin: 0 auto;
}
.qrcode-cont p{
  text-align: center;
  margin-top: .1rem;
}
.icon-close {
  width: .5rem;
  height: .5rem;
  position: absolute;
  top: -.15rem;
  right: -.15rem;
  z-index: 999;
  background: #fff;
  border-radius: 50%;
}
.row:last-child {
  border: 0;
}
.btn-qrcode {
  background: #1AAD19;
  color: #fff;
  float: right;
  padding: 0 .15rem;
  font-size: .24rem;
  border-radius: 3px;
}
.u-sty1 {
  color: #1AAD19;
  float: right;
}
.sty1 {
  float: right;
  margin-right: .3rem;
}
.red-c {
  color: red;
}
.dialogTitle {
  font-size: 16px;
  line-height: 40px;
  position: relative;
}
.dialogClose {
  position: absolute;
  width: 25px;
  height: 25px;
  top: 6px;
  right: 6px;
}
.weui-cell:before {
  left: 0; 
}
</style>
