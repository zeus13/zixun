<template>
  <section class="profitList">
    <div v-if="!showXLoading">
      <div class="profitList-title">我的收益</div>
      <div class="profitList-box" v-show="!isEmpty(profitList)">
        <div class="profitList-item" v-for="(item,index) in profitList" :key="index">
          <h3>{{item.order.member_name}}购买了 {{item.order.full_name}} </h3>
          <span class="fr">+{{item.order.total_price * 0.1 / 100}}</span>
          <p>{{getStamp(item.created_at,'ymdhms')}} <span class="fr"></span></p>
        </div>
      </div>

      <div class="no-data" v-show="isEmpty(profitList)">还没有相关数据...</div>
      
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
import { getBalanceList } from '../api/getData'
import { Loading } from 'vux'

export default {
  components: {
    XLoading,
    Loading,
    Popup
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
      profitList: [] // 订单列表
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
    goHome () { // 返回首页
      this.$router.push({path: prefixUrl + '/goodsIndex', query: {}})
    },
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
    fetchData () {
      var self = this
      self.showLoadingText = '加载中...'
      self.showLoading = true
      getBalanceList().then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.balanceLogList)) {
            self.profitList = data.obj.balanceLogList
          }
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.profitList-title {
  color: #999;
  padding-left: 15px;
  padding-top: 8px;
  position: relative;
  border-bottom: 1px solid #eee;
}
.profitList-box {
  background: #fff;
}
.profitList-item {
  padding: 5px 15px;
  position: relative;
}
.profitList-item h3{
  font-size: .24rem;
  width: 5rem;
  overflow: hidden;
  height: .36rem;
}
.profitList-item p{
  font-size: .24rem;
  color: #aaa;
}
.profitList-item:before {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  height: 1px;
  border-top: 1px solid #D9D9D9;
  color: #D9D9D9;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.s-line:before {
  content: " ";
  position: absolute;
  left: 0;
  botttom: 0;
  right: 0;
  height: 1px;
  border-top: 1px solid #D9D9D9;
  color: #D9D9D9;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.fr {
  position: absolute;
  right: .15rem;
  top: .1rem;
}
.no-data {
  text-align: center;
  margin: .6rem 0;
  color: #5c656c;
}
.no-data a {
  color: #5c656c;
  text-decoration: underline;
}
.no-data a:hover {
  color: #5c656c;
}
</style>
