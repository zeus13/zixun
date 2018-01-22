<template>
  <section>
    <div class="row" @click="goToDetail">
      <div class="row-up clearfix">
        <div class="row-up-left">
          <div class="row-up-left-i">
            <p class="fs-03 color-1">￥<b class="fs-06">99</b></p>
            <p>1-3万运费险</p>
            <p>(单次)</p>
          </div>
        </div>
        <div class="row-up-right">
          <div class="row-text border-b clearfix"><span>投保限额:200万</span><span class="text-right">保险费率:0.02%</span></div>
          <div class="row-text clearfix">
            <div class="fl">
              <p>最高免赔</p>
              <p class="color-2">(两者取高)</p>
            </div>
            <div class="row-text-right">
              <ul>
                <li>交通事故(2000元/损失金额10%)</li>
                <li>火灾事故(损失金额20%)</li>
              </ul>
              <!-- <p>交通事故(2000元/损失金额10%)</p>
              <p>火灾事故(损失金额20%)</p> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="row-up clearfix">
        <div class="row-up-left">
          <div class="row-up-left-i">
            <p class="fs-03 color-1">￥<b class="fs-06">99</b></p>
            <p>1-3万运费险</p>
            <p>(单次)</p>
          </div>
        </div>
        <div class="row-up-right">
          <div class="row-text border-b clearfix"><span>投保限额:200万</span><span class="text-right">保险费率:0.02%</span></div>
          <div class="row-text clearfix">
            <div class="fl">
              <p>最高免赔</p>
              <p class="color-2">(两者取高)</p>
            </div>
            <div class="row-text-right">
              <p>交通事故(2000元/损失金额10%)</p>
              <p>火灾事故(损失金额20%)</p>
            </div>
          </div>
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
    goToDetail () {
      return this.$router.push({path: prefixUrl + '/carMyInsuranceDetail', qeury: {}})
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
  margin: .1rem;
  background: white;
}
.row-up {
  padding: .1rem .15rem;
  border-bottom: 1px solid #eaeaea;
  font-size: .26rem;
}
.row-up-left {
  float: left;
  width: 1.5rem;
  text-align: center;
  margin-right: .2rem;
  position: relative;
}
.row-up-left-i {
  position: relative;
  top: 0;
  left: 0;
}

.row-up-right {
  float: left;
  width: 4.2rem;
}
.row-text {
  padding: .1rem .15rem;
  line-height: .5rem;
  background: #e9f2ff;
}
.text-right {
  float: right;
  margin-right: .1rem;
}
.row-text-right {
  float: left;
  width: 2.68rem;
  padding-left: .1rem;
}
.row-bottom {
  padding: .15rem;
}
.btn-insure {
  margin: 0 2rem;
  padding: .05rem;
  text-align: center;
  background: #5699ff;
  color: white;
  border-radius: 5px;
}
ul li {
  margin-left: .3rem;
  text-indent: -5px;
}
.fl {float: left;}
.margin-l02 {margin-left: .2rem;}
.fs-06 {font-size: .6rem;}
.fs-03 {font-size: .3rem;}
.color-1 {color: red;}
.color-2 {color: #989898;}
.border-b {border-bottom: 1px solid #ffffff;}
</style>

