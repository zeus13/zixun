<template>
  <section>
    <div class="content">
      <div class="header"></div>
      <div class="content-text">恭喜您，接单成功！</div>
      <div class="row-btn">
        <span class="btn" @click="goToInsuranceList">购买运费险</span>
        <span class="btn" @click="goToCarRecharge">充值去加油</span>
      </div>
      <div class="row-more">
        <div class="row-title">更多功能</div>
        <div class="list clearfix">
          <div class="list-i" @click="clickMyTransportList">
            <img src="../../assets/car/icon12.png" class="icon3">
            <div>我的运单</div>
          </div>
          <div class="list-i" @click="clickMyInsuranceList">
            <img src="../../assets/car/icon13.png" class="icon3">
            <div>我的运费险</div>
          </div>
          <div class="list-i" @click="clickRechargeRecord">
            <img src="../../assets/car/icon13.png" class="icon3">
            <div>充值记录</div>
          </div>
          <div class="list-i" @click="clickMyTransportList">
            <img src="../../assets/car/icon12.png" class="icon3">
            <div>我的运单</div>
          </div>
          <div class="list-i" @click="clickMyInsuranceList">
            <img src="../../assets/car/icon13.png" class="icon3">
            <div>我的运费险</div>
          </div>
          <div class="list-i" @click="clickRechargeRecord">
            <img src="../../assets/car/icon13.png" class="icon3">
            <div>充值记录</div>
          </div>
        </div>
        <div class="footer">
          <div class="btn-server" @click="clickServer">联系客服</div>
          <p class="color-1">服务时间：8:00-18:00</p>
        </div>
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
    goToInsuranceList () {
      return this.$router.push({path: prefixUrl + '/carInsuranceList', query: {}})
    },
    goToCarRecharge () {
      return this.$router.push({path: prefixUrl + '/carRecharge', query: {}})
    },
    clickServer () {
      return alert('客服小姐姐还没有上班')
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
.content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding-top: 1.5rem;
  background: white;
}
.header {
  width: 1.5rem;
  height: 1.5rem;
  background: url('../../assets/car/icon16.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: -.75rem;
  left: 50%;
  margin-left: -.75rem;
}
.content-text {
  position: relative;
  top: -.5rem;
  margin: .3rem;
  text-align: center;
  font-size: .3rem;
}
.row-btn {
  display: flex;
  flex-direction: row;
}
.btn {
  flex-grow: 1;
  margin: 0 .6rem;
  padding: .1rem .3rem;
  background: #5699ff;
  color: white;
  text-align: center;
  border-radius: 5px;
}
.row-more {
  position: relative;
  background: white;
  font-size: .22rem;
  margin-top: .8rem;
}
.row-title {
  padding: .15rem;
  font-size: .26rem;
  background: #f4f9ff;
}
.list {
  width: 100%;
  min-height: 2rem;
  background: white;
  text-align: center;
  padding: 0 .15rem;
  position: relative;
}
.list-i {
  float: left;
  width: 25%;
  padding-top: .3rem;
  font-size: .26rem;
}
.icon3 {
  width: .5rem;
  height: .5rem;
}
.footer {
  width: 100%;
  padding: .45rem 0 .4rem 0;
  text-align: center;
  font-size: .22rem;
  background: white;
}
.btn-server {
  margin: .1rem 2.2rem;
  padding: .1rem;
  background: #e9f2ff;
  color: #5699ff;
}
.btn-server::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../../assets/car/icon14.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .03rem;
  left: -.1rem;
}
.color-1 {color: #adadad}
</style>

