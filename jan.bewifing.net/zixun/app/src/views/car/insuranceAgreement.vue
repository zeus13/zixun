<template>
  <section>
    <div class="header"></div>
    <div class="row-2 padding-b">
      <div class="title">投保协议</div>
      <div class="row-content">
        <p>1.包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</p>
        <p>2.包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</p>
        <p>3.等待保险审核，可能需要补充理赔材料；</p>
        <p>4.等待通知领取赔偿。</p>
        
        <p>1.包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</p>
        <p>2.包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</p>
        <p>3.等待保险审核，可能需要补充理赔材料；</p>
        <p>4.等待通知领取赔偿。</p>
        <p>1.包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</p>
        <p>2.包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</p>
        <p>3.等待保险审核，可能需要补充理赔材料；</p>
        <p>4.等待通知领取赔偿。</p>
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
.header {
  width: 100%;
  height: 1.8rem;
  background: url('../../assets/car/bg-3.png') no-repeat;
  background-size: 100%;
}
.row-2 {
  background: white;
  margin-bottom: .1rem;
}
.title {
  line-height: .5rem;
  text-align: center;
  font-size: .24rem;
  border-bottom: 1px solid #f5f5f5;
}
.title::before {
  content: '';
  display: inline-block;
  width: .2rem;
  height: .3rem;
  background: url('../../assets/car/icon4.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .1rem;
  left: -.05rem;
}
.row-content {
  padding: .15rem;
  font-size: .22rem;
}
</style>

