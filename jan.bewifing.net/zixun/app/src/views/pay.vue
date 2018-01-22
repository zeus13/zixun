<template>
  <section>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  </section>
</template>

<script>
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '@/utils/utils'
import { pay, getNowJssdk } from '../api/getData'
// import { prefixUrl } from '@/utils/env'
import wx from 'weixin-js-sdk'
export default {
  components: {
    Popup
  },
  data () {
    return {
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      ordersn: '',
      parameter: '' // 参数
    }
  },
  created () {
    if (!isEmpty(this.$route.query.ordersn)) {
      this.ordersn = this.$route.query.ordersn
    } else {
      this.$router.go(-1)
    }
    var str = window.location.href
    var arr = str.split('?')
    if (!isEmpty(arr[1])) {
      this.parameter = arr[1]
    }
    this.initData()
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    openPopupFun (type, msg, icon) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    // 初始化数据
    async initData () {
      var self = this
      // window.alert('~')
      getNowJssdk().then(response => { // 获取jssdk
        self.showXLoading = false
        let result = response.data
        if (result.code === 200) {
          wx.config(result.obj.jssdk)
          self.pay()
        }
      })
    },
    pay () { // 支付
      var self = this
      pay(self.ordersn).then(response => {
        var data = response.data
        if (data.code === 200 && !isEmpty(data.obj)) {
          var config = data.obj.config
          wx.ready(function () {
            wx.chooseWXPay({
              timestamp: config.timestamp,
              nonceStr: config.nonceStr,
              package: config.package,
              signType: config.signType,
              paySign: config.paySign, // 支付签名
              success: function (res) {
                window.location.href = 'http://aimaspa.afxeon.net/app/orderDetail?' + self.parameter
                // window.alert(prefixUrl + '/orderInfo')
                // self.$router.replace({path: prefixUrl + 'http://aimaspa.afxeon.net/app/orderInfo', query: {ordersn: self.ordersn}})
              },
              fail: function () {
                self.openPopupFun('alert', '支付失败，请重新支付', 2)
                if (self.showPopup) {
                  window.history.go(-1)
                }
              },
              cancel: function () {
                window.history.go(-1)
              }
            })
          })
          wx.error(function () {
            // self.openPopupFun('alert', '支付失败,请重新刷新页面2', 2)
          })
        } else {
          self.openPopupFun('alert', data.msg, 2)
          if (self.showPopup) {
            window.history.go(-1)
          }
        }
      })
    }
  }
}
</script>
