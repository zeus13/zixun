<template>
<section class="zixunVerifyTicket">
  <div v-if="!showXLoading">
    <div class="scan-title clearfix">电子票验证 <div class="btn-scan" @click="scanBarcode()">扫码</div><div class="btn-manual" @click="showManualFun()">手工</div></div>
    <div class="scan-cont" v-show="isTicket">
      <div class="line-cell">
        <h3 class="line-label">电子票</h3>
        <div class="line-cell-bd" style="font-size:.24rem;">{{ticket.code}}</div>
      </div>   
      <div class="line-cell">
        <h3 class="line-label">票券类型</h3>
        <div class="line-cell-bd">{{ticket.ticktype_name}}</div>
      </div> 
      <div class="line-cell">
        <h3 class="line-label">剩余次数</h3>
        <div class="line-cell-bd">{{ticket.rest}}</div>
      </div> 
      <div class="line-cell">
        <h3 class="line-label">票券状态</h3>
        <div class="line-cell-bd red" :class="{green: beautifyTicketStatus() === '未使用'}">{{beautifyTicketStatus()}}</div>
      </div> 
      <div class="line-cell">
        <h3 class="line-label">购买时间</h3>
        <div class="line-cell-bd">{{getStamp(ticket.created_at, 'ymdhms')}}</div>
      </div>  
      <div class="line-cell" v-show="ticket.check_time > 0">
        <h3 class="line-label">验证时间</h3>
        <div class="line-cell-bd">{{getStamp(ticket.check_time, 'ymdhms')}}</div>
      </div>  
      <div class="line-cell">
        <h3 class="line-label">活动名称</h3>
        <div class="line-cell-bd">{{ticket.act_name}}</div>
      </div> 
      <div class="line-cell">
        <h3 class="line-label">活动时间</h3>
        <div class="line-cell-bd">{{ticket.act_time}}</div>
      </div> 
      <div class="tips" v-show="!(beautifyTicketStatus() === '未使用')">该票{{beautifyTicketStatus()}}了</div>
      <div class="btn-verify" v-show="beautifyTicketStatus() === '未使用'" @click="verifyTicket()">验证</div>
    </div>
    <div class="tips-scan" v-show="!isTicket">点击右上方按钮才能进行验证哟~</div>
  </div>
  <div class="popup-manual" v-show="showManual">
    <div class="pm-loading-shade"></div>
    <div class="pm-popupAuto">
      <div class="pm-main popup-anim">
        <svg @click="showManualFun()" t="1499318480086" class="icon-close" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2465" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M512 66C264.6 66 64 266.6 64 514c0 247.4 200.6 448 448 448 247.4 0 448-200.6 448-448C960 266.6 759.4 66 512 66zM728.6 665c3 3 4.6 7 4.6 11.2 0 4.2-1.6 8.4-4.6 11.2l-43.2 43.4c-3.2 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6L512 579.6l-150.8 151.4c-3 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6l-43.2-43.4c-3-3-4.6-7-4.6-11.2 0-4.2 1.6-8.4 4.6-11.2l151.4-152-151.8-150c-6.2-6.2-6.2-16.4 0-22.6l43.2-43.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l151.4 149.4 151.4-149.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l43.2 43.4c6.2 6.2 6.2 16.4 0 22.6l-151.8 150L728.6 665z" p-id="2466" fill="#445194"></path></svg>
        <div class="pm-top-line"></div>
        <div class="pm-cont">
          <div class="barcode-box">
            <div class="bb-title">查询票券</div>
            <input type="tel" placeholder="这里输入票券号码..." id="barcode" name="barcode" v-model="barCode" maxlength="18">
          </div>
          <div class="bb-tips">{{checkTips}}</div>
        </div>
        <div class="pm-btn" @click="checkTicketInfo('manual')">查询</div>
      </div>
    </div>
  </div>
  <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getStamp } from '@/components/common/utils'
import wx from 'weixin-js-sdk'
export default {
  components: {
    XLoading,
    popup
  },
  data () {
    return {
      showXLoading: false, // 显示加载动画
      showPopup: false, // 是否显示弹窗
      popupType: '', // 弹窗类型
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      barCode: '', // 票券号码
      barCodeTemp: '', // 票券号码(数据库)
      showManual: false, // 是否显示手工录码弹窗
      checkTips: '', // 手工验证提示语
      isTicket: false, // 是否查询成功
      ticket: {} // 门票信息
    }
  },
  created () {
    this.getJssdk()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
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
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    showManualFun () {
      this.barCode = ''
      this.checkTips = ''
      this.showManual = !this.showManual
    },
    beautifyTicketStatus () { // 优化门票状态
      var timeNow = parseInt(new Date().getTime() / 1000)
      var ticket = this.ticket
      var status1 = '已使用'
      var status2 = '未使用'
      var status3 = '已过期'
      if (ticket.is_check === 1) { // 用过
        if (ticket.is_through_ticket === 1) { // 通票
          if (ticket.rest > 0) { // 还有剩余次数
            if (ticket.endtime >= timeNow) { // 未过期
              return status2
            } else { // 已过期
              return status1
            }
          } else { // 已经使用完
            return status1
          }
        } else { // 单次票
          return status1
        }
      } else { // 未用过
        if (ticket.endtime >= timeNow) { // 未过期
          return status2
        } else { // 已过期
          return status3
        }
      }
    },
    scanBarcode () { // 扫码条形码
      var self = this
      wx.ready(function () {
        wx.scanQRCode({
          needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
          scanType: ['barCode'], // 可以指定扫二维码还是一维码，默认二者都有
          success: function (res) {
            var result = res.resultStr // 当needResult 为 1 时，扫码返回的结果
            var arr = result.split(',')
            if (arr.length > 1) {
              self.barCode = arr[1]
              self.checkTicketInfo('scan')
            } else {
              self.barCode = arr[0]
              self.checkTicketInfo('scan')
            }
          }
        })
      })
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
    verifyTicket () { // 验证票券
      console.log(this.ticket)
      if (isEmpty(this.ticket)) {
        this.openPopupFun('alert', '数据有误', 2)
        return
      }
      this.openPopupFun('load', '正在提交', 0)
      this.$http({url: 'ajaxZixunCheckTicket', params: {code: this.ticket.code}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200) {
          this.ticket = result.obj.ticket
          this.openPopupFun('alert', '验证成功', 1)
        } else {
          this.openPopupFun('alert', result.msg, 2)
        }
      }, function (response) {
        this.openPopupFun('alert', 'error', 2)
        console.log(response)
      })
    },
    checkTicketInfo (type) { // 查询票券信息
      if (isEmpty(this.barCode) || this.barCode.replace(/(^\s*)|(\s*$)/g, '') === '') {
        if (type === 'scan') {
          this.openPopupFun('alert', '票券号码不能为空', 2)
        } else {
          this.checkTips = '票券号码不能为空'
        }
        return
      }
      if (!/^\d{18}$/.test(this.barCode)) {
        if (type === 'scan') {
          this.openPopupFun('alert', '票券号码格式不正确', 2)
        } else {
          this.checkTips = '票券号码格式不正确'
        }
        return
      }
      this.openPopupFun('load', '正在提交', 0)
      this.showManual = false
      this.$http({url: 'ajaxZixunTicketInfo', params: {code: this.barCode}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200) {
          this.isTicket = true
          this.ticket = result.obj.ticket
          this.openPopupFun('alert', '查询成功', 1)
        } else {
          this.openPopupFun('alert', result.msg, 2)
          this.isTicket = false
        }
      }, function (response) {
        this.openPopupFun('alert', 'error', 2)
        console.log(response)
        this.isTicket = false
      })
    }
  },
  watch: {
  }
}
</script>
<style lang="less" scoped>
.zixunVerifyTicket{

}
.scan-title{
  font-size: .2rem;
  line-height: 1rem;
  height: .8rem;
  padding: 0 .2rem;
  color: #999999;
  border-bottom: 1px solid #efefef;
}
.tips{
  color: red;
  font-size: .2rem;
  text-align: center;
  padding: .2rem 0;
}
.bb-tips{
  color: red;
  font-size: .2rem;
  text-align: center;
  line-height: .6rem;
}
.tips-scan{
  color: #999999;
  font-size: .2rem;
  text-align: center;
  padding: .2rem 0;
}
.btn-manual, .btn-scan{
  width: 1rem;
  height: .4rem;
  line-height: .4rem;
  text-align: center;
  border: 1px solid #84a3f9;
  color: #557be6;
  border-radius: .1rem;
  float: right;
  margin-left: .3rem;
  font-size: .2rem;
  margin-top: .2rem;
}
.line-cell {
  border-bottom: 1px solid #efefef;
  padding: .2rem .2rem;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  align-items: center;
  background: #fff;
}
.line-label {
    display: block;
    width: 1rem;
    margin-right: .2rem;
    word-wrap: break-word;
    word-break: break-all;
    font-weight: bold;
}
.line-label2 {
    display: block;
    width: 2rem;
    margin-right: .2rem;
    word-wrap: break-word;
    word-break: break-all;
}
.line-cell-bd {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
  flex: 1;
  font-size: .2rem;
}
.line-input {
  width: 100%;
  border: 0;
  outline: 0;
  -webkit-appearance: none;
  background-color: transparent;
  font-size: inherit;
  color: inherit;
  height: 1.41176471em;
  line-height: 1.41176471;
  color: #7d7d7d;
}
.btn-verify {
  margin: .4rem .2rem;
  font-size: .28rem;
  height: .7rem;
  line-height: .7rem;
  text-align: center;
  text-decoration: none;
  color: #fff;
  border-radius: 5px;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  overflow: hidden;    
  background-color: #84a3f9;  
}
.red{
  color: red;
}
.green{
  color: green;
}
.popup-manual {
  position:relative;
  z-index:19940303;
}
/* 弹窗动画 */
@-webkit-keyframes bounceIn {
    0% {
        opacity:0;
        -webkit-transform:scale(.5);
    }
    100% {
        opacity:1;
        -webkit-transform:scale(1);
    }
}
@keyframes bounceIn {
    0% {
        opacity:0;
        transform:scale(.5)
    }
    100% {
        opacity:1;
        transform:scale(1)
    }
}
.popup-anim {
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-duration: .18s;
    animation-duration: .18s;
    animation-name: bounceIn;
    -webkit-animation-name: bounceIn;
}
.pm-popupAuto{
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content: center;
  -webkit-justify-content: center;
  align-items: center;
  -webkit-align-items: center;
}
.pm-top-line{
  background: #445194;
  height: .05rem;
}
.pm-main{
  width: 4.6rem;
  background: #fff;
  position: relative;
  z-index: 999;
  border-radius: .1rem;
  overflow: hidden;
}
.pm-cont{
  padding: .7rem .3rem 0;
}
.pm-btn{
  width: 2rem;
  border-radius: .1rem;
  background: #445194;
  color: #fff;
  text-align: center;
  line-height: .3rem;
  font-size: .28rem;
  padding: .15rem 0;
  margin: .2rem auto;
  position: relative;
}
.pm-btn:after{
  content: "";
  width: 4.4rem;
  border-bottom: 1px solid #d9d9d9;
  -webkit-transform-origin: 0 100%;
  transform-origin: 0 100%;
  position: absolute;
  top: -.2rem;
  left: -1rem;
  -webkit-transform: scaleY(.5);
  transform: scaleY(.5);
}
.pm-loading-shade {
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
  pointer-events:auto;
  background-color:rgba(0,0,0,.6);
  pointer-events:auto;
}
.barcode-box{
  width: 4rem;
  border: 1px solid #465394;
  border-radius: .2rem;
  margin: 0 auto;
  font-size: .4rem;
  height: .8rem;
  line-height: 1.1rem;
  text-align: center;
  position: relative;
}
.bb-title{    
  width: 1.2rem;
  position: absolute;
  left: 50%;
  top: -0.26rem;
  margin-left: -0.6rem;
  height: .4rem;
  line-height: .4rem;
  background: #fff;
  color: #455294;
  font-size: .2rem;
  border-radius: .1rem;
  border: 1px solid #455294;
}
#barcode {
  display: block;
  width: 3.6rem;
  margin: .25rem auto 0;
  height: .5rem;
  border: none;
  outline: medium;
  text-align: center;
  font-size: .28rem;
}
.icon-close{
  width: .4rem;
  height: .4rem;
  position: absolute;
  top: .05rem;
  right: 0;
  z-index: 999;
}
</style>
