<template>
  <section class="extractNote">
    <div v-if="!showXLoading">
      <div class="title">提现须知</div>
      <p class="tips">满100元以上可提现，需要提现的客户请加客服微信并注明提现金额+注册的手机号码<br>(例如：提现100元,手机号码15078822247)</p>
      <img class="qrcode" src="../assets/img/qrcode1.jpg">
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
import { Loading } from 'vux'
import { prefixUrl } from '@/utils/env'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: false, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0 // 弹窗icon仅支持0,1,2
    }
  },
  created () {
  },
  mounted () {
  },
  computed: {
  },
  methods: {
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
    }
  }
}
</script>

<style lang="less" scoped>
.extractNote {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #fff;
  color: #4d4d4d;
}
.qrcode {
  display: block;
  width: 4.5rem;
  margin: 0 auto;
}
.title {
  text-align: center;
  font-size: .32rem;
  margin: .2rem;
}
.tips {
  margin: .2rem;
}
</style>
