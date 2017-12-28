<template>
  <section class="zixunActivityInfo">
  	<div class="main">
	  	<div>
	  		<div class="header-img"><img :src="image+'?imageView2/1/w/750'" class="img2"></div>
	  		<div class="head-title">
	  			<h2 class="title">{{activity.name}}</h2>
	  			<p class="address fs-02">{{activity.place}}</p>
	  			<p class="activity-time fs-02">{{activity.time}}</p>
	  			<p class="price-hints">{{activity.home_tips}}</p>
	  		</div>
	  	</div>
	  	<!-- 已购买人数 -->
	  	<div class="join clearfix">
	  		<img src="../assets/zixun/icon-user-blue.png" class="icon">
	  		<img src="../assets/zixun/icon-user-blue.png" class="icon">
	  		<img src="../assets/zixun/icon-user-blue.png" class="icon">
	  		<span>他们都参加了</span>
	  		<div class="headList">
	  			<div class="user-img" v-for="(list, index) in avatarList"><img :src="list" class="img"></div>
	  		</div>
	  	</div>
	  	<!-- 活动详情 -->
	  	<div class="content">
	  		<div class="content-title">活动详情</div>
	  		<!-- TODO 文章内容,从数据中导入数据，html格式 -->
        <div v-html="activity.detail" class="details" :class="{'unfold': isUnfold}"></div>
        <div v-show="isEmpty(activity.detail)">暂无活动详情~</div>
	  		<div class="row-read" v-show="!isEmpty(activity.detail)" v-bind:class="{ 'none': isUnfold }">
          <span class="btn-read" @click="clickMore">展开阅读详情</span>
        </div>
	  	</div>
	  	<!-- 票种明细 -->
	  	<div class="ticket">
	  		<div class="ticket-title">票种明细</div>
	  		<div class="ticket-list" v-for="(item, index) in ticket" :key="index" v-show="index < 2 || showMoreTicket">
	  			<div class="ticket-list-item clearfix">
	  				<div class="item-left">
              <span>{{item.name}}</span>
              <p v-html="item.rule"></p>
            </div>
	  				<div class="item-right">
              <span class="color-1">￥{{item.price}}</span>
              <p class="remain" v-if="item.limit_buy_num-item.ticket.length > 0">剩余{{item.limit_buy_num-item.ticket.length}}张</p>
              <p v-else-if="item.limit_buy_num> 0 && item.limit_buy_num-item.ticket.length <= 0">已售空</p>
              <p v-else="item.limit_buy_num === 0"></p>
            </div>
	  			</div>
	  		</div>
        <div class="row-remain" :class="{'none': showMoreTicket}">
          <span class="btn-remain" v-if="ticket.length > 2" @click="clickShowMoreTicket">余下票种详情</span>
        </div>
	  	</div>
			<!-- 参加须知 -->
			<div class="remind">
				<div class="line"></div>
				<div class="remind-title">
					<div class="remind-img"><img src="../assets/zixun/icon-book5.png" class="icon"></div>
					<div class="remind-img">参加须知</div>
				</div>
				<div class="remind-rules">
          <div class="remind-rules-item" v-for="(remind, index) in activity.activity_supplements" :key="index">
            <div class="frame">
              <img :src="remind.url" class="icon2">
            </div>
            <p>{{remind.name}}</p>
          </div>
				</div>
        <div class="cont" >
          <div class="cont-item" v-for="(join_notes, index) in beautifyJoinNotes(activity.join_notes)">· {{join_notes}}</div>
        </div>
			</div>
			<!-- 温馨提示 -->
			<div class="remind">
				<div class="line"></div>
				<div class="remind-title">
					<div class="remind-img"><img src="../assets/zixun/icon-phone.png" class="icon"></div>
					<div class="remind-img">温馨提示</div>
				</div>
				<div class="text" v-for="(reminder, index) in beautifyJoinNotes(activity.kindly_reminder)">{{reminder}}</div>
			</div>
		</div>

		<div class="footer" v-if="activity.status === 1">
			<div class="footer-left">{{activity.home_tips}}</div>
			<div class="footer-right" @click="join(act_id)">我要参加</div>
		</div>
    <div class="footer" v-if="activity.status === 2">
      <div class="footer-all">活动已结束</div>
    </div>

		<div class="sidebar">
      <div class="btn-index" @click="goToIndex"></div>
      <div class="btn-ticket" @click="goToUserHome"></div>
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
import { ajaxZixunActivityInfo, ajaxZixunActivityInfoMember } from '../api/getData'

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
      act_id: '',
      activity: {}, // 详情信息
      image: '',
      isUnfold: false, // 是否展开
      showMoreTicket: false,
      ticket: [], // 票券信息
      avatarList: []
    }
  },
  created () {
    this.act_id = this.$route.query.act_id
    this.fetchData()
    this.initData()
  },
  mounted () {
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
      // this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: val}})
    },
    join (id) {
      console.log('act_id', id)
      return this.$router.push({path: prefixUrl + '/zixunSelectTicket', query: {act_id: id}})
    },
    goToIndex () {
      return this.$router.push({path: prefixUrl + '/zixunActivityIndex', query: {}})
    },
    goToUserHome () {
      return this.$router.push({path: prefixUrl + '/zixunUserHome', query: {}})
    },
    beautifyJoinNotes (val) {
      var arr = []
      if (!isEmpty(val)) {
        arr = val.split('|')
      }
      return arr
    },
    clickMore () {
      this.isUnfold = true
    },
    clickShowMoreTicket () {
      this.showMoreTicket = true
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
    fetchData () { // 初始化数据
      var self = this
      // console.log('id', self.$route.params.act_id)
      console.log('id', self.act_id)
      ajaxZixunActivityInfo(self.act_id).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.activity)) {
            self.activity = data.obj.activity
            self.image = self.activity.image[0]
            console.log(self.image)
          }
          if (!isEmpty(data.obj.ticket)) {
            self.ticket = data.obj.ticket
            console.log(self.ticket)
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    },
    initData () {
      var self = this
      ajaxZixunActivityInfoMember(self.act_id).then(response => {
        var result = response.data
        console.log('infoMember', result)
        if (result.code === 200) {
          console.log('result.code', result.code)
          if (!isEmpty(result.obj.avatarList)) {
            self.avatarList = result.obj.avatarList
          } else {
            console.log('还没有人购买')
          }
        }
      })
    }
  }
}
</script>

<style lang="less" scoped>

.head-title {
	padding: .15rem .2rem;
	background: white;
	line-height: .4rem;
}
.title {
	font-size: .24rem;
	color: #384275;
}
.address::before {
	content: '';
	display: inline-block;
	width: .25rem;
	height: .25rem;
	background: url('../assets/zixun/icon-map.png') no-repeat;
	background-size: 100%;
	vertical-align: middle;
	margin-right: .08rem;
}
.price-hints {
  font-weight: bolder;
	font-size: .24rem;
	color: red;
}
.join {
	margin-top: .15rem;
	padding: .15rem;
	font-size: .2rem;
	line-height: .5rem;
	background: white;
}
.headList {
  padding-right: .15rem;
	float: right;
}
.icon {
	width: .25rem;
	height: .25rem;
	vertical-align: middle;
}
.icon2 {
	margin: .1rem;
	width: .7rem;
	vertical-align: middle;
}
.user-img {
	float: right;
	width: .5rem;
	height: .5rem;
	margin-right: -.1rem;
	text-align: right;
}
.img {
	width: 100%;
	border-radius: 50%;
	border: 1px solid white;
}
.img2 {
	width: 100%;
	height: 100%;
	vertical-align: middle;
}
.content {
	margin-top: .15rem;
 	background: white;
  position: relative;
}
.content-title {
	padding: .15rem;
	font-size: .24rem;
	border-bottom: 1px solid #f7f7f7;
}
.row-read {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 1rem;
  padding-top: .4rem;
  background: url('../assets/zixun/mask_layer.png') no-repeat;
  background-size: 100%;
  text-align: center;
}
.btn-read {
  width: 1rem;
  padding: .1rem .2rem;
  background: white;
  border: 1px solid #be9a78;
  border-radius: 5px;
  font-size: .2rem;
  color: #be9a78;
}
.ticket {
	margin-top: .15rem;
 	background: white; 
}
.ticket-title {
	padding: .15rem;
	font-size: .24rem;
	border-bottom: 1px solid #f7f7f7;
}
.ticket-list-item {
	padding: .15rem;
  font-size: .28rem;
	border-bottom: 1px solid #f7f7f7;
}
.item-left {
	float: left;
}
.item-left p {
  width: 4.6rem;
  font-size: .2rem;
  color: #b9b5b5;
}
.item-right {
	float: right;
  width: 1.5rem;
  text-align: center;
}
.remain {
  text-align: center;
  font-size: .2rem;
}
.row-remain {
  padding: .15rem;
  text-align: center;
}
.btn-remain {
  margin: 0 2rem;
  padding: .1rem;
  font-size: .22rem;
  color: #be9a78;
}
.btn-remain::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../assets/zixun/down.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .05rem;
}
.remind {
	position: relative;
	margin-top: .15rem;
	padding: .15rem 0;
	// line-height: .3rem;
	background: white;
}
.line {
	width: 100%;
	border-bottom: 1px solid #dad8d8;
	padding: .1rem 0;
}
.remind-title {
	position: absolute;
	top: .2rem;
	left: 50%;
	margin-left: -1rem;
	width: 2rem;
	text-align: center;
	line-height: .3rem;
	font-size: .24rem;
	background: white;
}
.remind-img {
	display: inline-block;
}
.remind-rules {
	display: flex;
	flex-direction: row;
	flex-wrap: wrap;
	margin-top: .4rem;
	justify-content: space-around;
}
.cont {
  display: flex;
  flex-direction: row;
  font-size: .2rem;
  color: #b9b5b5;
  justify-content: space-between;
}
.cont-item {
  flex-grow: 1;
  text-align: center;
}
.remind-rules-item {
	margin: .1rem .15rem;
	// padding: .2rem;
	width: 1.5rem;
	text-align: center;
}
.frame {

	border: 1px solid #d6d6d6;
	border-radius: 5px;
}
.remind-rules-item p {
	margin-top: .1rem;
	font-size: .2rem;
}
.footer {
	position: fixed;
	bottom: 0;
	margin-top: .1rem;
	width: 100%;
	height: .8rem;
	background: white;
	border-top: 1px solid #f7f7f7;
}
.footer-left {
	float: left;
  width: 40%;
  height: .8rem;
  line-height: .8rem;
  padding-left: .2rem;
}
.footer-right {
	float: left;
	width: 60%;
  height: .8rem;
  line-height: .8rem;
  text-align: center;
	background: #384275;
	color: white;
	font-size: .24rem;
}
.footer-all {
  height: .8rem;
  line-height: .8rem;
  text-align: center;
  background: #aeaeae;
  color: white;
  font-size: .24rem;
}
.sidebar {
	position: fixed;
	bottom: 1rem;
	left: 5.2rem;
	width: 100%;
	// background: url('../assets/zixun/detail_icon_top.png') no-repeat;
	// background-size: 100%;
}
.btn-index {
  width: .8rem;
  height: .8rem;
  background: url('../assets/zixun/detail_icon_top.png') no-repeat;
  background-size: 100%;
  background-position: 0 0;
  margin-bottom: .2rem;
}
.btn-ticket {
  width: .8rem;
  height: .8rem;
  background: url('../assets/zixun/detail_icon_top.png') no-repeat;
  background-size: 100%;
  background-position: 0 -.8rem; 
}
.text {
  padding: .2rem .2rem 0 .2rem;
  font-size: .24rem;
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
.unfold { max-height: inherit;}
.main {padding-bottom: 1rem;}
.fs-02 {font-size: .2rem}
.margin-top { margin-top: .3rem; }
.color-1 {color: #3a4273}
</style>
<style>
.details {
  max-height: 8rem;
  overflow: hidden;
  padding: .15rem;
  font-size: .24rem;
}
.details em {
  display: block;
  width: 100%;
  font-size: .2rem;
  color: #aeaeae;
  text-align: center;
}
</style>
