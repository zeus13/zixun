<template>
  <section>
    <div class="padding-b">
      <div class="header"></div>
        <div class="row">
          <div class="title">投保人信息</div>
          <div class="row-input">
            <div class="input-text">姓名</div>
            <input type="text" placeholder="请填写投保人姓名" class="input">
          </div>
          <div class="row-input">
            <div class="input-text">手机号码</div>
            <input type="text" placeholder="请填写投保人手机号码" class="input">
          </div>
        </div>

        <div class="row">
          <div class="title">被投保人信息</div>
          <div class="row-input">
            <div class="input-text">姓名</div>
            <input type="text" placeholder="请填写被投保人姓名" class="input">
          </div>
          <div class="row-input">
            <div class="input-text">手机号码</div>
            <input type="text" placeholder="请填写手机号码" class="input">
          </div>
          <div class="row-input">
            <div class="input-text">身份证号</div>
            <input type="text" placeholder="请填写身份证号" class="input">
          </div>
          <div class="row-input">
            <div class="input-text">车牌号码</div>
            <input type="text" placeholder="请填写车牌号码" class="input">
          </div>
        </div>

        <div class="row">
          <div class="title">保险信息</div>
          <div class="row-input">
            <div class="input-text">保险套餐</div>
            <div class="row-content">1-3万运费</div>
          </div>
          <div class="row-input">
            <div class="input-text">保险生效</div>
            <div class="row-content">购买成功后次日凌晨生效</div>
          </div>
          <div class="row-input">
            <div class="input-text">保险期限</div>
            <div class="row-content">单次</div>
          </div>
        </div>

        <input type="radio" class="radio"><span class="fs-02">我已认真阅读，理解并同意《<a href="">投保协议</a>》</span>
    </div>

    <div class="footer clearfix">
      <div class="footer-text">保费合计￥99</div>
      <div class="btn-buy">立即支付</div>
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
.row {
  font-size: .24rem;
  background: white;
  margin-top: .1rem;
}
.title {
  padding: .15rem;
  background: #f4f9ff;
  font-size: .26rem;
}
.row-input {
  position: relative;
  padding: .15rem;
  font-size: .28rem;
}
.input-text {
  position: absolute;
  top: .2rem;
  left: .15rem;
  // font-size: .24rem;
}
.input {
  width: 100%;
  line-height: .5rem;
  outline: none;
  border: none;
  padding-left: 1.4rem;
}
.row-content {
  width: 100%;
  padding-left: 1.2rem;
}
.radio {
  margin: .4rem .15rem;
}
.footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: .8rem;
  background: white;
  border-top: 1px solid #f5f5f5;
  font-size: .26rem;
}
.footer-text {
  float: left;
  width: 2rem;
  margin-top: .2rem;
  margin-left: .15rem;
  color: #5699ff;
  // font-size: .24rem;
}
.btn-buy {
  display: inline-block;
  float: right;
  margin-top: .1rem;
  margin-right: .15rem;
  padding: .1rem .8rem;
  background: #5699ff;
  color: white;
  border-radius: 3px;
}
.fs-02 {font-size: .22rem;}
.padding-b {padding-bottom: 1.5rem;}
a,button,input,optgroup,select,textarea {-webkit-tap-highlight-color:rgba(0,0,0,0);}
</style>

