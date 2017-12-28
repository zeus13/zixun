<template>
  <section class="zixunUserHome">
    <div class="header">
      <div class="header-img">
        <img src="../assets/zixun/0.png" v-if="isEmpty(member.avatar)" class="img">
        <img :src="member.avatar" class="img">
      </div>
      <div class="icon-ask" @click="goToAbout"></div>
      <div class="header-item">
        <p class="username">{{member.name}}</p>
        <div class="btn-edit" @click="goToEdit">编辑资料</div>
      </div>
    </div>

    <!-- 内容 -->
    <div class="column">
      <div class="column-item" :class="{bgWhite: isClick===2}" @click="clicked(1)">
        <img src="../assets/zixun/icon-book2.png" class="icon">
        <p>待参加</p>
      </div>
      <div class="column-item" :class="{bgWhite: isClick===1}" @click="clicked(2)">
        <img src="../assets/zixun/icon-book2.png" class="icon">
        <p>全部票券</p>
      </div>
    </div>
    <!-- 待参加 -->
    <div class="ticket-list">
      <div class="list-item clearfix" v-for="(attendList, index) in attendList" :key="index" v-show="isClick===1" @click="goToTicketInfo(attendList.code)">
        <img :src="attendList.image" class="item-img">
        <div class="item-right">
          <p class="actname">{{attendList.act_name}}</p>
          <p class="acttime">时间：{{attendList.act_time}}</p>
          <p>票号：{{attendList.code}}</p>
          <div class="btn-check">查看票券</div>
        </div>
      </div>
      <div class="list-item clearfix" v-for="(allList, index) in allList" :key="index" v-show="isClick===2" @click="clickActivity(allList.act_id)">
        <img :src="allList.image" class="item-img">
        <div class="item-right">
          <p class="actname">{{allList.act_name}}</p>
          <p class="acttime">时间：{{allList.act_time}}</p>
          <p>票号：{{allList.code}}</p>
          <div class="btn-check">查看详情</div>
        </div>
      </div>
    </div>
    <!-- 全部票券 -->
<!--     <div class="ticket-list" v-show="isClick===2" v-if="">
      <div class="list-item clearfix" v-for="(allList, index) in allList" :key="index">
        <img :src="allList.image" class="item-img">
        <div class="item-right">
          <p class="actname">{{allList.act_name}}</p>
          <p class="acttime">时间：{{allList.act_time}}</p>
          <p>票号：{{allList.code}}</p>
          <div class="btn-check" @click="clickActivity()">查看详情</div>
        </div>
      </div>
    </div> -->
    <div class="text" v-show="isDisplay">
      还没有相关数据，<router-link :to="{name: 'zixunActivityIndex'}">点击查看更多活动……</router-link>
    </div>

    <div class="sidebar">
      <div class="btn-index" @click="goToIndex"></div>
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
import { ajaxZixunTicketList, ajaxZixunUserHome } from '../api/getData'

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
      goodsList: [],
      isClick: 1,
      attendList: {}, // 待参加
      allList: {}, // 全部活动
      isDisplay: true, // 没有数据时，显示文字
      member: []
    }
  },
  created () {
    this.initData()
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
    goToEdit () { // 跳转页面
      this.$router.push({path: prefixUrl + '/zixunUserEdit', query: {member: self.member}})
    },
    goToAbout () {
      return this.$router.push({path: prefixUrl + '/zixunAbout', query: {}})
    },
    clicked (val) {
      this.isClick = val
    },
    clickActivity (val) {
      console.log('val', val)
      return this.$router.push({path: prefixUrl + '/zixunActivityInfo', query: {act_id: val}})
    },
    goToTicketInfo (val) { // 查看票券
      return this.$router.push({path: prefixUrl + '/zixunTicketInfo', query: {code: val}})
    },
    goToIndex () {
      return this.$router.push({path: prefixUrl + '/zixunActivityIndex', query: {}})
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
    initData () {
      var self = this
      ajaxZixunUserHome().then(response => {
        var data = response.data
        console.log('1', response.data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.member)) {
            self.member = data.obj.member
            console.log(self.member)
          }
        }
      })
    },
    fetchData () { // 初始化数据
      var self = this
      ajaxZixunTicketList().then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.attendList)) { // 待参加
            self.attendList = data.obj.attendList
            self.isDisplay = false
          } else {
            self.isDisplay = true
          }
          if (!isEmpty(data.obj.allList)) { // 全部票券
            self.allList = data.obj.allList
            self.isDisplay = false
          } else {
            self.isDisplay = true
          }
          // if (!isEmpty(data.obj.goodsList)) {
          //   self.goodsList = data.obj.goodsList
          //   console.log(self.goodsList)
          // }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.header {
  position: relative;
  width: 100%;
  height: 3rem;
  padding: .1rem;
  background: url('../assets/zixun/user-bg.png') no-repeat;
  background-size: 100%;
  color: white;
}
.header-item {
  padding-top: 1.6rem;
  text-align: center;
}
.header-img {
  position: absolute;
  top: .7rem;
  left: 50%;
  width: 1rem;
  height: 1rem;
  margin-left: -.5rem;
}
.img {
  width: 100%;
  border-radius: 50%;
  border: 1px solid #949494;
}
.icon-ask {
  position: absolute;
  top: .2rem;
  right: .2rem;
  width: .5rem;
  height: .5rem;
  background: url('../assets/zixun/ask.png') no-repeat;
  background-size: 100%;
}
.username {
  padding: .1rem 1.5rem;
}
.btn-edit {
  margin: 0 2.5rem;
  padding: .05rem;
  text-align: center;
  color: white;
  border: 1px solid white;
  border-radius: 5px;
  font-size: .22rem;
}
.column {
  width: 100%;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  border-bottom: 1px dashed #21284e;
}
.column-item {
  flex-grow: 1;
  text-align: center;
  padding: .2rem;
  font-size: .24rem;
  line-height: .25rem;
}
.icon {
  width: .5rem;
  hieght: .5rem;
}
.list-item {
  margin: .2rem;
  padding: .1rem;
  background: white;
  font-size: .22rem;
  position: relative;
}
.item-img {
  float: left;
  width: 2rem;
  height: 2rem;
  margin-right: .1rem;
}
.item-right {
  margin-left: 2.1rem;
}
.actname {
  width: 3.7rem;
  height: .6rem;
  overflow: hidden;
}
.acttime {
  height: .3rem;
  overflow: hidden;
}
.btn-check {
  position: absolute;
  bottom: .1rem;
  right: .1rem;
  padding: .02rem .1rem;
  text-align: center;
  border: 1px solid #384275;
  color: #384275;
}
.sidebar {
  position: fixed;
  bottom: 1rem;
  left: 5.2rem;
  width: 100%;
}
.btn-index {
  width: .8rem;
  height: .8rem;
  background: url('../assets/zixun/detail_icon_top.png') no-repeat;
  background-size: 100%;
  background-position: 0 0;
  margin-bottom: .2rem;
}
.text {
  margin: .5rem;
  font-size: .22rem;
  text-align: center;
}
.bgWhite {background: white;}
</style>

