<template>
  <section>
    <div class="login">
      <div class="header">
        <div class="logo"></div>
        <div>录入您的个人信息</div>
      </div>

      <div class="row">
        <img src="../../assets/car/icon1.png" class="icon1">
        <input type="text" class="input" placeholder="请输入注册手机号码">
      </div>
      <div class="row">
        <img src="../../assets/car/icon2.png" class="icon2">
        <input type="text" class="input" placeholder="请输入身份证号码">
      </div>
      <div class="row">
        <img src="../../assets/car/icon3.png" class="icon3">
        <input type="text" class="input" placeholder="请输入手机号码">
      </div>

      <div class="btn-login">登陆</div>

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
.login {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
}
.header {
  margin-bottom: .4rem;
  text-align: center;
}
.logo {
  width: 1.5rem;
  height: 1.5rem;
  margin: 1rem auto 0 auto;
  background: url('../../assets/car/logo.png') no-repeat;
  background-size: 100%;
}
.row {
  position: relative;
  margin: 0 .15rem;
  padding: .15rem;
  background: #eaeaea;
  margin-bottom: .15rem;
}
.input {
  width: 90%;
  line-height: .5rem;
  margin-left: .6rem;
  padding-left: .2rem;
  border: none;
  border-radius: 0;
  outline: none;
  border-left: 1px solid #bdbdbd;
  background: #eaeaea;
}
.icon1 {
  position: absolute;
  top: .25rem;
  left: .2rem;
  width: .4rem;
  height: .4rem;
}
.icon2 {
  position: absolute;
  top: .25rem;
  left: .2rem;
  width: .4rem;
  height: .35rem;
}
.icon3 {
  position: absolute;
  top: .2rem;
  left: .22rem;
  width: .35rem;
  height: .4rem;
}
.btn-login {
  margin: .5rem;
  padding: .2rem;
  border-radius: 5px;
  text-align: center;
  background: #5699ff;
  color: white;
}
</style>

