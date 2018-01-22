<template>
  <section class="memberCenter">
    <div class="head">
      <div class="head-bg">
<!--         <div class="bg-txt">
          <div class="txt">快来登录吧~</div>
          <div class="btn-login" @click="goToLogin()">登&nbsp&nbsp&nbsp陆</div>
        </div> -->
        <img :src="member.headimgurl" class="headimg">
        <p>{{member.nickname}}</p>
        <!-- <p class="fs-24" @click="profitFun">我的收益：{{member.balance / 100}}</p> -->
      </div>
      <div class="row-navi">
        <div class="row-navi-item" @click="goToOrder(0)">
          <div class="row-navi-item-icon"><img src="../assets/img/aimaspa/icon3.png" class="icon"></div>
          <div>全部订单</div>
        </div>
        <div class="row-navi-item" @click="goToOrder(1)">
          <div class="row-navi-item-icon"><img src="../assets/img/aimaspa/icon4.png" class="icon"></div>
          <div>待付款</div>
        </div>
        <div class="row-navi-item" @click="goToOrder(2)">
          <div class="row-navi-item-icon"><img src="../assets/img/aimaspa/icon5.png" class="icon"></div>
          <div>待服务</div>
        </div>
        <div class="row-navi-item" @click="goToOrder(3)">
          <div class="row-navi-item-icon" style="border: none;"><img src="../assets/img/aimaspa/icon6.png" class="icon"></div>
          <div>已完成</div>
        </div>
      </div>
    </div>

    <div class="list">
      <!-- <div class="row arrow" @click="developIng"><img src="../assets/img/aimaspa/icon7.png" class="icon2">我的美容卡</div> -->
      <div class="row arrow" @click="goToAddr"><img src="../assets/img/aimaspa/icon8.png" class="icon2">常用地址</div>
      <div class="row arrow" @click="helpFun"><img src="../assets/img/aimaspa/icon9.png" class="icon2">我的金币<span class="row-right">{{member.gold}}</span></div>
      <div class="row arrow" @click="profitFun"><img src="../assets/img/aimaspa/icon11.png" class="icon2">我的收益<span class="row-right">{{member.balance / 100}}</span></div>
      <div class="row arrow" @click="teamListFun"><img src="../assets/img/aimaspa/icon11.png" class="icon2">我的团队</div>
      <div class="row arrow" @click="extractFun"><img src="../assets/img/aimaspa/icon11.png" class="icon2">我要提现</div>
      <div class="row"><img src="../assets/img/aimaspa/icon10.png" class="icon2">电话咨询<a class="row-right" v-bind:href="'tel:'+tel">{{tel}}</a></div>
      <div class="row arrow" @click="joinUsFun"><img src="../assets/img/aimaspa/icon11.png" class="icon2">加入我们</div>
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
import { memberCenter } from '../api/getData'
import { Loading } from 'vux'
// import QrcodeVue from 'qrcode.vue'

export default {
  components: {
    XLoading,
    Loading,
    Popup
    // QrcodeVue
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
      qrcodeShow: false, // 是否打开微信关注弹窗
      member: {},
      qrcode: 'http://tys.afxeon.net',
      tel: '15078822247'
    }
  },
  created () {
  },
  mounted () {
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
    qrcodeShowFun () { // 关注弹窗
      this.qrcodeShow = !this.qrcodeShow
    },
    helpFun () {
      this.openPopupFun('alert', '特定商品可使用金币抵扣的，抵扣的金额有上限。1金币抵10元。', 1)
    },
    goToLogin () {
      return this.$router.push({path: prefixUrl + '/login', query: {}})
    },
    goToOrder (val) { // 跳转订单页面
      this.$router.push({path: prefixUrl + '/orderList', query: {state: val}})
    },
    goToTeam () { // 跳转我的团队
      this.$router.push({path: prefixUrl + '/teamList', query: {}})
    },
    goToAddr () { // 跳转地址管理
      this.$router.push({path: prefixUrl + '/addressList', query: {}})
    },
    goToTakeMoney () { // 跳转提现管理
      this.$router.push({path: prefixUrl + '/takeMoneyList', query: {}})
    },
    goToAssetAccount () { // 跳转提现账户管理
      this.$router.push({path: prefixUrl + '/assetAccountList', query: {}})
    },
    profitFun () { // 收益详情
      this.$router.push({path: prefixUrl + '/profitList', query: {}})
    },
    teamListFun () { // 我的团队
      this.$router.push({path: prefixUrl + '/teamList', query: {}})
    },
    extractFun () { // 我要提现
      this.$router.push({path: prefixUrl + '/extractNote', query: {}})
    },
    joinUsFun () { // 加入我们
      this.$router.push({path: prefixUrl + '/joinUsNote', query: {}})
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
    developIng () {
      this.openPopupFun('alert', '该功能正在开发中...', 2)
    },
    fetchData () {
      var self = this
      memberCenter().then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.member)) {
            self.member = data.obj.member
            if (self.member.is_member === 1) {
              self.qrcode = 'http://tys.afxeon.net/app/login?qrcode=' + self.member.qrcode
            }
          }
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
@font-c: #9c7319;
.memberCenter {
  padding-bottom: .3rem;
}
.head-bg p {
  text-align: center;
  font-size: .28rem;
  color: #a19075;
}
.head-bg .fs-24 {
  font-size: .24rem;
}
.headimg {
  width: 1.2rem;
  height: 1.2rem;
  border-radius: 50%;
  overflow: hidden;
  display: block;
  margin: .4rem auto 0;
  border: 2px solid #69614a;
}
.row-navi {
  display: flex;
  flex-direction: row;
  line-height: .2rem;
  padding: .4rem .2rem .4rem .2rem;
  color: @font-c;
}
.row-navi-item {
  // flex-grow: 1;
  width: 25%;
  text-align: center;
  // margin: .1rem;
}
.row-navi-item {
  border-left: 1px solid #f2e4c9;
}
.row-navi-item:first-child {
  border-left: 0;
}
.icon {
  width: 1rem;
}
.head {
  background: white;
}
.head-bg {
  width: 100%;
  height: 2.6rem;
  background: url('../assets/img/aimaspa/bg2.png') no-repeat;
  background-size: 100%;
  padding-top: 1px;
}
.list {
  background: white;
}
.row {
  padding: .2rem .2rem;
  border-top: 1px solid #f2e4c9;
  color: @font-c;
  position: relative;
}
.arrow::after {
  content: '';
  display: block;
  width: .14rem;
  height: .14rem;
  border-right: 1px solid #d2bf97;
  border-bottom: 1px solid #d2bf97;
  transform: rotate(-45deg);
  position: absolute;
  top: 50%;
  margin-top: -.08rem;
  right: .2rem;
}
.icon2 {
  width: .3rem;
  height: .3rem;
  vertical-align: middle;
  position: relative;
  top: -.02rem;
  margin-right: .1rem;
}
.row-right {
  float: right;
  color: @font-c;
  margin-right: .2rem;
}
.fr {float: right;}
.cb {clear: both;}
</style>
