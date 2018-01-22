<template>
  <section>
    <div class="insuranceDetail">
      <div class="header"></div>
      <div>
        <div class="row-1 clearfix">
          <div class="row-1-left">
            <span class="fs-06 color-1">￥99</span>
            <span>1-3万运费险(单次)</span>
          </div>
          <div class="img"><img src="../../assets/car/icon8.png" class="icon"></div>
          <div class="list">
            <p>· 10万元意外伤害保障(意外医疗伤残与事故)</p>
            <p>· 10万元意外伤害保障(意外医疗伤残与事故)</p>
          </div>
        </div>

        <div class="row-2">
          <div class="title">产品介绍</div>
          <div class="row-content">包含意外险、运费保、放空险，意外伤亡补助、医疗费及住院津贴、意外货损的运费损失。</div>
        </div>

        <div class="row-2 padding-b">
          <div class="title">理赔须知</div>
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
        
      </div>
      <div></div>
      <div></div>
      <div class="footer clearfix">
        <div class="footer-text">更多运费险</div>
        <div class="btn-buy">立即购买(保费￥99)</div>
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
  background: url('../../assets/car/bg-1.png') no-repeat;
  background-size: 100%;
}
.row-1 {
  margin-bottom: .1rem;
  padding: .15rem;
  background: white;
}
.row-1-left {
  float: left;
  width: 4.8rem;
  padding-right: .2rem;
}
.img {
  width: 1.2rem;
  height: .5rem;
  float: left;
}
.icon {
  width: 100%;
}
.list {
  float: left;
  // width: 4.5rem;
  width: 100%;
  margin-right: .2rem;
  padding:.1rem;
  font-size: .26rem;
  background: #f4f9ff;
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
  font-size: .26rem;
}
.footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: .8rem;
  background: white;
  border-top: 1px solid #f5f5f5;
}
.footer-text {
  float: left;
  width: 2rem;
  margin-top: .2rem;
  margin-left: .2rem;
  color: #777777;
  font-size: .24rem;
}
.footer-text::before {
  content: '';
  display: inline-block;
  width: .15rem;
  height: .15rem;
  border-left: 1px solid #777777;
  border-bottom: 1px solid #777777;
  transform: rotate(45deg);
  margin-right: .05rem;
}
.btn-buy {
  display: inline-block;
  float: right;
  margin-top: .1rem;
  margin-right: .15rem;
  padding: .1rem .15rem;
  background: #5699ff;
  color: white;
  border-radius: 3px;
}
.padding-b {padding-bottom: .8rem;}
.fs-06 {font-size: .6rem;}
.color-1 {color: red;}
</style>

