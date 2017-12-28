<template>
<section class="zixunBuyTicket">
  <div v-if="!showXLoading">
    <div class="top-box">
      <h3>{{activity.name}}</h3>
      <span>{{ticketype.name}}|￥{{ticketype.price}}, &nbsp;{{num}}张</span>
      <p><i class="s-icons icon-map"></i> {{activity.place}}{{activity.time}}</p>
      <div class="bd"><i class="s-icons icon-book4"></i>取票方式：电子票</div>
    </div>
    <div class="title">购买信息</div>
    <div class="tel-box">
      <label>手机</label><input v-model="tel" type="tel" id="tel" name="tel" placeholder="接收预定成功短信" maxlength="11">
    </div>
    <div class="foot-blank-div"></div>
    <div class="foot">
      <span class="price">合计 ￥{{beautifyTicketTotalPrice()}}</span>
      <div class="join-btn" @click="clickBuy()">支付</div>
    </div>
  </div>
  <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getStamp, fetchArray, saveArray } from '@/components/common/utils'
import wx from 'weixin-js-sdk'
export default {
  components: {
    XLoading,
    popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      act_id: 0, // 活动id
      activity: {}, // 活动信息
      ticktype_id: 0, // 票型id
      ticketype: {}, // 票型信息
      num: 0, // 购买数量
      tel: '', // 手机号码
      ordersn: '' // 订单编号
    }
  },
  created () { // 从本地缓存拿值
    if (!isEmpty(this.$route.query.act_id) && !isEmpty(this.$route.query.ticktype_id) && !isEmpty(this.$route.query.num)) {
      this.act_id = this.$route.query.act_id
      this.ticktype_id = this.$route.query.ticktype_id
      this.num = this.$route.query.num
    } else {
      this.$router.go(-1)
    }
    this.tel = isEmpty(fetchArray('tel')) ? '' : fetchArray('tel')
    this.getJssdk()
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    openPopupFun (type, msg, icon) { // 开启弹窗
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗
      this.showPopup = false
      if (this.popupMsg === '保存成功') {
        this.$router.go(-1)
      }
    },
    // 获取jssdk
    async getJssdk () {
      await this.$http({url: 'ajaxZixunGetJssdk', params: {}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          wx.config(JSON.parse(result.obj.jssdk))
        }
      }, function (response) {
        console.log(response)
      })
    },
    beautifyTicketTotalPrice () { // 优化票总价
      var price = 0
      if (!isEmpty(this.ticketype)) {
        price = parseFloat(this.ticketype.price) * this.num
      }
      return price
    },
    clickBuy () { // 点击支付
      if (this.tel.replace(/(^\s*)|(\s*$)/g, '') === '') {
        this.openPopupFun('alert', '电话不能为空', 2)
        return
      }
      if (!/^(86)?1[0-9]\d{9}$/.test(this.tel)) {
        this.openPopupFun('alert', '电话格式不正确', 2)
        return
      }
      saveArray('tel', this.tel)
      this.openPopupFun('load', '正在提交', 0)
      this.$http({url: 'ajaxZixunCreateOrder', params: {ticktype_id: this.ticktype_id, num: this.num, tel: this.tel}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          this.ordersn = result.obj.ordersn
          if (parseFloat(result.obj.total_price) > 0) { // 收费
            this.pay()
          } else { // 免费
            this.$router.replace({name: 'zixunUserHome', query: {}})
          }
        } else {
          this.openPopupFun('alert', result.msg, 2)
        }
      }, function (response) {
        this.openPopupFun('alert', 'error', 2)
        console.log(response)
      })
    },
    pay () { // 支付
      this.$http({url: 'ajaxZixunBuyTicket', params: {ordersn: this.ordersn}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          var config = result.obj.config
          var t = this
          wx.ready(function () {
            wx.chooseWXPay({
              timestamp: config.timestamp,
              nonceStr: config.nonceStr,
              package: config.package,
              signType: config.signType,
              paySign: config.paySign, // 支付签名
              success: function (res) {
                t.$router.replace({name: 'zixunUserHome', query: {}})
              },
              fail: function () {
                t.openPopupFun('alert', '支付失败,请重新刷新页面', 2)
              },
              cancel: function () {
              }
            })
          })
          wx.error(function () {
            t.openPopupFun('alert', '支付失败,请重新刷新页面', 2)
          })
        } else {
          this.openPopupFun('alert', result.msg, 2)
        }
      }, function (response) {
        this.openPopupFun('alert', 'error', 2)
        console.log(response)
      })
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunActivityInfo', params: {act_id: this.act_id}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          this.activity = result.obj.activity
          for (var i = 0; i < this.activity.ticket_types.length; i++) {
            if (this.activity.ticket_types[i].id === parseInt(this.ticktype_id)) {
              this.ticketype = this.activity.ticket_types[i]
              break
            }
          }
        }
      }, function (response) {
        console.log(response)
      })
      this.showXLoading = false
    }
  },
  watch: {
  }
}
</script>
<style lang="less" scoped>
.zixunBuyTicket{
  margin: .2rem;
  color: #0b1e30;
}
.top-box{
  background: #fff;
  padding-top: .2rem;
  line-height: 1.5;
}
.top-box h3{
  padding-left: .5rem;
}
.top-box span{
  padding-left: .5rem;
  
}
.top-box p{
  padding-left: .5rem;
  margin-top: .1rem;
  margin-bottom: .2rem;
  position: relative;
}
.top-box p .s-icons{
  position: absolute;
  top: .06rem;
  left: .24rem;
}
.top-box .bd{
  padding-left: .5rem;
  height: .6rem;
  border-top: 1px dotted #9e9ed4;
  line-height: .6rem;
  position: relative;
}
.top-box .bd .s-icons{
  position: absolute;
  top: .2rem;
  left: .24rem;
}
.title{
  line-height: .5rem;
  font-size: .2rem;
  text-indent: .2rem;
  color: #aeaeae;
}
.tel-box{
  background: #fff;
  line-height: .7rem;
  height: .7rem;
}
.tel-box label{
  display: inline-block;
  width: 1rem;
  text-align: center;
}
#tel{
  width: 4rem;
  height: .7rem;
  -webkit-appearance: none;
  line-height: .4rem;
  background-color: #fff;
  border: 0;
  border-radius: 3px;
  outline: 0;
  color: #0b1e30;
}
</style>
