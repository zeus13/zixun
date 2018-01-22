<template>
  <section class="guide">
  <h1 class="title">宏骏</h1>
  <div class="row" @click="gotoConfirm">认证</div>
  <div class="row" @click="gotoOrders">接单</div>
  <div class="row" @click="gotoInsuranceList">运费险列表</div>
  <div class="row" @click="gotoInsuranceDetail">运费险详情</div>
  <div class="row" @click="goToPage1">投保协议</div>
  <div class="row" @click="goToPage2">运费险信息填写</div>
  <div class="row" @click="goToPage3">我的-运费险详情</div>
  <div class="row" @click="goToPage4">我的-运费险列表</div>
  <div class="row" @click="goToPage5">充值列表</div>
  <div class="row" @click="goToPage6">我的运单</div>
  <div class="row" @click="goToPage7">我的信息</div>
  <div class="row" @click="goToPage8">充值油卡</div>
  <div class="row" @click="goToPage9">接单成功</div>
      <x-loading v-show="showXLoading"></x-loading>
    </transition>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import { Loading } from 'vux'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../../utils/utils'
import { prefixUrl } from '@/utils/env'
// import { getGoodsIndex } from '../api/getData'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: false, // 是否显示加载动画
      showLoading: false, // 是否显示数据加载中弹窗
      showLoadingText: '', // 加载中弹窗文字
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      goodsList: []
    }
  },
  created () {
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
    openPopupFun (type, msg, icon, back) { // 打开弹窗
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗
      this.showPopup = false
    },
    goToPage (val) { // 跳转页面
      console.log(val)
      this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: val}})
    },
    gotoConfirm () {
      return this.$router.push({path: prefixUrl + '/carConfirm', query: {}})
    },
    gotoOrders () {
      return this.$router.push({path: prefixUrl + '/carOrders', query: {}})
    },
    gotoInsuranceList () {
      return this.$router.push({path: prefixUrl + '/carInsuranceList', query: {}})
    },
    gotoInsuranceDetail () {
      return this.$router.push({path: prefixUrl + '/carInsuranceDetail', query: {}})
    },
    goToPage1 () {
      return this.$router.push({path: prefixUrl + '/carInsuranceAgreement', query: {}})
    },
    goToPage2 () {
      return this.$router.push({path: prefixUrl + '/carBuyInsurance', query: {}})
    },
    goToPage3 () {
      return this.$router.push({path: prefixUrl + '/carMyInsuranceDetail', query: {}})
    },
    goToPage4 () {
      return this.$router.push({path: prefixUrl + '/carMyInsuranceList', query: {}})
    },
    goToPage5 () {
      return this.$router.push({path: prefixUrl + '/carRechargeRecord', query: {}})
    },
    goToPage6 () {
      return this.$router.push({path: prefixUrl + '/carMyTransportList', query: {}})
    },
    goToPage7 () {
      return this.$router.push({path: prefixUrl + '/carMyInfo', query: {}})
    },
    goToPage8 () {
      return this.$router.push({path: prefixUrl + '/carRecharge', query: {}})
    },
    goToPage9 () {
      return this.$router.push({path: prefixUrl + '/carSuccess', query: {}})
    },
    updateFun () { // 更新数据
      // var self = this
      // self.showLoadingText = '提交中'
      // self.showLoading = true
      // getGoodsIndex().then(response => {
      //   var data = response.data
      //   if (data.code === 200) {
      //     if (!isEmpty(data.obj.goodsList)) {
      //       self.goodsList = data.obj.goodsList
      //       console.log(self.goodsList)
      //     }
      //   } else {
      //     self.openPopupFun('alert', data.msg, 2)
      //   }
      //   self.showLoading = false
      // })
    },
    fetchData () { // 初始化数据
      // var self = this
      // getGoodsIndex().then(response => {
      //   var data = response.data
      //   if (data.code === 200) {
      //     if (!isEmpty(data.obj.goodsList)) {
      //       self.goodsList = data.obj.goodsList
      //       console.log(self.goodsList)
      //     }
      //   } else {
      //     self.openPopupFun('alert', data.msg, 2)
      //   }
      //   self.showXLoading = false
      // })
    }
  }
}
</script>

<style lang="less" scoped>
.guide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
}
.title {
  padding: .15rem;
  text-align: center;
}
.row {
  padding: .15rem;
  border-bottom: 1px solid #949494;
}
</style>

