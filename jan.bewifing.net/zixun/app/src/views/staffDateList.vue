<template>
  <section class="staffDateList">

    <group title="日期管理">
      <cell title="title" :value="item.is_rest === 1 ? '休息' : '正常开放'" is-link @click.native="goToPage('staffDateDetail',item.id)" v-for="(item,index) in doorDateList" :key="index">
        <span slot="title" style="color:green;">
          <span style="vertical-align:middle;">{{item.name}}</span> 
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
import { manageDoorDateList } from '../api/getData'
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
      doorDateList: [] // 日期列表
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
    goToPage (url, id) { //
      this.$router.push({path: prefixUrl + '/' + url, query: {door_date_id: id}})
    },
    fetchData () {
      var self = this
      manageDoorDateList().then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.doorDateList)) {
            self.doorDateList = data.obj.doorDateList
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
</style>
