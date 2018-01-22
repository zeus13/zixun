<template>
  <section>
    <div class="address-div">
      <div class="row-header">
        <div class="row-header-item border-r">
          <div class="item-title1 font-weight">南宁</div>
          <div class="address">青秀区民族大道阳光100TC313</div>
        </div>
        <div class="row-header-item">
          <div class="item-title2 font-weight">成都</div>
          <div class="address">高新科技区新都区物流园</div>
        </div>
      </div>
      <div class="row-info">
        <div>货主：王小芳18608101545</div>
        <div>备注：1.5方，灯具，茶具等</div>
      </div>
      <div class="row-price clearfix">
        <span class="fr">运费 <span>￥60000</span></span>
      </div>
      <div class="content">
        <div class="content-title">运输协议</div>
        <div class="content-main">
          <p>1、本保险保险期限为一年,投保成功后即时生效。</p>
          <p>2、每一被保险人限投一份,多投无效。</p>
          <p>3、本保险合同中的网络支付平台仅指支付宝,且承保仅限于使用支付宝提供的账户余额支付、余额宝支付、快捷支付、集 分宝支付、信用支付和红包支付服务时造成的资金损失。</p>
          <p>4、投保前请仔细阅读本保险产品的适用条款:《网络支付账户资金损失保险条款》, 尤其是其中免除责任的条款。</p>
          <p>5、您投保本保险,须授权支付宝向芝麻信用查询您的信用信息,用于评估保险公司向您承保前述保险的交易条件,控制承 保风险及您是否享有快速理赔等权益,并将相关评估结果提供给您向其投保的保险公司。</p>
          <p>6、为了能让您在芝麻信用处的信用信息及时被支付宝查询,如果您还不是芝麻信用的用户,您应该同意并签订本须知之后 所列的《芝麻信用服务协议》成为芝麻信用用户。如果您已经是芝麻信用用户,您无需重复签订本须知之后所列《芝麻信 用服务协议》。</p>
        </div>
      </div>


      <div class="footer">我已认真阅读,理解并同意</div>

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
.row-header {
  display: flex;
  flex-direction: row;
  padding: .15rem;
  background: white;
  border-bottom: 1px solid #e0e0e0;
}
.row-header-item {
  flex-grow: 1;
  text-align: center;
  margin: .15rem;
}
.item-title1::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../../assets/car/icon5.png') no-repeat;
  background-size: 100%;
  vertical-align: middle;
  position: relative;
  top: -.04rem;
  left: -.05rem;
}
.item-title2::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../../assets/car/icon6.png') no-repeat;
  background-size: 100%;
  vertical-align: middle;
  position: relative;
  top: -.04rem;
  left: -.05rem;
}
.address {
  width: 2.5rem;
  text-align: left;
}
.row-info {
  padding: .3rem;
  background: white;
  color: #96979c;
  border-bottom: 1px solid #e0e0e0;
}
.row-price {
  padding: .15rem .3rem;
  background: white;
  margin-bottom: .2rem;
}
.footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: .8rem;
  background: #5699ff;
  color: white;
  text-align: center;
  line-height: .8rem;
}
.content {background: white;}
.content-title {
  padding: .15rem;
  text-align: center;
  border-bottom: 1px solid #e0e0e0;
}
.content-title::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .3rem;
  background: url('../../assets/car/icon4.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .08rem;
  margin-right: .02rem;
}
.content-main {
  padding: .3rem;
  margin-bottom: 1rem;
  font-size: .26rem;
}
.fr {float: right}
.border-r {
  border-right: 1px solid #e0e0e0;
}
.font-weight {font-weight: bolder;}
</style>

