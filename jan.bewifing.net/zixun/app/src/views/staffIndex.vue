<template>
  <section class="staffIndex">

    <group title="订单管理">
      <cell title="title" value="" is-link @click.native="goToPage('staffOrderList',0)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">新订单</span> 
        </span>
        <badge :text="payOrder"></badge>
      </cell>
      <cell title="title" value="" is-link @click.native="goToPage('staffOrderList',1)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">已接单</span> 
        </span>
        <badge :text="getOrder"></badge>
      </cell>
      <cell title="title" value="" is-link @click.native="goToPage('staffOrderList',2)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">正在服务</span> 
        </span>
        <badge :text="sendOrder"></badge>
      </cell>
      <cell title="title" value="" is-link @click.native="goToPage('staffOrderList',3)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">已完成</span> 
        </span>
        <badge :text="completeOrder"></badge>
      </cell>
      <cell title="title" value="" is-link @click.native="goToPage('staffOrderList',4)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">已取消</span> 
        </span>
      </cell>
      <cell title="title" value="" is-link @click.native="goToPage('staffOrderList',5)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">已退款</span> 
        </span>
      </cell>
    </group>

    <group title="日期管理">
      <cell title="title" value="" is-link @click.native="goToPage('staffDateList',0)">
        <span slot="title" style="color:#bfbfbf;">
          <span style="vertical-align:middle;">日期列表</span> 
        </span>
      </cell>
    </group>

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
import { manageIndex } from '../api/getData'
import { Loading, Group, Cell, Badge } from 'vux'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Group,
    Cell,
    Badge
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
      payOrder: 0, // 新订单数量
      getOrder: 0, // 已接单数量
      sendOrder: 0, // 正在服务数量
      completeOrder: 0 // 已完成数量
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
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    goToPage (url, status = 0) { //
      this.$router.push({path: prefixUrl + '/' + url, query: {status: status}})
    },
    fetchData () {
      var self = this
      manageIndex().then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.payOrder)) {
            self.payOrder = data.obj.payOrder
          }
          if (!isEmpty(data.obj.getOrder)) {
            self.getOrder = data.obj.getOrder
          }
          if (!isEmpty(data.obj.sendOrder)) {
            self.sendOrder = data.obj.sendOrder
          }
          if (!isEmpty(data.obj.completeOrder)) {
            self.completeOrder = data.obj.completeOrder
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

<style lang="less" scoped>
.vux-label span{
  color: #3a3a3a;
  font-size: 14px;
}
</style>
