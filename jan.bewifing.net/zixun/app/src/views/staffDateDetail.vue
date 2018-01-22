<template>
  <section class="staffDateDetail">
    <group title="日期设置">
      <cell title="title" :value="doorDate.name">
        <span slot="title" style="color:green;">
          <span style="vertical-align:middle;">日期</span> 
        </span>
      </cell>
    </group>

    <group title="时段管理">
      <x-switch :title="getStamp(item.time,'hm')" :value-map="['0', '1']" v-model="item.is_rest" v-for="(item,index) in door_times" :key="index" @on-change="updateTime(item.is_rest,item.id)"></x-switch>
    </group>

    <group title="正常开放">
      <x-switch title="正常开放" :value-map="['0', '1']" v-model="doorDate.is_rest" @on-change="updateDate(doorDate.is_rest)"></x-switch>
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
// import { prefixUrl } from '@/utils/env'
import { manageDoorDateDetail } from '../api/getData'
import { Loading, Group, Cell, Badge, XSwitch } from 'vux'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Group,
    Cell,
    Badge,
    XSwitch
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
      doorDate: {}, // 日期列表
      door_date_id: 0,
      is_rest: 0,
      door_times: [],
      value1: true
    }
  },
  created () {
    if (!isEmpty(this.$route.query.door_date_id)) {
      this.door_date_id = this.$route.query.door_date_id
    } else {
      this.$router.go(-1)
    }
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
    updateDate (val) { // 更新日期
      var self = this
      self.type = 'updateDate'
      var isRest = 1
      if (val) {
        isRest = 0
      }
      var object = {
        door_date_id: self.door_date_id,
        is_rest: isRest // self.is_rest
      }
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageDoorDateDetail(object)
    },
    updateTime (val, id) { // 更新时间
      var self = this
      self.type = 'updateTime'
      var isRest = 1
      if (val) {
        isRest = 0
      }
      var object = {
        door_time_id: id, // self.door_date_id,
        is_rest: isRest // self.is_rest
      }
      self.showLoadingText = '提交中...'
      self.showLoading = true
      self.manageDoorDateDetail(object)
    },
    manageDoorDateDetail (object) {
      var self = this
      manageDoorDateDetail(self.type, object).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    },
    goToPage () {
      this.updateTime()
    },
    fetchData () {
      var self = this
      var object = {
        door_date_id: self.door_date_id
      }
      manageDoorDateDetail(self.type, object).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.doorDate)) {
            self.doorDate = data.obj.doorDate
            if (self.doorDate.is_rest === 1) {
              self.doorDate.is_rest = false
            } else {
              self.doorDate.is_rest = true
            }
            if (!isEmpty(data.obj.doorDate.door_times)) {
              for (var i = data.obj.doorDate.door_times.length - 1; i >= 0; i--) {
                if (data.obj.doorDate.door_times[i].is_rest === 1) {
                  data.obj.doorDate.door_times[i].is_rest = false
                } else {
                  data.obj.doorDate.door_times[i].is_rest = true
                }
              };
              self.door_times = data.obj.doorDate.door_times
            }
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
