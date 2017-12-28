<template>
<section class="zixunActivityIndex">
  <div v-if="!showXLoading">
<!--     <div class="top-search">
      <input type="text" class="searchIpu" placeholder="中山路城市记忆展">
      <div class="search-btn"><i class="icons icon-search1"></i> search</div>
    </div> -->
    <div class="top-menu">
      <div class="menu clearfix">
        <div class="m-item" v-bind:class="{ 'active': selectMenu==0?true:false }"  @click="selectMenuFun(0)">精选</div>
         <div class="m-item" v-bind:class="{ 'active': selectMenu==4?true:false }"  @click="selectMenuFun(4)">往期</div> 
         <!-- <div class="m-item" v-bind:class="{ 'active': selectMenu==1?true:false }"  @click="selectMenuFun(1)">展览</div>
        <div class="m-item" v-bind:class="{ 'active': selectMenu==2?true:false }"  @click="selectMenuFun(2)">周边&户外</div>
        <div class="m-item" v-bind:class="{ 'active': selectMenu==3?true:false }"  @click="selectMenuFun(3)">演出&赛事</div>  -->
      </div>
      <div class="user" @click="goToZixunUserHome()"><i class="icons icon-user-red"></i> 我的</div>
    </div>
    <div class="main" v-for="(item, index) in activityList">
      <div v-if="item.status === 1" v-show="selectMenu === 0">
        <div class="activity-item" @click="goToZixunActivityInfo(item)">
          <div class="thumbnail" v-bind:style="{ 'background': 'url('+i+'?imageView2/1/w/280/h/214) no-repeat','background-size':'cover','background-position':'50%'}" v-for="(i, index) in item.thumbnail" v-show="index === 0"></div>
          <h3>{{item.name}}</h3>
          <p><i class="s-icons icon-map"></i> {{item.place}}{{item.time}}</p>
          <div class="price">{{item.home_tips}}</span></div>
        </div>
      </div>
      <div v-else v-show="selectMenu === 4">
        <div class="activity-item" @click="goToZixunActivityInfo(item)">
          <div class="thumbnail" v-bind:style="{ 'background': 'url('+i+'?imageView2/1/w/280/h/214) no-repeat','background-size':'cover','background-position':'50%'}" v-for="(i, index) in item.thumbnail" v-show="index === 0"></div>
          <h3>{{item.name}}</h3>
          <p><i class="s-icons icon-map"></i> {{item.place}}{{item.time}}</p>
          <div class="price">活动已结束</span></div>
        </div>
      </div>
    </div>
    <a href="#" class="goTop" v-bind:class="{ 'none': isAnchor }"><img src="../assets/img/goTop.png" width="100%"></a>
  </div>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getStamp } from '@/components/common/utils'
import wx from 'weixin-js-sdk'
export default {
  components: {
    XLoading,
    popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      isAnchor: true,
      activityList: [], // 活动列表
      selectMenu: 0
    }
  },
  created () {
    var self = this
    let h = window.screen.height / 2
    window.onscroll = function () { // 返回顶部
      let s = document.documentElement.scrollTop || document.body.scrollTop
      if (s >= h) {
        self.isAnchor = false
      } else {
        self.isAnchor = true
      }
    }
    this.getJssdk()
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    selectMenuFun (val) {
      this.selectMenu = val
    },
    // 获取jssdk
    async getJssdk () {
      await this.$http({url: 'ajaxZixunGetJssdk', params: {}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          wx.config(JSON.parse(result.obj.jssdk))
        }
      }, function (response) {
        console.log(response)
      })
    },
    goToZixunActivityInfo (val) { // 跳转链接
      this.$router.push({name: 'zixunActivityInfo', query: {act_id: val.id}})
    },
    goToZixunUserHome () { // 跳转链接
      this.$router.push({name: 'zixunUserHome', query: {}})
    },
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunActivityIndex', params: {}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          console.log(result)
          this.activityList = result.obj.activityList
          if (!isEmpty(result.obj.shareArr)) {
            var shareArr = result.obj.shareArr
            wx.ready(function () {
              // 2.1 监听“分享给朋友”
              wx.onMenuShareAppMessage({
                title: shareArr.share_title,
                desc: shareArr.share_text,
                link: window.location.href,
                imgUrl: shareArr.share_icon,
                trigger: function (res) {
                },
                success: function (res) {
                },
                cancel: function (res) {
                },
                fail: function (res) {
                }
              })
              // 2.2 监听“分享到朋友圈”
              wx.onMenuShareTimeline({
                title: shareArr.share_text,
                desc: shareArr.share_text,
                link: window.location.href,
                imgUrl: shareArr.share_icon,
                trigger: function (res) {
                },
                success: function (res) {
                },
                cancel: function (res) {
                },
                fail: function (res) {
                }
              })
              wx.hideMenuItems({
                menuList: ['menuItem:readMode', // 阅读模式
                  'menuItem:copyUrl' // 复制链接
                ],
                success: function (res) {
                },
                fail: function (res) {
                }
              })
            })
          }
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
@bule: #232e66;
@gray: #ebebeb;
.top-search{
  background: #fff;
  padding: .2rem;
  position: relative;
  border-bottom: 1px solid #ebebeb;
}
.searchIpu{
  padding: .1rem;
  height: .5rem;
  line-height: .5rem;
  width: 100%;
  border: 1px solid @bule;
  border-radius: .1rem;
  outline: 0;
  font-size: .2rem;
  background: #FFF;
  box-sizing: border-box;
  -webkit-appearance: none;
}
.search-btn{
  width: 1.3rem;
  height: .3rem;
  line-height: .3rem;
  text-align: center;
  color: #fff;
  background: @bule;
  border-radius: .1rem;
  position: absolute;
  top: .2rem;
  right: .2rem;
  padding: .1rem 0;
}
.top-menu{
  background: #fff;
  position: relative;

}
.menu{
  padding-left: .2rem;
}
.m-item{
  float: left;
  line-height: .6rem;
  padding: 0 .1rem;
  margin: 0 .1rem;
}
.menu .active{
  color: @bule;
  border-bottom: 2px solid @bule;
}
.user{
  position: absolute;
  width: 1.2rem;
  height: .3rem;
  line-height: .3rem;
  border-left: 1px solid #d9d9d9;
  text-align: center;
  top: .1rem;
  right: 0;
  color: red;
  padding: .05rem 0;
}
.main{
  margin: .2rem;
}
.activity-item{
  height: 2.14rem;
  padding-top: 1px;
  position: relative;
  margin-bottom: .2rem;
  background: #fff;
}
.activity-item h3,.activity-item p,.activity-item em{
  margin-left: 3rem;
  margin-right: .1rem;
}
.activity-item .thumbnail{    
  width: 2.8rem;
  height: 2.14rem;
  position: absolute;
  top: 0;
} 
.activity-item h3{
  margin-top: .1rem;
  height: .96rem;
  overflow: hidden;
}
.activity-item p{
  font-size: .2rem;
  margin-top: .1rem;
  height: .52rem;
  text-align: justify;
  overflow: hidden;
}
.activity-item .price{
  position: absolute;
  font-weight: 700;
  // color: #e0b281;
  color: red;
  left: 3rem;
  bottom: .05rem;
}
.fs-16{
  font-size: .16rem;
}
.goTop{
  position: fixed;
  right: .2rem;
  bottom: .2rem;
  width: .5rem;
}
</style>
