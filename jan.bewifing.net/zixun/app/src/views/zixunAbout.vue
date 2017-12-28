<template>
  <section class="zixunAbout">
    <div class="header">
      <div class="header-img"><img src="../assets/zixun/headimg.jpg" class="img"></div>
      <div class="header-item">
        <p class="text">平台客服: Suky</p>
        <p>活动宣传&投诉建议：12345678901</p>
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
import { Loading } from 'vux'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'

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
      goodsList: [],
      tel: '', // 电话
      nickname: '' // 昵称
    }
  },
  created () {
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
    }
  }
}
</script>

<style lang="less" scoped>
.header {
  position: relative;
  width: 100%;
  height: 3rem;
  padding: .1rem;
  background: url('../assets/zixun/user-bg.png') no-repeat;
  background-size: 100%;
  color: white;
  font-size: .2rem;
}
.header-img {
  position: absolute;
  top: 0;
  left: 50%;
  width: 1rem;
  height: 1rem;
  margin-left: -.5rem;
  margin-top: .3rem;
}
.img {
  width: 100%;
  border: 1px solid #e4e4e4;
  border-radius: 50%;
}
.header-item {
  padding-top: 1.3rem;
  text-align: center;
}
.text {
  padding: .2rem;
}
</style>
