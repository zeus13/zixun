<template>
<section class="zixunUserHome">
  <div v-if="!showXLoading">
    <div class="top-box">
      <img class="headimg" :src="member.avatar">
      <p>{{member.name}}</p>
      <div class="btn-edit" @click="clickUserInfo()">编辑资料</div>
      <svg @click="goToZixunAboutMe()" t="1500283946506" class="icon-doubt" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6153" xmlns:xlink="http://www.w3.org/1999/xlink" ><path d="M505.584 55.297c-245.404 0-444.349 198.944-444.349 444.349 0 245.409 198.943 444.349 444.349 444.349 245.408 0 444.349-198.939 444.349-444.349 0-245.403-198.94-444.349-444.349-444.349v0zM502.746 759.803c-25.79 0-46.693-20.507-46.693-45.806s20.903-45.806 46.693-45.806c25.789 0 46.697 20.507 46.697 45.806 0 25.299-20.909 45.806-46.697 45.806v0zM678.863 447.054c-12.821 20.194-40.139 47.75-82 82.567-21.685 18.018-35.113 32.513-40.347 43.501-5.239 10.944-7.627 30.591-7.133 58.817h-93.333c-0.253-13.38-0.374-21.565-0.374-24.469 0-30.223 5.003-55.052 15.002-74.534 9.998-19.483 29.996-41.45 59.985-65.785 29.962-24.368 47.93-40.323 53.772-47.882 9.009-11.953 13.545-25.101 13.545-39.479 0-19.919-8.043-37.011-24.017-51.229-15.981-14.215-37.55-21.347-64.668-21.347-26.124 0-47.973 7.43-65.574 22.233-17.575 14.806-32.653 47.499-36.247 67.742-3.387 19.085-95.408 27.123-94.304-11.547 1.107-38.673 21.267-80.667 55.785-111.141 34.522-30.445 79.833-45.683 135.918-45.683 59.014 0 105.974 15.417 140.835 46.246 34.891 30.832 52.291 66.724 52.291 107.654 0 22.665-6.37 44.108-19.134 64.332v0zM678.863 447.054z" p-id="6154"></path></svg>
    </div>
    <div class="menu clearfix">
      <div class="menu-item" :class="{active: menuIndex === 0}" @click="selectMenu(0)">
        <img src="../assets/img/icon-book2.png">
        <p>待参加</p>
      </div>
      <div class="menu-item" :class="{active: menuIndex === 1}" @click="selectMenu(1)">
        <img src="../assets/img/icon-book3.png">
        <p>全部票券</p>
      </div>
    </div>
    <div class="main">

      <div class="act-item" v-for="(item, index) in ticketList" @click="clickTicketInfo(item.code)">
        <div class="ribbon-wrapper">
         <div class="name">
             <span>{{substrFun(item.ticktype_name)}}</span>
         </div>
        </div>
        <div class="act-pic" :style="'background-image: url('+item.thumbnail+'?imageView2/1/w/200/h/200);'"></div>
        <h3>{{item.act_name}}</h3>
        <p class="mt1">时间：{{item.act_time}}</p>
        <p>票号：{{item.code}}</p>
        <div class="act-btn">查看详情</div>
      </div>
      <div class="no-actdata" v-if="isEmpty(ticketList)">还没有相关数据，<a href="javascript:void(0)" @click="goHome"> 点击查看更多活动...</a></div>
    </div>
    <div class="goToIndex" @click="goHome"></div>
  </div>
  <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getStamp } from '@/components/common/utils'
export default {
  components: {
    XLoading,
    popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      ticketList: [], // 门票列表
      attendList: [], // 待参加门票列表
      allList: [], // 全部门票列表
      menuIndex: 0, // 菜单下标
      member: {} // 个人信息
    }
  },
  created () {
    this.initData()
    this.getTicketList()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    goToZixunAboutMe () { // 跳转链接
      this.$router.push({name: 'zixunAboutMe', query: {}})
    },
    goHome () { // 返回首页
      this.$router.push({name: 'zixunActivityIndex', query: {}})
    },
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    substrFun (val) {
      return val.substr(0, 5)
    },
    openPopupFun (type, msg, icon) { // 开启弹窗
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗
      this.showPopup = false
      if (this.popupMsg === '保存成功') {
        this.$router.go(-1)
      }
    },
    selectMenu (val) { // 选择菜单
      this.menuIndex = val
      if (val === 0) {
        this.ticketList = this.attendList
      }
      if (val === 1) {
        this.ticketList = this.allList
      }
    },
    clickTicketInfo (val) { // 点击前往门票详情
      this.$router.push({name: 'zixunTicketInfo', query: {code: val}})
    },
    clickUserInfo (val) { // 点击前往个人信息
      this.$router.push({name: 'zixunUserEdit', query: {}})
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunUserHome', params: {}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          if (!isEmpty(result.obj.member)) {
            this.member = result.obj.member
          }
        }
      }, function (response) {
        console.log(response)
      })
    },
    // 初始化时获取基本数据
    async getTicketList () {
      await this.$http({url: 'ajaxZixunTicketList', params: {}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          this.attendList = result.obj.attendList
          this.allList = result.obj.allList
          this.ticketList = this.attendList
        }
      }, function (response) {
        console.log(response)
      })
      this.showXLoading = false
    }
  },
  watch: {
  }
}
</script>
<style lang="less" scoped>
.zixunUserHome{

}
.top-box{
  width: 6.4rem;
  height: 2.96rem;
  background: url(../assets/img/user-bg.png) no-repeat;
  background-size: 100%;
  padding-top: 1px;
}
.top-box img{
  display: block;
  width: 1rem;
  border-radius: 50%;
  margin: .6rem auto 0;
}
.top-box p{
  text-align: center;
  font-size: .32rem;
  line-height: .5rem;
  color: #fff;
}
.top-box .btn-edit{
  width: 1.2rem;
  height: .4rem;
  line-height: .4rem;
  border: 1px solid #fff;
  border-radius: .06rem;
  text-align: center;
  color: #fff;
  margin: 0 auto;
}
.menu{
  background: #fff;
  border-bottom: 1px dotted #0b1b71;
}
.menu-item{
  width: 50%;
  float: left;
  color: #384275;
  text-align: center;
  padding: .2rem 0;
}
.menu-item img{
  width: .5rem;
  display: block;
  margin: 0 auto .1rem;
}
.act-item{
  margin: .2rem;
  background: #fff;
  line-height: 1.5;
  position: relative;
  height: 1.9rem;
  font-size: .2rem;
  padding-top: .1rem;
}
.act-pic {
  width: 1.8rem;
  height: 1.8rem;
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
  border-radius: 3px 3px 0 0;
  position: absolute;
  top: .1rem;
  left: .1rem;
}
.act{
    position: relative;
}
.act-item h3{
  display: block;
  margin-left: 2rem;
  height: .6rem;
  overflow: hidden;
}
.mt1{
  margin-top: .1rem;
}
.act-item p{
  display: block;
  margin-left: 2rem;
  height: .3rem;
  overflow: hidden;
  color: #aeaeae;  
}
.act-btn{
  border: 1px solid #384275;
  color: #384275;
  padding: .05rem .1rem;
  position: absolute;
  bottom: .1rem;
  right: .1rem;
}
.active{
  background: #f7f7f7;
}

.ribbon-wrapper{
  width:1.6rem;
  height:1.6rem;
  position:absolute;
  top:0;
  left:0;
  overflow:hidden;
  
}
.name span{
  display:inline-block;
  width: 2.4rem;
  background:#3e3e3e;
  text-align:center;
  color:#ffffff;
  font-size: .2rem;
  padding:.05rem 0;
  background-color:#e0b281;
  background-image: -webkit-linear-gradient(top, #e0b281, #e4831b);
  background-image: -webkit-linear-gradient(top, #e0b281, #e4831b);
  box-shadow: 0px 0px 0px rgba(0,0,0,0.2),inset 0px 0px 0px rgba(255,255,255,0.11);
  transform: rotate(-45deg);
  position:relative;
  top: .35rem;
  right: .65rem;
  z-index: 99;
}
.name:before,.name:after{
  content:'';
  position:absolute;
  width:.12rem;
  height:.12rem;
  border:.12rem solid transparent;
  z-index:1;
}
.name:before{
  border-bottom-color: #e0b281;
  top: 1.15rem;
  left: -.25rem;
  -webkit-transform: rotate(-90deg);
  transform: rotate(-90deg);
}
.name:after{
  border-bottom-color: #e0b281;
  top: -.25rem;
  left: 1.15rem;
}
.icon-doubt{
  display: block;
  position: absolute;
  top: .2rem;
  right: .2rem;
  width: .6rem;
  height: .6rem;
  fill: #fff;
}
.no-actdata {
  text-align: center;
  margin: .6rem 0;
  color: #5c656c;
}
.no-actdata a {
  color: #5c656c;
}
.no-actdata a:hover {
  color: #5c656c;
}
.goToIndex {
  display: block;
  width: .8rem;
  height: .8rem;
  background: url(../assets/img/detail_icon_top.png) no-repeat;
  background-size: .8rem 1.6rem;
  background-position: 0 0;
  position: fixed;
  right: .3rem;
  bottom: .8rem;
  z-index: 10;
}
</style>
