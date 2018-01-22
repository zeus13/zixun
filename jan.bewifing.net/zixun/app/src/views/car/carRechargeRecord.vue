<template>
  <section>
    <div class="row clearfix">
        <img src="../../assets/car/icon15.png" class="icon">
        <div class="fl">
          <span class="col-left-text">油卡充值</span>
          <div class="color-1">2018-01-18</div>
        </div>
      <span class="col-right">+500元</span>
    </div>
    <div class="row clearfix">
        <img src="../../assets/car/icon15.png" class="icon">
        <div class="fl">
          <span class="col-left-text">油卡充值</span>
          <div class="color-1">2018-01-18</div>
        </div>
      <span class="col-right">+500元</span>
    </div>
    <div class="row clearfix">
        <img src="../../assets/car/icon15.png" class="icon">
        <div class="fl">
          <span class="col-left-text">油卡充值</span>
          <div class="color-1">2018-01-18</div>
        </div>
      <span class="col-right">+500元</span>
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
.row {
  padding: .15rem;
  background: white;
  border-bottom: 1px solid #f5f5f5;
}
.col-right {
  float: right;
  margin-top: .2rem;
  margin-right: .2rem;
}
.icon {
  width: .5rem;
  height: .3rem;
  margin-top: .05rem;
  margin-right: .05rem;
  vertical-align: middle;
  float: left;
}
.fl {
  float: left;
}
.color-1 {color: #989898;}
</style>

