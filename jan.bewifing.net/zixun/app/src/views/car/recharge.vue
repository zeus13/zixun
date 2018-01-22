<template>
  <section>
    <div class="header"></div>
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
      <div class="row-oilcard">
        <div class="row-card-2">
          <img src="../../assets/car/icon11.png" class="icon2">
          <div class="row-oilcard-text">654458484 545478 484848 458454</div>
        </div>
      </div>
      <div class="row-oilcard">
        <div class="row-card-2">
          <img src="../../assets/car/icon11.png" class="icon2">
          <div class="row-oilcard-text">654458484 545478 484848 458454</div>
        </div>
      </div>
      <div class="row-oilcard">
        <div class="row-card-2">
          <img src="../../assets/car/icon11.png" class="icon2">
          <div class="row-oilcard-text">654458484 545478 484848 458454</div>
        </div>
      </div>
      <div class="operation">
        <span class="btn-add">+ 添加油卡</span>
        <span class="btn-del">- 删除油卡</span>
      </div>
    </div>

    <div class="row-car">
      <div class="row-title clearfix">充值油卡<span class="row-title-r">充值记录</span></div>
      <div class="list clearfix">
        <div class="list-i">100元</div>
        <div class="list-i">200元</div>
        <div class="list-i">300元</div>
        <div class="list-i">500元</div>
        <div class="list-i">600元</div>
        <div class="list-i">其他金额</div>
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
.header {
  width: 100%;
  height: 2.1rem;
  background: url('../../assets/car/bg-4.png') no-repeat;
  background-size: 100%;
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
.row-title-r {
  float: right;
  margin-right: .3rem;
  color: #adadad;
}
.row-title-r::after {
  content: '';
  display: inline-block;
  width: .15rem;
  height: .15rem;
  border-right: 1px solid #adadad;
  border-bottom: 1px solid #adadad;
  transform: rotate(-45deg);
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
.row-card {
  margin: .1rem;
  border: 1px solid #ffce24;
}
.row-oilcard-text {
  padding-left: .7rem;
}
.row-card-2 {
  margin: .1rem;
  border: 1px solid #adadad;
}
.icon2 {
  position: absolute;
  width: .5rem;
  height: .35rem;
  top: .08rem;
  left: .2rem;
}
// .btn-del {
//   position: absolute;
//   top: .01rem;
//   right: .1rem;
//   padding: 0 .2rem;
//   height: .5rem;
//   background: #ffce24;
// }
// .btn-del2 {
//   position: absolute;
//   top: .01rem;
//   right: .1rem;
//   padding: 0 .2rem;
//   height: .5rem;
//   background: #adadad;
// }
// .btn-add {
//   margin: .2rem 2rem;
//   padding: .1rem;
//   text-align: center;
//   background: #5699ff;
//   border-radius: 5px;
// }
.operation {
  display: flex;
  flex-direction: row;
  padding: .15rem;
  text-align: center;
}
.btn-add {
  flex-grow: 1;
  margin: 0 .5rem;
  padding: .1rem;
  background: #5699ff;
  color: white;
  border-radius: 5px;
}
.btn-del {
  flex-grow: 1;
  margin: 0 .5rem;
  padding: .1rem;
  background: red;
  color: white;
  border-radius: 5px;
}
.list {
  position: relative;
  padding: .15rem;
}
.list-i {
  float: left;
  width: 1.73rem;
  margin: .15rem;
  padding: .3rem;
  text-align: center;
  border: 1px solid #f7a58c;
  border-radius: 5px;
}
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
.color-1 {color: #adadad}
</style>

