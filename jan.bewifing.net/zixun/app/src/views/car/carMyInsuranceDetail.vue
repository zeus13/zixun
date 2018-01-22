<template>
  <section>
    <div class="row clearfix">
      <div class="col-1">
        <p class="color-1"><span class="fs-03">￥</span><span class="fs-06"><b>99</b></span></p>
        <p class="fs-02">1-3万运费险</p>
        <p class="fs-02">(单次)</p>
      </div>
      <div class="col-2">由平安保险承担</div>
    </div>

    <div class="row-info clearfix">
      <div class="fl">姓名</div>
      <div class="fr">张小单</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">身份证号</div>
      <div class="fr">4501013194510010001</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">手机号码</div>
      <div class="fr">13878907890</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">车牌号码</div>
      <div class="fr">桂A888888</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">保险套餐</div>
      <div class="fr">1-3万运费险</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">保险生效</div>
      <div class="fr">购买成功后次日零时生效</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">保险期限</div>
      <div class="fr">单次</div>
    </div>
    <div class="row-info clearfix">
      <div class="fl">购买时间</div>
      <div class="fr">2018年1月18日 17:52</div>
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
  margin-bottom: .1rem;
  font-size: .24rem;
}
.col-1 {
  width: 2rem;
  text-align: center;
  float: left;
}
.col-2 {
  float: right;
  margin-top: .2rem;
  margin-right: .2rem;
  color: #777777;
  font-size: .26rem;
}
.row-info {
  padding: .15rem;
  font-size: .28rem;
  background: white;
  border-bottom: 1px solid #e6e6e6;
}
.fl {float: left;}
.fr {float: right}
.margin-b {margin-bottom: .1rem;}
.color-1 {color: red;}
.fs-06 {font-size: .6rem;}
.fs-03 {font-size: .3rem;}
.fs-02 {font-size: .2rem;}
</style>

