<template>
  <section class="zixunBuyTicket">
    <div class="header">
      <h3 class="header-title pl-05">{{activity.name}}</h3>
      <p class="pl-05">{{ticket_types.name}} | ￥{{ticket_types.price}}, {{num}}张</p>
      <div class="address">
        <img src="../assets/zixun/icon-map.png" class="icon">
        <span class="address-text">{{activity.place}} {{activity.time}}</span>
      </div>
      <div class="row-ticket">取票方式：电子票</div>
    </div>
    <!-- 购买信息 -->
    <div class="ticket-num">
      <div class="ticket-title">购买信息</div>
      <div class="tel">
        <span>手机</span>
        <input type="tel" class="input" placeholder="接受预定成功短信" v-model="tel" maxlength="11">
      </div>
    </div>

    <!-- 底部 -->
    <div class="footer">
      <div class="footer-left">￥{{total()}}元</div>
      <div class="footer-right" @click="join">支付</div>
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
import { isEmpty, getStamp, saveArray } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { ajaxZixunGetJssdk, ajaxZixunActivityInfo, ajaxZixunCreateOrder } from '../api/getData'
import wx from 'weixin-js-sdk'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: true, // 是否显示加载动画
      showLoading: false, // 是否显示数据加载中弹窗
      showLoadingText: '', // 加载中弹窗文字
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      tel: '', // 电话
      act_id: 0,
      ticktype_id: 0,
      num: 0,
      activity: [],
      ticket_types: [],
      price: 0,
      ordersn: ''
    }
  },
  created () {
    if (!isEmpty(this.$route.query.act_id)) {
      this.act_id = this.$route.query.act_id
    }
    if (!isEmpty(this.$route.query.ticktype_id)) {
      this.ticktype_id = this.$route.query.ticktype_id
    }
    if (!isEmpty(this.$route.query.num)) {
      this.num = this.$route.query.num
    }
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
    getJssdk () {
      ajaxZixunGetJssdk().then(response => {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          wx.config(JSON.parse(result.obj.jssdk))
        }
      }, function (response) {
        console.log(response)
      })
    },
    fetchData () { // 初始化数据
      var self = this
      ajaxZixunActivityInfo(self.act_id).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.activity)) {
            self.activity = data.obj.activity
            console.log('activity', self.activity)
            console.log(self.activity.ticket_types.length)
            for (var i = 0; i < self.activity.ticket_types.length; i++) {
              if (self.activity.ticket_types[i].id === parseInt(self.ticktype_id)) {
                self.ticket_types = self.activity.ticket_types[i]
                self.price = self.activity.ticket_types[i].price
                break
              }
            }
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    },
    join () {
      var self = this
      if (self.tel.replace(/(^\s*)|(\s*$)/g, '') === '') {
        self.openPopupFun('alert', '电话不能为空', 2)
        return
      }
      if (!/^(86)?1[0-9]\d{9}$/.test(self.tel)) {
        self.openPopupFun('alert', '电话格式不正确', 2)
        return
      }
      saveArray('tel', this.tel)
      this.openPopupFun('load', '正在提交', 0)
      ajaxZixunCreateOrder(self.ticktype_id, self.tel, self.num).then(response => {
        let result = response.data
        console.log(result)
        if (result.code === 200) {
          self.ordersn = result.obj.ordersn
          self.total_price = result.obj.total_price
          console.log(self.ordersn)
          console.log(self.total_price)
          if (parseFloat(result.obj.total_price) > 0) { // 收费
            // 模拟支付
            self.openPopupFun('alert', '支付成功', 1)
            return this.$router.push({path: prefixUrl + '/zixunUserHome', query: {}})
          } else { // 免费
            return this.$router.push({path: prefixUrl + '/zixunUserHome', query: {}})
          }
        } else {
          self.openPopupFun('alert', result.msg, 2)
        }
      })
    },
    total () {
      var price = this.num * parseFloat(this.price)
      return price
    }
  }
}
</script>

<style lang="less" scoped>
.header {
  margin: .2rem .2rem 0 .2rem;
  padding-top: .2rem;
  background: white;
}
.header-title {
  padding-bottom: .1rem;
  // font-size: .26rem;
  color: #384275;
}
.address {
  position: relative;
  margin-top: .1rem;
  padding-bottom: .2rem;
  border-bottom: 1px dashed #384275;
}
.icon {
  position: absolute;
  top: .06rem;
  width: .25rem;
  margin-left: .2rem;
  vertical-align: middle;
}
.address span {
  display: inline-block;
  width: 5.6rem;
  padding-left: .5rem;
  font-size: .22rem;
}
.row-ticket {
  padding: .15rem .2rem .15rem .2rem;
}
.row-ticket::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  margin-right: .05rem;
  background: url('../assets/zixun/icon-book4.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .05rem;
}
.tel {
  margin: 0 .2rem;
  padding: .15rem .15rem;
  background: white;
  position: relative;
}
.tel span {
  position: absolute;
  top: .25rem;
}
.tel input {
  width: 100%;
  height: .55rem;
  padding: .1rem 0 .1rem .7rem;
  padding-left: .7rem;
  outline: none;
  border: none;
  background: white;
  // font-size: .24rem;
}
.ticket-title {
  padding: .1rem .35rem;
  font-size: .2rem;
  color: #a7a5a5;
}
.footer {
  position: fixed;
  bottom: 0;
  margin-top: .1rem;
  width: 100%;
  height: .8rem;
  background: white;
  border-top: 1px solid #f7f7f7;
}
.footer-left {
  float: left;
  width: 40%;
  height: .8rem;
  line-height: .8rem;
  padding-left: .2rem;
}
.footer-right {
  float: left;
  width: 60%;
  height: .8rem;
  line-height: .8rem;
  text-align: center;
  background: #384275;
  color: white;
  font-size: .24rem;
}
.pl-05 { padding-left: .5rem }
</style>
