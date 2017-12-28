<template>
  <section class="orderList">
    <div v-if="!showXLoading, !showEvaluate">
      <div class="tab">
        <div class="tab-item" @click="onItemClick(0)"><span :class="{line:status === 0}" >全部订单</span></div>
        <div class="tab-item" @click="onItemClick(1)"><span :class="{line:status === 1}">待付款</span></div>
        <div class="tab-item" @click="onItemClick(2)"><span :class="{line:status === 2}">待服务</span></div>
        <div class="tab-item" @click="onItemClick(3)"><span :class="{line:status === 3}">已完成</span></div>
      </div>
      <div class="orderList-box" v-for="(item,index) in orderList" :key="index">
        <div class="hd">
           订单编号：{{item.ordersn}}<span class="fr">{{getOrderStatus(item)}}</span>
        </div>
        <div class="bd">
          <img class="bd-img" :src="item.goods_img">
          <div class="bd-cont">
            <h3>【{{item.cat_name}}】{{item.goods_name}}</h3>
            <div>总价：￥{{item.total_price / 100}}</div>
          </div>
        </div>
        <div class="row">
           <!-- <span class="btn-check ml-10" @click="checkWuLiu(item.dispatch_type_code)" v-show="getStatus(item) === 3">物流信息</span>  -->
           <span class="btn-check ml-10" @click="evaluate()" v-show="getStatus(item) === 3">评价商品/服务</span> 
          <span class="btn-check ml-10" @click="takeOverGoods(item.ordersn,index)" v-show="getStatus(item) === 2">完成</span>
          <span class="btn-check ml-10" @click="pay(item.ordersn)" v-show="getStatus(item) === 1">支付</span>
          <span class="btn-check ml-10" @click="goToPage(item.ordersn)">查看详情</span>
          <div class="cb"></div>
        </div>
      </div>
      
      <div class="no-data" v-if="isEmpty(orderList)">还没有相关数据，<a href="javascript:void(0)" @click="goHome"> 点击查看更多优惠信息...</a></div>
    </div>

    <div class="evaluate-box" v-show="showEvaluate">
      <div class="evaluate-title">
        <div @click="back" class="div">
          <div class="back"></div>
        </div>
        评价
        <span class="btn-sumbit">发布</span>
      </div>
      <div class="row-evaluate">
        <div class="div-img"></div>
        <p class="evaluate-txt">【美容】度妍3D纳米美肤</p>
      </div>
      <div class="textarea-box">
        <textarea placeholder="将你的对于本次服务的感觉分享给其他人吧" class="textarea"></textarea>
      </div>
        <div class="pic-box-2" v-show="isPic">
          <!-- <div class="pic-box-item"></div>
          <div class="pic-box-item"></div>
          <div class="pic-box-item"></div>
          <div class="pic-box-item"></div>
          <div class="pic-box-item"></div>
          <div class="pic-box-item"></div> -->
          <div class="photo-box">
            <img src="../assets/img/aimaspa/photo.png" class="photo-img">
            <div>添加图片</div>
          </div>
 
      </div>
    </div>


    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>

    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <!-- <loading :show="showLoading" :text="showLoadingText"></loading> -->
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { getOrderList, takeOverGoods } from '../api/getData'
import { Loading, Tab, TabItem } from 'vux'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Tab,
    TabItem
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
      status: 0, // 0全部1待付款2待服务3已完成
      orderList: [], // 订单列表
      isPic: true,
      showEvaluate: false
    }
  },
  created () {
    if (!isEmpty(this.$route.query.state)) {
      this.status = parseInt(this.$route.query.state)
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
      this.$router.push({path: prefixUrl + '/goodsIndex', query: {}})
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
    checkWuLiu (val) { // 查看物流信息
      window.location.href = 'http://m.kuaidi100.com/index_all.html?type=kdby&postid=' + val
    },
    pay (val) { // 支付
      this.$router.push({path: prefixUrl + '/pay', query: {ordersn: val}})
    },
    takeOverGoods (ordersn, index) { // 确认收货
      var self = this
      self.showLoadingText = '提交中...'
      self.showLoading = true
      takeOverGoods(self.type, ordersn).then(response => {
        var data = response.data
        if (data.code === 200) {
          self.orderList.splice(index, 1)
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    },
    goToPage (val) { // 查看详情
      this.$router.push({path: prefixUrl + '/orderDetail', query: {ordersn: val}})
    },
    getOrderStatus (val) { // 获取订单状态
      if (val.refund_status === 1) {
        return '已退款'
      }
      if (val.close_status === 1) {
        return '已关闭'
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
        return '交易完成'
      }
    },
    getStatus (val) { // 获取订单状态
      if (val.refund_status === 0 && val.close_status === 0 && val.pay_status === 0) { // 立即支付
        return 1
      }
      if (val.refund_status === 0 && val.close_status === 0 && val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 0) { // 完成交易
        return 2
      }
      // if (val.refund_status === 0 && val.close_status === 0 && val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.is_express === 1) { // 完成交易
      //   return 3
      // }
      if (val.refund_status === 0 && val.close_status === 0 && val.pay_status === 1 && val.get_status === 1 && val.send_status === 1 && val.complete_status === 1) {
        return 3
      }
    },
    fetchData () {
      var self = this
      self.showLoadingText = '加载中...'
      self.showLoading = true
      getOrderList(self.status).then(response => {
        var data = response.data
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
    },
    evaluate () {
      this.showEvaluate = true
    },
    back () {
      this.showEvaluate = false
    }
  }
}
</script>

<style lang="less" scoped>
.div {
  width: .5rem;
  height: .5rem;
  display: inline-block;
  float: left;
}
.back {
  width: .18rem;
  height: .18rem;
  border-left: 1px solid #d2bf97;
  border-bottom: 1px solid #d2bf97;
  transform: rotate(45deg);
  margin-top: .15rem;
  margin-left: .1rem;
}
.btn-sumbit {
  float: right;
  padding: 0 .1rem;
  color:#d2bf97;
}
.evaluate-title {
  text-align: center;
  padding: .15rem;
  border-bottom: 1px solid #eaeae9;
  // border-bottom: 1px solid #d2bf97;
  font-size: .28rem;
}

.pic-box {
  padding-left: .3rem;
  padding-bottom: .15rem;
}
.pic-box-2 {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  padding-bottom: .16rem;
}
.pic-box-item {
  width: 1.4rem;
  height: 1.4rem;
  background: url('../assets/img/aimaspa/bg4.png') no-repeat;
  background-size: cover;
  background-position: 50%;
  margin-left: .16rem;
  margin-top: .16rem;
}
.photo-box {
  width: 1.4rem;
  height: 1.4rem;
  text-align: center;
  padding: .2rem;
  border: 1px dashed #d2bf97;
  color: #c7c7c7;
  margin-top: .16rem;
  margin-left: .16rem;
}
.photo-img {
  width: .5rem;
  height: .5rem;
}
.evaluate-box {background: white;}
.textarea-box {
  padding: .15rem;
  border-bottom: 1px solid #f5e3bd;
}
.textarea {
  width: 100%;
  height: 2rem;
  resize: none;
  outline: none;
  border: none;
  overflow: hidden;
}
.evaluate-txt {
  margin-left: .7rem;
  margin-top: .2rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.div-img {
  width: .6rem;
  height: .6rem;
  background: url('../assets/img/aimaspa/bg4.png');
  background-size: cover;
  background-position: 50%;
  position: absolute;
  top: .15rem;
  left: .15rem;
}
.row-evaluate {
  padding: .1rem;
  position: relative;
  min-height: .9rem;
  border-bottom: 1px solid #f5e3bd;
}

.ml-10{
  margin-left: 10px;
}
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
  color:#88827e;
}
.orderList-box .bd{
  // margin: .1rem .15rem;
  position: relative;
  min-height: 1.6rem;
  border-bottom: 1px solid #d2bf97;
  padding: .2rem;
  color: #88827e;
}
.bd-img{
  width: 1.6rem;
  height: 1.6rem;
  display: block;
  // position: absolute;
  // top: 0;
  // left: 0;
}
.bd-cont{
  margin-left: 1.8rem;
  position: absolute;
  top: .15rem;
  line-height: .45rem;
}
.bd-cont h3{
  width: 4rem;
  font-size: .28rem;
  display: block;
  // height: .8rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  // margin-bottom: .4rem;
}
.bd .price{
  font-size: .24rem;
  position: absolute;
  top: 0;
  right: 0;
  text-align: right;
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
.tab {
  padding: .2rem;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  background: white;
  position: relative;
}
.tab-item {
  flex-grow: 1;
  text-align: center;
}
.line {
  color: #d2bf97;
  border-bottom: 1px solid #d2bf97;
  padding: .1rem 0;
}
.row { padding: .15rem;}
.btn-check {
  float: right;
  padding: .05rem .2rem;
  color: white;
  background: #d2bf97;
  border-radius: 5px;
}
.cb {clear: both;}
.fs-028 { font-size: .28rem; }
a,button,input,optgroup,select,textarea { -webkit-tap-highlight-color:rgba(0,0,0,0); }
</style>
