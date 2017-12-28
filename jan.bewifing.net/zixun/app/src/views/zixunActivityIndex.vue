<template>
  <section class="zixunActivityIndex">
    <div class="row cb">
      <span class="row-col" :class="{choosed: isChoosed===1}" @click="clickChoosed(1)">精选</span>
      <span class="row-col" :class="{choosed: isChoosed===2}" @click="clickChoosed(2)">往期</span>
      <span class="row-col-right" @click="goToUserHome">我的</span>
    </div>
    <div class="list" v-for="(item, index) in activityList" :key="index">
      <!-- 精选 -->
      <div class="list-item clearfix" @click="goToInfo(item.id)" v-if="item.status === 1" v-show="isChoosed===1">
        <div class="list-item-img" v-bind:style="{'background':'url('+item.thumbnail[0]+'?imageView2/1/w/280/h/214) no-repeat','background-size':'cover','background-position':'50%'}">
          <!-- <img :src="item.thumbnail[0]" class="img"> -->
        </div>
        <div class="list-item-right">
          <h2 class="ac-title">{{item.name}}</h2>
          <p class="place">{{item.place}}</p>
          <p class="tips fs-024">{{item.home_tips}}</p>
        </div>
      </div>
      <!-- 往期活动 -->
      <div class="list-item clearfix" @click="goToInfo(item.id)" v-else v-show="isChoosed===2">
        <div class="list-item-img" v-bind:style="{'background':'url('+item.thumbnail[0]+'?imageView2/1/w/280/h/214) no-repeat','background-size':'cover','background-position':'50%'}">
          <!-- <img :src="item.thumbnail[0]" class="img"> -->
        </div>
        <div class="list-item-right">
          <h2 class="ac-title">{{item.name}}</h2>
          <p class="place">{{item.place}}</p>
          <p class="tips fs-024">活动已结束</p>
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
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { ajaxZixunActivityIndex, ajaxZixunGetJssdk } from '../api/getData'
import wx from 'weixin-js-sdk'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: true, // 是否显示加载动画
      showLoading: false, // 是否显示数据加载中弹窗
      showLoadingText: '', // 加载中弹窗文字
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      activityList: [],
      isChoosed: 1
    }
  },
  created () {
    this.getJssdk()
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
    // updateFun () { // 更新数据
    //   var self = this
    //   self.showLoadingText = '提交中'
    //   self.showLoading = true
    //   getGoodsIndex().then(response => {
    //     var data = response.data
    //     if (data.code === 200) {
    //       if (!isEmpty(data.obj.goodsList)) {
    //         self.goodsList = data.obj.goodsList
    //         console.log(self.goodsList)
    //       }
    //     } else {
    //       self.openPopupFun('alert', data.msg, 2)
    //     }
    //     self.showLoading = false
    //   })
    // },
    getJssdk () {
      ajaxZixunGetJssdk().then(response => {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          wx.config(JSON.parse(result.obj.jssdk))
        }
      })
    },
    fetchData () { // 初始化数据
      var self = this
      ajaxZixunActivityIndex().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.activityList)) {
            self.activityList = data.obj.activityList
            console.log(self.activityList)
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    },
    goToInfo (id) {
      console.log('act_id:', id)
      return this.$router.push({path: prefixUrl + '/zixunActivityInfo', query: {act_id: id}})
    },
    goToUserHome () {
      return this.$router.push({path: prefixUrl + '/zixunUserHome', query: {}})
    },
    clickChoosed (val) {
      this.isChoosed = val
    }
  }
}
</script>

<style lang="less" scoped>
.row {
  padding: .1rem;
  background: white;
  font-size: .26rem;
}
.row-col {
  margin: .1rem;
  padding: .1rem;
  color: #797979;
}
.row-col-right {
  padding: 0 .1rem;
  float: right;
  color: red;
  border-left: 1px solid red;
}
.row-col-right::before {
  content: '';
  display: inline-block;
  width: .35rem;
  height: .35rem;
  background: url('../assets/zixun/icon-user-red.png');
  background-size: 100%;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
  margin-right: .08rem;
  margin-left: .08rem;
}
.list {
  margin: .2rem .2rem 0 .2rem;
}
.list-item {
  width: 100%;
  background: white;
  margin-top: .2rem;
}
.list-item-img {
  width: 2.5rem;
  height: 2.14rem;
  float: left;
}
.list-item-right {
  float: left;
  width: 3.4rem;
  padding-left: .1rem;
  font-size: .2rem;
  color: #6f6f6f;
}
.ac-title {
  margin-top: .1rem;
  height: .7rem;
  overflow: hidden;
  font-size: .24rem;
}
.place {
  height: .6rem;
  margin-top: .1rem;
  overflow: hidden;
}
.place::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../assets/zixun/icon-map.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .05rem;
  margin-right: .05rem;
}
.tips {
  margin-top: .2rem;
  color: red;
  font-weight: bolder;
}
.img {
  width: 100%;
  vertical-align: middle;
}
.choosed {
  border-bottom: 2px solid #384275;
  color: #384275;
}
.support {
  font-family: "Microsoft YaHei", Arial, sans-serif;
  text-align: center;
  color: rgb(156, 156, 156);
  margin: .2rem 0;
  font-size: .2rem;
  position: fixed;
  bottom: 0;
  width: 100%;
}
.cb {
  clear: both;
}
.fs-024 { font-size: .24rem; }
</style>
