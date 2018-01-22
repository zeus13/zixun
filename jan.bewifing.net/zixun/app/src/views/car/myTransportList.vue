<template>
  <section>
    <div class="nav-bar">
      <div class="nav-i">全部</div>
      <div class="nav-i border-both">待处理</div>
      <div class="nav-i">已完成</div>
    </div>

    <div class="address-div">
      <div class="row-title clearfix"><span class="fl">订单号：201801018001</span><span class="fr">2018-01-18</span></div>
      <div class="row-header">
        <div class="row-header-item border-r">
          <div class="item-title1 font-weight">南宁</div>
          <div class="address">青秀区民族大道阳光城市广场100TC313</div>
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
        <span class="fr fs-024">运费 <span>￥60000</span></span>
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
.nav-bar {
  display: flex;
  flex-direction: row;
  padding: .15rem;
  background: white;
}
.nav-i {
  flex-grow: 1;
  text-align: center;
}
.address-div {
  margin-top: .1rem;
  background: white;
}
.row-header {
  display: flex;
  flex-direction: row;
  padding: .15rem;
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
  margin-right: .05rem;
}
.item-title2::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../../assets/car/icon6.png') no-repeat;
  background-size: 100%;
  vertical-align: middle;
  margin-right: .05rem;
}
.address {
  width: 2.8rem;
  padding: .1rem;
  text-align: left;
  font-size: .24rem;

}
.row-title {
  padding: .1rem .15rem;
  border-bottom: 1px solid #e0e0e0;
  font-size: .22rem;
}
.row-info {
  padding: .3rem;
  color: #96979c;
  border-bottom: 1px solid #e0e0e0;
  font-size: .24rem;
}
.row-price {
  padding: .15rem .3rem;
  margin-bottom: .2rem;
}
.border-both {
  border-left: 1px solid #eaeaea;
  border-right: 1px solid #eaeaea;
}
.fl {float: left;}
.fr {float: right;}
.border-r {border-right: 1px solid #eaeaea;}
.fs-024 {font-size: .24rem;}
</style>

