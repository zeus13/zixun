<template>
  <section class="login">
    <!-- <div class="head-img">
      <img src="../assets/img/logo.jpg" alt="微信头像" width="100%">
    </div>
    <div class="input-box">
      <img src="../assets/img/tel.svg">
      <input v-model="tel" placeholder="手机号码" type="tel" maxlength="11" v-on:input="inputFun">
    </div>
    <div class="input-box bor-b">
      <img src="../assets/img/code.svg">
      <input v-model="code" placeholder="验证码" type="tel" maxlength="6">
      <span v-bind:class="{ 'hili': isActive }" class="code" @click="getCode">{{tips}}</span>
    </div>
    <div class="btn-login" @click="login">登录</div>
    <div class="tips">如有问题，请在微信公众号留言~</div> -->

      <div class="login-box">
      <div class="row">
        <img src="../assets/img/aimaspa/icon1.png" class="icon">
        <input class="input" placeholder="请输入手机号码" v-model="tel" type="tel" maxlength="11" v-on:input="inputFun">
      </div>
      <div class="row row-2" style="border: none">
        <img src="../assets/img/aimaspa/icon2.png" class="icon">
        <input type="password" class="input-2" placeholder="请输入手机验证码" v-model="code" maxlength="4">
        <span v-bind:class="{ 'hili': isActive }" class="code" @click="getCode">{{tips}}</span>
      </div>
    </div>
    <div class="btn-login" @click="login">登  陆</div>
    


    <toast v-model="isShowMsg" type="text" :text="msg"></toast>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { Loading, Toast } from 'vux'
import { prefixUrl } from '@/utils/env'
import { register, verify } from '../api/getData'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Toast
  },
  data () {
    return {
      showXLoading: false, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      tel: '', // 手机号码
      code: '', // 短信验证码
      type: '', // 提交类型
      isActive: false, // 是否获取验证码
      isTime: false, // 是否计时
      isShowMsg: false, // 弹窗
      msg: '', // 弹窗内容
      tips: '获取验证码', // 验证码按钮文字
      qrcode: '' // 二维码
    }
  },
  created () {
    // if (!isEmpty(this.$route.query.qrcode)) {
    //   this.qrcode = this.$route.query.qrcode
    // }
    // console.log(this.$route)
    // console.log(document.toname)
  },
  mounted () {
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
    inputFun () { // 当tel输入框有变化时执行
      console.log(this.tel.length)
      if (this.tel.length === 11 && !this.isTime) {
        this.isActive = true
      } else {
        this.isActive = false
      }
      console.log(this.isActive)
    },
    getCode () { // 获取验证码
      console.log('~~~')
      var self = this
      if (!self.isActive || self.isTime) {
        return
      }
      if (!/^(86)?1[34578]\d{9}$/.test(self.tel)) {
        self.openPopupFun('alert', '手机格式不正确', 2)
        return
      }
      self.isTime = true
      self.isActive = false
      self.tips = '重新获取(60s)'
      self.isShowMsg = true
      self.msg = '验证码已发送~'
      let t = 60
      var times = 0
      times = setInterval(function () {
        t--
        if (t < 0) {
          clearTimeout(times)
          self.isTime = false
          self.isActive = true
          self.tips = '重新获取'
          return
        }
        self.tips = '重新获取(' + t + 's)'
      }, 1000)
      // TODO 获取验证码ajax
      verify(self.tel).then(response => {
        var data = response.data
        if (data.code === 200) {
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
      })
    },
    login () { // login
      console.log('~~~')
      let self = this
      if (self.tel.replace(/(^\s*)|(\s*$)/g, '') === '') {
        this.openPopupFun('alert', '请填写手机号码', 2)
        return
      }
      if (!/^(86)?1[34578]\d{9}$/.test(self.tel)) {
        this.openPopupFun('alert', '手机格式不正确', 2)
        return
      }
      if (self.code.replace(/(^\s*)|(\s*$)/g, '') === '') {
        this.openPopupFun('alert', '请填写验证码', 2)
        return
      }
      console.log(self.code.length)
      if (self.code.length !== 4) {
        this.openPopupFun('alert', '验证码不正确', 2)
        return
      }
      // TODO 登录ajax
      self.showLoadingText = '提交中'
      self.showLoading = true
      register(self.tel, self.code, self.qrcode).then(response => {
        var data = response.data
        if (data.code === 200) {
          console.log(prefixUrl)
          if (document.toname !== null) { // 从其他页面进来
            this.$router.go(-1)
          } else { // 从注册页进来
            this.$router.replace({path: prefixUrl + '/goodsIndex', query: {}})
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.login {
  width: 100%;
  height: 100%;
  background: url('../assets/img/aimaspa/bg.jpg');
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
}
.login-box {
  // margin: 2.5rem .8rem .2rem .8rem;
  margin: 0 .6rem;
  background: white;
  border-radius: 5px;
  position: relative;
  top: 1.5rem;

}
.icon {
  width: .5rem;
  vertical-align: middle;
  position: absolute;
}
.row {
  padding: .1rem .2rem .1rem .15rem;
  border-bottom: 1px solid #d2bf97;
  position: relative;
}
.input {
  width: 100%;
  height: .5rem;
  padding-left: .6rem;
  border:none;
  outline: none;
}
.input-2 {
  width: 65%;
  height: .5rem;
  padding-left: .6rem;
  border:none;
  outline: none;
}
// .row-2::after {
//   content: '发放验证码';
//   display: inline-block;
//   padding: .05rem .1rem;
//   position: absolute;
//   top: .2rem;
//   right: .2rem;
//   background: #948d87;
//   color: white;
//   border-radius: 5px;
// }
.code {
  display: inline-block;
  padding: .05rem .1rem;
  position: absolute;
  top: .12rem;
  right: .12rem;
  background: #948d87;
  color: white;
  border-radius: 5px;
}
.hili {
  background: #1AAD19;
}
.btn-login {
  margin: 0 .6rem;
  background: #d2bf97;
  text-align: center;
  padding: .12rem;
  border-radius: 5px;
  position: relative;
  top: 2.2rem;
  font-size: .28rem;
}
.index {
  position: absolute;
  top: 0;
  left: 0;
}
// .head-img {
//   width: 130px;
//   height: 130px;
//   border-radius: 50%;
//   overflow: hidden;
//   margin: 50px auto 30px;
// }
// .bor-b {
//   border-bottom: 1px solid #e0e0e0;
// }
// .input-box {
//   background: #fff;
//   height: 50px;
//   border-top: 1px solid #e0e0e0;
//   position: relative;
// }
// .input-box input {
//   margin-top: 10px;
//   width: 5rem;
//   margin-left: 45px;
//   height: 30px;
//   border: 0;
//   outline:none;
//   font-family: "Microsoft YaHei", Arial, sans-serif;
// }
// .input-box img {
//   width: 30px;
//   position: absolute;
//   top: 10px;
//   left: 8px;
// }
// .login .input-box .hili {
//     color: #00a2ff;
//     border: 1px solid #00a2ff;
// }
// .input-box .code {
//     color: #999;
//     border: 1px solid #c3c5c6;
//     font-size: 12px;
//     height: 24px;
//     line-height: 24px;
//     width: 95px;
//     text-align: center;
//     border-radius: 15px;
//     display: block;
//     position: absolute;
//     right: 10px;
//     top: 50%;
//     margin-top: -12px;
//     z-index: 1;
// }
// .btn-login {
//   width: 90%;
//   height: 40px;
//   line-height: 40px;
//   text-align: center;
//   border-radius: 6px;
//   background: #016735;
//   color: #fff;
//   margin: 30px auto 0;
//   font-size: 16px;
//   font-family: "Microsoft YaHei", Arial, sans-serif;
// }
// .tips {
//   text-align: center;
//   line-height: 30px;
//   color: #a0a0a0;
//   font-size: 12px;
// }
</style>
