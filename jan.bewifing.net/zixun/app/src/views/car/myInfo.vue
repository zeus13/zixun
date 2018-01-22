<template>
  <section>
    <div class="row clearfix">
      <div class="row-img"><img src="../../assets/car/100.jpg" class="img"></div>
      <div class="col-1">
        <p>我是火车司机</p>
        <p>13878907890</p>
      </div>
      <div class="col-2">未认证</div>
    </div>

    <div class="row-car">
      <div class="row-title">我的车辆</div>
      <div class="row clearfix border-b">
        <img src="../../assets/car/icon9.png" class="icon">
        <div>
          <p>江淮帅铃K载货车（桂A N66888）</p>
          <p>车长4.3米，载重10吨</p>
        </div>
      </div>
      <div class="row clearfix border-b">
        <img src="../../assets/car/icon9.png" class="icon">
        <div>
          <p>江淮帅铃K载货车（桂A N66888）</p>
          <p>车长4.3米，载重10吨</p>
        </div>
      </div>
    </div>

    <div class="row-car">
      <div class="row-title clearfix">我的油卡</div>
      <div class="row-oilcard">
        <div class="row-card">
          <img src="../../assets/car/icon10.png" class="icon2">
          <div class="row-oilcard-text">654458484 545478 484848 458454</div>
        </div>
      </div>
      <div class="row-oilcard">
        <div class="row-card-2">
          <img src="../../assets/car/icon11.png" class="icon2">
          <div class="row-oilcard-text">654458484 545478 484848 458454</div>
        </div>
      </div>
    </div>

    <div class="row-more">
      <div class="row-title">更多</div>
      <div class="list clearfix">
        <div class="list-i">
          <img src="../../assets/car/icon12.png" class="icon3">
          <div>购买车险</div>
        </div>
        <div class="list-i">
          <img src="../../assets/car/icon13.png" class="icon3">
          <div>购买车险</div>
        </div>
      </div>
      <div class="footer">
        <div class="btn-server">联系客服</div>
        <p class="color-1">服务时间：8:00-18:00</p>
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
.row {
  padding: .15rem .2rem;
  background: white;
  font-size: .22rem;
}
.row-img {
  float: left;
  width: .6rem;
  height: .6rem;
  margin-right: .1rem;
}
.img {
  width: 100%;
  border-radius: 50%;
}
.col-1 {
  float: left;
}
.col-2 {
  float: right;
  margin-top: .15rem;
  margin-right: .2rem;
  color: red;
}
.col-2::after {
  content: '';
  display: inline-block;
  width: .15rem;
  height: .15rem;
  border-right: 1px solid red;
  border-bottom: 1px solid red;
  transform: rotate(-45deg);
}
.row-car {
  background: white;
  font-size: .22rem;
  margin-top: .05rem;
  padding-bottom: .1rem;
}
.row-title {
  padding: .15rem;
  font-size: .22rem;
  background: #f4f9ff;
}
.icon {
  width: .5rem;
  height: .35rem;
  float: left;
  margin-top: .1rem;
  margin-right: .2rem;
}
.row-oilcard {
  position: relative;
  background: white;
  font-size: .22rem;
  line-height: .5rem;
}
.icon2 {
  position: absolute;
  width: .5rem;
  height: .35rem;
  top: .08rem;
  left: .2rem;
}
.row-oilcard-text {
  padding-left: .7rem;
}
.row-card {
  margin: .1rem;
  border: 1px solid #ffce24;
}
.row-card-2 {
  margin: .1rem;
  border: 1px solid #adadad;
}
.list {
  width: 100%;
  min-height: 2rem;
  background: white;
  text-align: center;
  padding: .3rem .15rem;
}
.list-i {
  width: 25%;
  float: left;
  font-size: .22rem;
}
.icon3 {
  width: .4rem;
  height: .4rem;
}
.row-more {
  background: white;
  font-size: .22rem;
  margin-top: .05rem;
  padding-bottom: .8rem;
}
// .footer {
//   position: fixed;
//   bottom: .3rem;
//   width: 100%;
//   text-align: center;
//   font-size: .22rem;
// }
.footer {
  position: relative;
  width: 100%;
  margin-top: .2rem;
  text-align: center;
  font-size: .22rem;
}
.btn-server {
  margin: 0 2.2rem;
  padding: .1rem;
  background: #e9f2ff;
  color: #5699ff;
}
.btn-server::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../../assets/car/icon14.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .03rem;
  left: -.1rem;
}
.border-b {border-bottom: 1px solid #f3f3f3;}
.color-1 {color: #adadad}
</style>
