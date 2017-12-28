<template>
<section class="zixunTicketInfo">
  <div v-if="!showXLoading">
    <div v-show="!isEmpty(ticket)">
      <div class="top">
        <div class="thumbnail" v-bind:style="{ 'background': 'url('+ticket.thumbnail+'?imageView2/1/w/150/h/150) no-repeat','background-size':'cover','background-position':'50%'}"></div>
        <span class="fs-022">{{ticket.act_name}}</span>
      </div>
      <div class="m2">
        <div class="main">
          <div class="info-item fs-022"><i class="s-icons icon-map"></i>{{ticket.act_place}}</div>
          <div class="info-item fs-022">{{ticket.act_time}}</div>
          <div class="info-item fs-022">{{ticket.ticktype_name}}1张</div>
        </div>
        <div class="barcode">
          <div class="barcode-bg">
            <div class="divider"><div class="divider-box"> <i class="icons icon-book5"></i> 电子门票</div></div>
            <div class="cont">
              <div class="barcode-tips">请出示门票给工作人员核销，才能进场 ( 可截图保存 )</div>
              <img id="barcode"/>
              <img class="tips-img" v-show="beautifyTicketStatus() === '已过期'" src="../assets/zixun/overdue.png">
              <img class="tips-img" v-show="beautifyTicketStatus() === '已使用'" src="../assets/zixun/use.png">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-show="isEmpty(ticket)" style="text-align:center;line-height:10rem;font-size:.5rem;">门票不存在</div>
  </div>
  <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  <x-loading v-show="showXLoading"></x-loading>

</section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import { Loading } from 'vux'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
// import { prefixUrl } from '@/utils/env'
import { ajaxZixunTicketInfo } from '../api/getData'
var JsBarcode = require('jsbarcode')

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      code: '', // 二维码
      ticket: {} // 门票信息
    }
  },
  created () {
    if (!isEmpty(this.$route.query.code)) {
      this.code = this.$route.query.code
    } else {
      this.$router.go(-1)
    }
    this.initData()
  },
  computed: {
  },
  updated () {
    var self = this
    self.showBarcode(self.code)
  },
  methods: {
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    },
    showBarcode (val) {
      if (val === 0) {
        return
      }
      JsBarcode('#barcode', val, {
        format: 'CODE128',
        displayValue: true,
        fontSize: 24,
        lineColor: '#000'
      })
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
    initData () { // 初始化数据
      var self = this
      ajaxZixunTicketInfo(self.code).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.ticket)) {
            self.ticket = data.obj.ticket
            console.log(self.ticket)
            self.code = self.ticket.code
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    }
  }
}
</script>

</script>
<style lang="less" scoped>
.zixunTicketInfo{
  color: #0b1e30;
}
.m2{
  margin: 0 .2rem;
}
.top{
  min-height: 1.4rem;
  background: #fff;
  position: relative;
  border-bottom: 1px dotted #e8e8e8;
}
.thumbnail{
  width: 1rem;
  height: 1rem;
  position: absolute;
  top: .2rem;
  left: .2rem;
}
.top span{
  padding-top: .3rem;
  margin-left: 1.4rem;
  display: block;
}
.title{
  line-height: .5rem;
  font-size: .2rem;
  text-indent: .2rem;
  color: #aeaeae;
}
.main{
  background: #fff;
  margin-top: .3rem;
}
.info-item{
  line-height: .7rem;
  border-top: 1px solid #e8e8e8;
  padding-left: .4rem;
  position: relative;
}
.info-item .s-icons{
  position: absolute;
  top: .24rem;
  left: .14rem;
}
.info-item:first-child{
  border-top: 0;
}
.barcode{    
  background: radial-gradient(rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) .08rem, #fff .08rem);
  background-size: .24rem .18rem;
  background-position: -.1rem -.14rem;
  margin-top: .3rem;
  text-align: center;
}
.barcode-bg{    
  background: #fff;
  margin: 0 .12rem;
  padding-bottom: .17rem;
}
.barcode-bg .cont{
  position: relative;
}
.barcode-tips{
  color: #aeaeae;
  font-size: .2rem;
  text-align: left;
  text-indent: .5rem;
  margin-bottom: -.1rem;
  position: relative;
  z-index: 1;
}
.barcode-tips:before{
  content: '';
  width: .06rem;
  height: .06rem;
  background: #384275;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  top: .08rem;
  left: .35rem;
}
.divider{
  display: table;
  white-space: nowrap;
  height: auto;
  overflow: hidden;
  text-align: center;
  color: #666;
  padding: .2rem 0;
}
.divider:after, .divider:before {
    content: '';
    display: table-cell;
    position: relative;
    width: 50%;
    border-bottom: .02rem solid #e8e8e8;
    transform: translateY(-50%);
    -ms-transform: translateY(-50%); /* IE 9 */
    -moz-transform: translateY(-50%); /* Firefox */
    -webkit-transform: translateY(-50%); /* Safari 和 Chrome */
    -o-transform: translateY(-50%); /* Opera */
}
.divider-box{
    padding: 0 .2rem;
    color: #384275;
    line-height: .3rem;
}
.tips-img{
    width: 1rem;
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 999;
}
.fs-022 { font-size: .22rem; }
</style>
