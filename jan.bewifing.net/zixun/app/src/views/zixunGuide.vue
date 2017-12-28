<template>
  <section>
    <h1>导航</h1>
    <div class="row" @click="goToIndex">资讯首页</div>
    <div class="row" @click="goToInfo">资讯详情页</div>
    <div class="row" @click="goToSelectTicket">咨询购票</div>
    <div class="row" @click="goToUserHome">个人中心</div>
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
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { ajaxZixunActivityIndex } from '../api/getData'

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
      var self = this
      self.showLoadingText = '提交中'
      self.showLoading = true
      ajaxZixunActivityIndex().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.goodsList)) {
            self.goodsList = data.obj.goodsList
            console.log(self.goodsList)
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    },
    fetchData () { // 初始化数据
      var self = this
      ajaxZixunActivityIndex().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.goodsList)) {
            self.goodsList = data.obj.goodsList
            console.log(self.goodsList)
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    },
    goToIndex () {
      return this.$router.push({path: prefixUrl + '/zixunActivityIndex', query: {}})
    },
    goToInfo () {
      return this.$router.push({path: prefixUrl + '/zixunActivityInfo', query: {act_id: '16'}})
    },
    goToUserHome () {
      return this.$router.push({path: prefixUrl + '/zixunUserHome', query: {}})
    },
    goToSelectTicket () {
      return this.$router.push({path: prefixUrl + '/zixunSelectTicket', query: {act_id: 16}})
    }
  }
}
</script>

<style lang="less" scoped>
h1 {
  text-align: center;
}
.row {
  padding: .1rem;
  font-size: .24rem;
  border-bottom: 1px solid #e0e0e0;
}
</style>
