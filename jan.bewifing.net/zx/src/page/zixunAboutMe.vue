<template>
<section class="zixunAboutMe">
  <div v-if="!showXLoading">

  <div class="top-box">
    <img class="headimg" src="http://boringcdn.bewifing.net/zixun/suky_headimg.jpg">
    <p>平台客服：Suky</p>
    <p>活动宣传&投诉建议：<a href="tel:13481000254">13481000254</a></p>
  </div>

  <div class="visit-timeline">
    <ul>
      <li class="visit-timeline-item" v-for="(item, index) in versionLogList">
        <div class="visit-timeline-item-head"></div>
        <!-- <div class="visit-timeline-item-head-small"></div> -->
        <div class="visit-timeline-item-tail"></div>
        <div class="visit-timeline-item-content">
          <p class="visit-title">{{'V' + item.major + '.' + item.minor}}</p>
          <p v-html="item.content"></p>
        </div>
      </li>
    </ul>
  </div>


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
      type: '',
      versionLogList: []
    }
  },
  created () {
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
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
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunAboutMe', params: {type: this.type}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200) {
          if (this.type === '') {
            this.versionLogList = result.obj.versionLogList
            console.log(this.versionLogList)
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
@import '../assets/less/base.less';
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
  font-size: .2rem;
  line-height: .25rem;
  margin-top: .2rem;
  color: #fff;
}
.top-box p a{
  color: #fff;
}
.visit-timeline{
  padding: 10px;
}
.visit-timeline-item{
  position: relative;
  font-size: 12px;
  line-height: 1.5;
}
.visit-title{
  font-size: 14px;
  font-weight: 700;
}    
.visit-timeline-item-head {
  width: 14px;
  height: 14px;
  background: @base-color;
  position: absolute;
  left: -1px;
  top: 4px;
  border-radius: 50%;
  z-index: 99;
}
.visit-timeline-item-head-red {
  width: 18px;
  height: 18px;
  background: #ff3729;
  position: absolute;
  left: -3px;
  top: 4px;
  border-radius: 50%;
  z-index: 99;
}
.visit-timeline-item-head-red::before{    
  content: "";
  width: 10px;
  height: 2px;
  background: #fff;
  position: absolute;
  top: 50%;
  left: 4px;
  margin-top: -1px;
}
.visit-timeline-item-head-green {
  width: 18px;
  height: 18px;
  background: #112e4e;
  position: absolute;
  left: -3px;
  top: 4px;
  border-radius: 50%;
  z-index: 99;
}
.visit-timeline-item-head-green::before{    
  content: "";
  width: 10px;
  height: 2px;
  background: #fff;
  position: absolute;
  top: 50%;
  left: 4px;
  margin-top: -1px;
}
.visit-timeline-item-head-green::after{    
  content: "";
  width: 2px;
  height: 10px;
  background: #fff;
  position: absolute;
  top: 4px;
  left: 50%;
  margin-left: -1px;
}
.visit-timeline-item-head-small {
  width: 10px;
  height: 10px;
  background: #2595c3;
  position: absolute;
  left: 1px;
  top: 40px;
  border-radius: 50%;
  z-index: 99;
}
.visit-timeline-item-tail{
  position: absolute;
  content: '';
  height: 100%;
  width: 2px;
  left: 5px;
  top: 5px;
  background-color:@base-color;
}
.visit-timeline-item-content{
  padding: 0 0 10px 25px;
}
.visit-recent{
  border-radius: 8px;
  // background: #112e4e;
  color: #fff;
  padding: 5px;
  margin-top: 5px;
  position: relative;
}
// .visit-recent::before{
//   content: "";
//   width: 0;
//   height: 0;
//   border-bottom: 10px solid #112e4e;
//   border-right: 10px solid transparent;
//   position: absolute;
//   top: 10px;
//   left: -4px;
//   transform:rotate(45deg);
//   -ms-transform:rotate(45deg);   /* IE 9 */
//   -moz-transform:rotate(45deg);  /* Firefox */
//   -webkit-transform:rotate(45deg); /* Safari 和 Chrome */
//   -o-transform:rotate(45deg);  /* Opera */
// }

</style>
