<template>
<section class="zixunActivityInfo">
  <div v-if="!showXLoading">
    <div class="warp">
      <div class="top">
        <img :src="i+'?imageView2/1/w/750'" v-for="(i, index) in activity.image" v-show="index === 0"  class="img-block">
        <h3 class="c-blue">{{activity.name}}</h3>
        <p><i class="s-icons icon-map"></i> {{activity.place}}<br>{{activity.time}}</p>
        <em>{{activity.home_tips}}</em>
      </div>
      <div class="weixin" @click="starWeixinFun()" v-show="subscribe === 0"><svg t="1499334340338" class="icon-qrcode" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2376" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M584.4 471.6h181.3V290.4H584.4v181.2zM675 341.8c21.7 0 39.2 17.5 39.2 39.2 0 21.7-17.5 39.2-39.2 39.2s-39.2-17.5-39.2-39.2c0-21.6 17.5-39.2 39.2-39.2zM258.4 797.6h181.3V616.4H258.4v181.2zM349 667.8c21.7 0 39.2 17.5 39.2 39.2s-17.5 39.2-39.2 39.2c-21.7 0-39.2-17.5-39.2-39.2s17.6-39.2 39.2-39.2z m-90.6-196.2h181.3V290.4H258.4v181.2zM349 341.8c21.7 0 39.2 17.5 39.2 39.2 0 21.7-17.5 39.2-39.2 39.2-21.7 0-39.2-17.5-39.2-39.2 0-21.6 17.6-39.2 39.2-39.2z" p-id="2377" fill="#384277"></path><path d="M512 64C246.9 64 32 278.9 32 544s214.9 480 480 480 480-214.9 480-480S777.1 64 512 64z m-23.3 761.3c0 11.8-9.6 21.3-21.3 21.3H230.7c-11.8 0-21.3-9.6-21.3-21.3V588.6c0-11.8 9.6-21.3 21.3-21.3h236.7c11.8 0 21.3 9.6 21.3 21.3v236.7z m0-325.9c0 11.8-9.6 21.3-21.3 21.3H230.7c-11.8 0-21.3-9.6-21.3-21.3V262.7c0-11.8 9.6-21.3 21.3-21.3h236.7c11.8 0 21.3 9.6 21.3 21.3v236.7z m218.7 347.3h-58.6v-63.5h58.6v63.5z m107.3-21.4c0 11.8-9.6 21.3-21.3 21.3h-32.7v-63.5h54v42.2z m0-95.5h-166v-40.5h-53.3v157.4h-38.7c-11.8 0-21.3-9.6-21.3-21.3V588.6c0-11.8 9.6-21.3 21.3-21.3h150.8v106h53.2v-106h32.6c11.8 0 21.3 9.6 21.3 21.3l0.1 141.2z m0-230.4c0 11.8-9.6 21.3-21.3 21.3H556.6c-11.8 0-21.3-9.6-21.3-21.3V262.7c0-11.8 9.6-21.3 21.3-21.3h236.7c11.8 0 21.3 9.6 21.3 21.3l0.1 236.7z" p-id="2378" fill="#384277"></path></svg><p> 关注【南宁好无聊】微信公众号，更多精彩活动等着你哟~</p></div>
      <div class="join">
        <span><i class="icons icon-user-blue"></i><i class="icons icon-user-blue"></i><i class="icons icon-user-blue"></i>他们都参加了</span>
        <div class="headlist">
          <div style="display: inline;" v-for="a in (5-avatarList.length)"><img src="../assets/img/noheadimg.png" class="noheadimg"/></div>
          <div style="display: inline;" v-for="(item,index) in avatarList"><img :src="item" class="noheadimg"/></div>

          <div class="total">{{joinNum<5?'5':joinNum}}</div>
        </div>
      </div>
      <div class="act-detail">
        <div class="title">活动详情</div>
        <div class="act-detail-box" v-bind:class="{ 'unfold': isUnfold }">
          <div class="cont" v-html="activity.detail"></div>
          <p class='cont-tips' v-show="isEmpty(activity.detail)">暂无活动详情</p>
          <div class="get-more-detail" @click="unfoldFun()" v-bind:class="{ 'none': isUnfold }" v-show="!isEmpty(activity.detail)">
            <div class="get-more-info2">
              <p>展开阅读详情</p>
              <!-- <img src="../assets/img/arrow_down.png"> -->
            </div> 
          </div> 
        </div>
      </div>

      <div class="ticket-info">
        <div class="title">票种明细</div>

        <div class="ticket-item" v-for="(item, index) in ticket" v-show="index < 2 || showMoreTicketType">
          <h3>{{item.name}}</h3>
          <p v-for="(i, index) in beautifyTicketRule(item.rule)" class="subtitle1">{{i}}</p>
          <div class="price"><label class="small">￥</label>{{item.price}}<br><del v-show="item.original_price > 0">￥{{item.original_price}}</del></div>
          <div for="small" class="subtitle2" v-show="item.is_limit_buy ===1">剩余 {{item.limit_buy_num-item.ticket.length}} 张</div>
        </div>
      </div>
      <div class="get-more-info" v-show="ticket.length > 2" @click="clickMoreTicketType()" v-bind:class="{ 'none': showMoreTicketType }">
        <p>余下票种详情</p>
        <img src="../assets/img/arrow_down.png">
      </div> 

      <div class="remark">
        <div class="divider"><div class="divider-box"> <i class="icons icon-book5"></i> 参加须知</div></div>
        <div class="cont">
          <div class="tips-img clearfix">
            <div class="item-img" v-for="(item,index) in activity.activity_supplements">
              <div class="img-box"> <img :src="item.url" alt="no-wifi"></div>
              <span>{{item.name}}</span>
            </div>
          </div>
          <div class="tips-text clearfix">
            <div class="item" v-for="(item,index) in beautifyJoinNotes(activity.join_notes)">· {{item}}</div>
          </div>
        </div>
      </div>

      <div class="tips">
        <div class="divider"><div class="divider-box"> <i class="icons icon-phone"></i> 温馨提示</div></div>
        <div class="cont clearfix" v-for="(item,index) in beautifyKindlyReminder(activity.kindly_reminder)">{{item}}</div>
      </div>

      <div class="comment-list" v-show="activity.id === 2">
        <div class="title">活动评价 ( {{activityCommentList.length}} ) <span class="comment-btn" @click="commonFun()">评价</span></div>
        <div class="cont">
          <div class="cont-item" v-for="(item, index) in activityCommentList">
            <div class="cl-headimg">
              <img :src="item.mem_avatar">
            </div>
            <div class="cl-top">
              <p class="cl-name">{{item.mem_name}}</p>
              <p class="cl-thumb"><span>{{item.fans}}</span><svg t="1500019117038" class="icon-thumb" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1002" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M212.075 476.95c13.338 0 24.2-10.85 24.2-24.2 0-13.338-10.85-24.2-24.2-24.2-0.225 0-0.45 0.113-0.675 0.113l-57.775 0.175c-1.363-0.225-2.713-0.288-4.075-0.288-18.2 0-32.963 14.925-32.963 33.413L116.25 862.7c0 18.55 14.813 33.013 33.013 33.013 1.75 0 3.5 0.225 5.2 0H212.011v-0.225c12.388-0.45 22.388-10.513 22.388-22.95 0-12.613-9.95-22.613-22.388-23.175v-0.338h-47.1l1.363-372.075h45.8z m681.05-34.662c-17.813-29.113-43.763-40.825-75.2-42.125-1.587-0.175-3.275-0.338-4.975-0.338l-190.025-0.675c12.5-36.125 21.038-79.15 21.038-119.637 0-26.238-3-51.788-8.363-76.388l-0.512 0.063c-9.775-43.025-47.825-75.2-93.338-75.2-52.975 0-88.313 44.55-88.313 98.15 0 3.05-0.225 5.937 0 8.875-2.775 100.237-84.412 180.862-181.537 191.95v50.775l-0.738 205.575v212.462h9.9l462.525 0.225 8.088-0.225c17.862 0.113 27.925-4.412 44.15-14.925 15.437-9.95 27.087-23.525 34.712-38.95 2.088-3.112 3.675-6.5 4.688-10.4l71.287-318.475c0.963-3.737 1.25-7.575 0.963-11.313 1.475-20.125-3.038-40.937-14.35-59.424z m-30.25 48.912L786.15 831.325h-0.113c-2.375 5.65-6.337 10.688-11.875 14.25-3.85 2.55-8.137 3.962-12.437 4.638-1.413-0.225-2.825 0-4.237 0l-441.275-0.563-0.163-376.775c82.662-37.263 143.262-73.725 174.475-160.625 0.063 0 0.113 0.063 0.175 0.063 2.775-8.475 5.875-19.163 8.025-30.7 5.15-27.025 4.862-53.763 4.862-53.763-4.575-35.112 24.025-48.962 41.05-48.962 23.463 0.85 46.525 31.1 46.525 48.4 0 0 5.2 25.5 5.263 52.925 0.063 34.55-4.3 52.575-4.3 52.575h-0.512c-5.426 28.55-14.988 55.637-28.213 80.4l0.338 0.337c-2.15 4.463-3.45 9.438-3.45 14.7 0 18.487 17.7 20.125 35.9 20.125l220.837 0.225 13.512 0.45v0.063c11.2-0.626 22.388 4.75 28.838 15.212 5.087 8.312 5.937 18.087 3.225 26.8l0.275 0.1zM281.112 895.837h0.288c0.225 0 0.338-0.112-0.287-0.112-0.563 0-0.45 0.113-0.226 0.113h0.226z" p-id="1003"></path></svg></p>
            </div>
            <div class="cl-time">{{getBeautyTime(item.updated_at)}}</div>
            <div class="cl-description">{{item.content}}</div>
  <!--           <div class="cl-photos clearfix">
              <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
              <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
              <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
              <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
              <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
            </div> -->
          </div>
          <div class="more-comment" @click="goToZixunActivityCommentList(activity.id)">查看更多评价</div>
        </div>
      </div>
      <div class="foot-blank-div"></div>
      <div class="foot" v-show="activity.status == 1 && getNowTime() < activity.endtime">
        <span class="price">￥{{beautifyMinTicketPrice(activity.ticket_types)}}</span>
        <div class="join-btn" @click="clickBuy()">我要参加</div>
      </div>
      <div class="foot" v-show="activity.status == 0">
        <div class="status0">活动未开始</div>
      </div>
      <div class="foot" v-show="activity.status == 2 || getNowTime() > activity.endtime">
        <div class="status0">活动已结束</div>
      </div>
      <div class="goToIndex" @click="goToIndex"></div>
      <div class="goToOrder" @click="goToOrder"></div>

      <div class="qrcode-mask" v-show="starWeixin">
        <div class="qrcode-cont">
          <svg @click="starWeixinFun()" t="1499318480086" class="icon-close" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2465" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M512 66C264.6 66 64 266.6 64 514c0 247.4 200.6 448 448 448 247.4 0 448-200.6 448-448C960 266.6 759.4 66 512 66zM728.6 665c3 3 4.6 7 4.6 11.2 0 4.2-1.6 8.4-4.6 11.2l-43.2 43.4c-3.2 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6L512 579.6l-150.8 151.4c-3 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6l-43.2-43.4c-3-3-4.6-7-4.6-11.2 0-4.2 1.6-8.4 4.6-11.2l151.4-152-151.8-150c-6.2-6.2-6.2-16.4 0-22.6l43.2-43.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l151.4 149.4 151.4-149.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l43.2 43.4c6.2 6.2 6.2 16.4 0 22.6l-151.8 150L728.6 665z" p-id="2466" fill="#445194"></path></svg>
          <img src="../assets/img/qrcode.jpg">
          <p>长按识别二维码,更多精彩活动等你哟~</p>
        </div>
      </div>
    </div>
  </div>
  <div class="commentPopup popup-anim" v-show="isComment">
    <div class="cp-head">
      <svg @click="commonFun()" t="1499318480086" class="icon-comment-close" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2465" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M512 66C264.6 66 64 266.6 64 514c0 247.4 200.6 448 448 448 247.4 0 448-200.6 448-448C960 266.6 759.4 66 512 66zM728.6 665c3 3 4.6 7 4.6 11.2 0 4.2-1.6 8.4-4.6 11.2l-43.2 43.4c-3.2 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6L512 579.6l-150.8 151.4c-3 3.2-7.2 4.6-11.2 4.6-4 0-8.2-1.6-11.2-4.6l-43.2-43.4c-3-3-4.6-7-4.6-11.2 0-4.2 1.6-8.4 4.6-11.2l151.4-152-151.8-150c-6.2-6.2-6.2-16.4 0-22.6l43.2-43.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l151.4 149.4 151.4-149.4c3-3 7-4.6 11.2-4.6 4.2 0 8.2 1.6 11.2 4.6l43.2 43.4c6.2 6.2 6.2 16.4 0 22.6l-151.8 150L728.6 665z" p-id="2466" fill="#445194"></path></svg>
      <span class="cp-item" v-bind:class="{ 'cp-active': evaluate==='好评'?true:false }" @click="evaluateFun('好评')">好评</span>
      <span class="cp-item" v-bind:class="{ 'cp-active': evaluate==='中评'?true:false }" @click="evaluateFun('中评')">中评</span>
      <span class="cp-item" v-bind:class="{ 'cp-active': evaluate==='差评'?true:false }" @click="evaluateFun('差评')">差评</span>
    </div>
    <div class="cp-main">
      <textarea class="cp-textarea" v-model="commentContent" placeholder="这个活动精彩吗？记录你的体验感受，还能帮到更多人哟~"></textarea>
      <div class="cp-upload-list clearfix">
        <div class="cp-upload-item" @click="chooseImg()" v-show="uploadNum < 9"><svg t="1500025034700" class="icon-camera" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4984" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M512 288c-124.8 0-224 99.2-224 224s99.2 224 224 224 224-99.2 224-224S636.8 288 512 288zM512 688c-96 0-176-80-176-176s80-176 176-176 176 80 176 176S608 688 512 688zM768 371.2a1.6 1.6 0 1 0 102.4 0 1.6 1.6 0 1 0-102.4 0ZM864 224l-96 0-22.4-67.2c-6.4-16-25.6-28.8-41.6-28.8l-384 0c-19.2 0-35.2 12.8-41.6 28.8l-22.4 67.2-96 0c-54.4 0-96 41.6-96 96l0 448c0 54.4 44.8 96 96 96l704 0c54.4 0 96-41.6 96-96l0-448C960 265.6 918.4 224 864 224zM912 768c0 25.6-22.4 48-48 48l-704 0c-25.6 0-48-22.4-48-48l0-448c0-25.6 22.4-48 48-48l96 0 35.2 0 9.6-32 22.4-64 377.6 0 22.4 64 9.6 32 35.2 0 96 0c25.6 0 48 22.4 48 48L912 768z" p-id="4985"></path></svg></div>
        <div class="cp-upload-item" v-for="(item, index) in imageArrTemp" v-bind:style="{ 'background': 'url('+item+') no-repeat','background-size':'cover','background-position':'50%'}"></div>
      </div>
    </div>
    <div class="cp-btn" @click="clickCommentOn()">发布</div>
  </div>
  <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getBeautyTime } from '@/components/common/utils'
import wx from 'weixin-js-sdk'
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
      isUnfold: false, // 是否展开
      starWeixin: false, // 是否打开微信关注弹窗
      act_id: 0,
      activity: {}, // 活动信息
      showMoreTicketType: false, // 显示余下票种详情按钮
      activityCommentList: [], // 评论列表
      subscribe: 0,
      joinNum: 0,
      avatarList: [],
      imageArr: [],
      imageArrTemp: [],
      mediaId: [],
      nowtime: 0,
      uploadNum: 0, // 上传图片数量
      isComment: false, // 是否显示评论弹窗
      commentContent: '', // 评论内容
      evaluate: '', // 好评、中评、差评
      ticket: {}
    }
  },
  created () {
    if (!isEmpty(this.$route.query.act_id)) {
      this.act_id = this.$route.query.act_id
    } else {
      this.$router.go(-1)
    }
    this.nowtime = parseInt(new Date().getTime() / 1000)
    this.getJssdk()
    this.initData()
    this.getActivityCommentList()
    this.getActivityInfoMember()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getBeautyTime (val, type) { // 时间戳转日期
      return getBeautyTime(val, type)
    },
    getNowTime () { // 获取当前时间
      let nowTime = parseInt(new Date().getTime() / 1000)
      console.log(nowTime)
      return nowTime
    },
    goToZixunActivityCommentList (val) { // 跳转链接
      this.$router.push({name: 'zixunActivityCommentList', query: {act_id: val}})
    },
    goToIndex () { // 跳转首页
      this.$router.push({name: 'zixunActivityIndex', query: {}})
    },
    goToOrder () { // 跳转票券
      this.$router.push({name: 'zixunUserHome', query: {}})
    },
    // 选择是否好评
    evaluateFun (val) {
      this.evaluate = val
    },
    // 写评论
    commonFun () {
      this.isComment = !this.isComment
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
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    chooseImg () { // 选择照片
      let t = this
      wx.ready(function () {
        wx.chooseImage({
          count: 9, // 默认9
          sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
          sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
          success: function (res) {
            t.imageArr = res.localIds
            t.imageArrTemp = []
            t.mediaId = []
            t.uploadNum = 0
            t.uploadImg()
          }
        })
      })
    },
    uploadImg () { // 上传图片
      let t = this
      let num = t.uploadNum
      let length = t.imageArr.length
      if (window.__wxjs_is_wkwebview) {
        wx.getLocalImgData({
          localId: t.imageArr[num], // 图片的localID
          success: function (res) {
            t.imageArrTemp.push(res.localData)
          },
          fail: function (res) {
            alert('上传失败')
          }
        })
      } else {
        t.imageArrTemp.push(t.imageArr[num])
      }
      wx.uploadImage({
        localId: t.imageArr[num], // 需要上传的图片的本地ID，由chooseImage接口获得
        isShowProgressTips: 0, // 默认为1，显示进度提示
        success: function (res) {
          t.uploadNum++
          t.mediaId.push(res.serverId)
          if (t.uploadNum < length) {
            t.uploadImg()
          }
        }
      })
    },
    starWeixinFun () { // 关注弹窗
      this.starWeixin = !this.starWeixin
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
    unfoldFun () { // 是否展开
      this.isUnfold = true
    },
    clickMoreTicketType () { // 点击余下票种详情
      this.showMoreTicketType = !this.showMoreTicketType
    },
    beautifyTicketRule (val) { // 优化票的规则
      var arr = []
      if (!isEmpty(val)) {
        arr = val.split('|')
      }
      return arr
    },
    beautifyJoinNotes (val) { // 优化参加须知
      var arr = []
      if (!isEmpty(val)) {
        arr = val.split('|')
      }
      return arr
    },
    beautifyKindlyReminder (val) { // 优化温馨提示
      var arr = []
      if (!isEmpty(val)) {
        arr = val.split('|')
      }
      return arr
    },
    beautifyMinTicketPrice (val) { // 优化最低票价
      var price = 0
      if (!isEmpty(val)) {
        for (var i = 0; i < val.length; i++) {
          var temp = parseFloat(val[i].price)
          if (i === 0) {
            price = temp
          }
          if (temp <= price) {
            price = temp
          }
        }
      }
      return price
    },
    clickBuy () { // 点击购买
      if (parseInt(this.act_id) === 5 && parseInt(this.joinNum) > 60) {
        this.openPopupFun('alert', '由于场地有限，本次活动提前结束报名，请大家见谅', 2)
        return
      }
      this.$router.replace({name: 'zixunSelectTicket', query: {act_id: this.act_id}})
    },
    clickCommentOn () { // 点击评论
      if (this.evaluate === '') {
        this.openPopupFun('alert', '请选择一个评价', 2)
        return
      }
      if (this.commentContent === '') {
        this.openPopupFun('alert', '请填写评论内容', 2)
        return
      }
      if (isEmpty(this.imageArr)) {
        this.openPopupFun('alert', '请先上传图片', 2)
        return
      }
      this.openPopupFun('load', '正在提交', 0)
      this.$http({url: 'ajaxZixunActivityComment', params: {act_id: this.act_id, imageArr: this.mediaId, commentContent: this.commentContent, evaluate: this.evaluate}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200) {
          this.openPopupFun('alert', result.msg, 1)
          this.mediaId = []
          this.imageArr = []
          this.uploadNum = 0
          this.isComment = false
          this.commentContent = ''
          this.evaluate = ''
        } else {
          this.openPopupFun('alert', result.msg, 2)
        }
      }, function (response) {
        this.openPopupFun('alert', 'error', 2)
        console.log(response)
      })
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunActivityInfo', params: {act_id: this.act_id}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          var activity = result.obj.activity
          var ticket = result.obj.ticket
          this.activity = activity
          this.ticket = ticket
          console.log('activity', this.activity)
          console.log('tiecket', this.ticket)

          // var ticketId = result.obj.activity.ticket_types
          // for (var i = 0; i < ticketId.length; i++) {
          //   var temp = this.checkBalance(ticketId[i].id)
          // }
          // this.count = temp
          // console.log('count', this.count)
          // console.log(ticketId)
          wx.ready(function () {
            // 2.1 监听“分享给朋友”
            wx.onMenuShareAppMessage({
              title: activity.share_title,
              desc: activity.share_text,
              link: window.location.href,
              imgUrl: activity.share_icon,
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
              title: activity.share_text,
              desc: activity.share_text,
              link: window.location.href,
              imgUrl: activity.share_icon,
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
      }, function (response) {
        console.log(response)
      })
    },
    // 查询订单数
    async checkBalance (temp) {
      await this.$http({url: 'ajaxCheckBalance', params: {act_id: this.act_id, ticktype_id: temp}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          console.log(result.obj.balance)
          return parseInt(result.obj.balance)
        } else if (result.code === 500) {
          return 0
        }
      }, function (response) {
        console.log(response)
      })
    },
    // 获取评论列表
    async getActivityCommentList () {
      await this.$http({url: 'ajaxZixunActivityCommentList', params: {act_id: this.act_id}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          this.activityCommentList = result.obj.activityCommentList
        }
      }, function (response) {
        console.log(response)
      })
    },
    // 获取参与人数
    async getActivityInfoMember () {
      await this.$http({url: 'ajaxZixunActivityInfoMember', params: {act_id: this.act_id}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          this.subscribe = result.obj.subscribe
          this.joinNum = result.obj.joinNum
          this.avatarList = result.obj.avatarList
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
<style>
.act-detail .act-detail-box .cont{
}
.act-detail .act-detail-box .cont img{
  width: 100%;
  display: block;
  margin: .1rem 0;
}
.act-detail .act-detail-box .cont .ad-title1{
  font-weight: 700;
  display: block;
  margin: .1rem 0 .2rem;
}
.act-detail .act-detail-box .cont .ad-title2{
  font-weight: 700;
  display: block;
  margin: .2rem 0 .1rem;
}
.act-detail .act-detail-box .cont .ad-title3{
  font-weight: 700;
  display: block;
  margin: .2rem 0 .1rem;
  position: relative;
  padding-left: .15rem;
}
.act-detail .act-detail-box .cont .ad-title3:before{
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 2px;
  background: #384275;
}
.act-detail .act-detail-box p{
  font-size: .24rem;
  line-height: 1.5;
  /*margin-bottom: .1rem;*/
}
.act-detail .act-detail-box em{
  display: block;
  font-size: .2rem;
  color: #aeaeae;
  text-align: center;
  margin-bottom: .1rem;
}
</style>
<style lang="less" scoped>
.subtitle1 {
  // display: inline-block;
  float: left;
}
.subtitle2 {
  // display: inline-block;
  float: right;
  font-size: .2rem;
  margin-right: .2rem;
}
.zixunActivityInfo .warp{
  color: #4d4d4d;
}
.icon-qrcode{
  width: .4rem;
  height: .4rem;
  margin: .1rem;
}
.icon-comment-close{
  width: .5rem;
  height: .5rem;
  position: absolute;
  top: .15rem;
  right: .15rem;
  z-index: 999;
  background: #fff;
  border-radius: 50%;
}
.icon-camera{
  display: block;
  width: .8rem;
  height: .8rem;
  margin: .24rem auto 0;
  fill: #ccc;
}
.top{
  background: #fff;
  color: #4d4d4d;
  padding-bottom: 1px;
}
.top h3{
  font-weight: bold;
  display: block;
  margin: .2rem .2rem  0 .2rem;
}
.top p{
  text-align: justify;
  font-size: .2rem;
  margin: .1rem .2rem 0 .2rem;
}
.top em{
  display: block;
  // color: #e0b281;
  font-weight: 700;
  color: red;
  font-size: .28rem;
  margin: .1rem 0 .1rem .2rem;
}
.fs-16{
  font-size: .16rem;
}
.weixin{    
  position: relative;
  color: #384275;
  font-size: .2rem;
  padding: .15rem .2rem;
  background: #deedfb;
}
.weixin .icon-qrcode, .weixin p {
    display: inline;
    margin: 0;
    vertical-align: middle;
}
.weixin:before{ 
  content: "";
  display: inline-block;
  height: 6px;
  width: 6px;
  border-width: 2px 2px 0 0;
  border-color: #384275;
  border-style: solid;
  -webkit-transform: matrix(.71,.71,-.71,.71,0,0);
  transform: matrix(.71,.71,-.71,.71,0,0);
  position: absolute;
  top: 50%;
  right: .25rem;
  margin-top: -4px;
}
.join{
  height: .3rem;
  line-height: .3rem;
  background: #fff;
  margin: .2rem 0;
  padding: .25rem 0;
  text-indent: .2rem;
  font-size: .2rem;
  position: relative;
}
.headlist{
  position: absolute;
  right: .1rem;
  top: .1rem;
}
.noheadimg{
  width: .6rem;
  height: .6rem;
  float: left;
  margin-left: -.1rem;
  border-radius: 50%;
  background: url(../assets/img/noheadimg.png) no-repeat;
  background-size: 100%;
  overflow: hidden;
}
.join .total{
  width: .6rem;
  height: .6rem;
  line-height: .6rem;
  background: #384277;
  color: #fff;
  text-indent: 0;
  font-size: .18rem;
  text-align: center;
  border-radius: 50%;
  width: .6rem;
  float: left;
  margin-left: -.1rem;
}
.act-detail{
  background: #fff;
}
.act-detail .title{
  line-height: .6rem;
  text-indent: .2rem;
  border-bottom: 1px solid #e8e8e8;
}
.act-detail .act-detail-box{
  position: relative;
  overflow: hidden;
  max-height: 8rem;
  color: #606060;
  padding: .1rem .2rem;
  text-align: justify;
}
.act-detail .unfold{
  max-height: inherit;
}
.get-more-detail {
  background-image: url(../assets/img/mask_layer.png);
  background-repeat: no-repeat;
  background-size: cover;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 90px;
  padding-top: 40px;
  box-sizing: border-box;
  text-align: center;
}
.act-detail .zw-detail-wrap img, .zw-detail-wrap p {
  display: inline;
  margin: 0;
  color: #be9a78;
  vertical-align: -webkit-baseline-middle;
}
.ticket-info{
  background: #fff;
  margin-top: .2rem;
  position: relative;
}
.unfold2 {
  max-height: inherit;
}
.ticket-info .title{
  line-height: .6rem;
  text-indent: .2rem;
  border-bottom: 1px solid #e8e8e8;
}
.ticket-info .ticket-item{
  padding-left: .2rem;
  border-bottom: 1px solid #e8e8e8;
  position: relative;
  padding-bottom: .1rem;
  min-height: 1rem;
}
.ticket-info .ticket-item h3{
  padding: .2rem 0 .1rem;
  font-size: .28rem;
}
.ticket-info .ticket-item p{
  line-height: 1.5;
  font-size: .2rem;
  color: #aeaeae;
}
.ticket-info .price{
  position: absolute;
  top: .2rem;
  right: .15rem;
  font-size: .32rem;
  color: #3a4273;
  text-align: center;
  line-height: 1;
}
.ticket-info .price .small{
  font-size: .2rem;
}
.ticket-info .price del{
  font-size: .2rem;
  color: #999;
}
.ticket-info .btn-buy{
  position: absolute;
  bottom: .2rem;
  right: .15rem;
  background: #3a4273;
  color: #fff;
  padding: .05rem .12rem;
  font-size: .2rem;
  border-radius: .06rem;
}
.get-more-info2 {
  color: #be9a78;
  text-align: center;
  padding: .1rem 0;
  border: 1px solid #be9a78;
  margin: .15rem 2.3rem;
  border-radius: 5px;
}
.get-more-info{
  color: #be9a78;
  text-align: center;
  padding: .1rem 0;
  position: relative;
  top: 0;
  left: 0;
  background: white;
}
.get-more-info img{
  width: .2rem;
}
.remark{
  background: #fff;
  margin-top: .2rem;
}
.remark .cont{
  padding-bottom: .2rem;
}
.remark .tips-img {
  margin: .2rem .3rem;
}
.remark .tips-img .item-img{
  width: 33.33%;
  float: left;
  text-align: center;
  line-height: .4rem;
  color: #808080;
  font-size: .2rem;
}
.remark .tips-img .item-img .img-box{
  width: 1.2rem;
  height: .8rem;
  border: 1px solid #d9d9d9;
  border-radius: .1rem;
  margin: 0 auto;
}
.remark .tips-img .item-img .img-box img{
  width: .6rem;
  display: block;
  margin: .1rem auto 0;
}
.remark .tips-img .item-img span{
  display: block;
}
.remark .tips-text .item{
  width: 50%;
  float: left;
  color: #808080;
  font-size: .2rem;
  padding-left: .5rem;
  box-sizing: border-box;
  padding-bottom: .1rem;
  text-align: justify;
}
.divider{
  display: table;
  white-space: nowrap;
  height: auto;
  overflow: hidden;
  text-align: center;
  color: #666;
  padding: .2rem 0;
}
.divider:after, .divider:before {
    content: '';
    display: table-cell;
    position: relative;
    width: 50%;
    border-bottom: .02rem solid #e8e8e8;
    transform: translateY(-50%);
    -ms-transform: translateY(-50%); /* IE 9 */
    -moz-transform: translateY(-50%); /* Firefox */
    -webkit-transform: translateY(-50%); /* Safari 和 Chrome */
    -o-transform: translateY(-50%); /* Opera */
}
.divider-box{
    padding: 0 .2rem;
    color: #384275;
    line-height: .3rem;
}
.tips{
  background: #fff;
  margin-top: .2rem;
}
.tips .cont{
  line-height: 1.5;
  padding: 0 .2rem .2rem;
}
.tips .cont .item{
  width: 50%;
  float: left;
  text-align: center;
  line-height: .4rem;
  color: #808080;
  font-size: .2rem;
}
.cont-tips{
  padding-left: .1rem;
  font-size: .2rem;
  color: #aeaeae;
  line-height: .4rem;
}
.comment-list{
  background: #fff;
  margin-top: .2rem;
}
.comment-list .thumb-active span{
  font-size: .28rem;
  color: #fd8181;
}
.comment-list .thumb-active .icon-thumb{
  fill: #fd8181;
}
.icon-thumb{
  width: .4rem;
  height: .4rem;
  fill: #bfbfbf;    
  float: right;
  margin-top: .04rem;
  margin-left: .1rem;
}
.comment-head{
  min-height: 1.4rem;
  position: relative;
  border-bottom: 1px dotted #e8e8e8;
  padding-top: 1px;
}
.thumbnail{
  width: 1rem;
  height: 1rem;
  position: absolute;
  top: .2rem;
  left: .2rem;
}
.comment-head p{
  margin-top: .2rem;
  margin-left: 1.4rem;
  margin-bottom: .1rem;
  height: .62rem;
  display: block;
}
.comment-head .ch-left{
  margin-left: 1.4rem;    
  color: #517395;
  cursor: pointer;
  font-size: .2rem;
}
.comment-head .ch-right {
    display: inline-block;
    width: 6px;
    margin-left: 5px;
    margin-bottom: 0;
    border-right: 1px solid #517395;
    border-top: 1px solid #517395;
    transform: rotate(45deg);
    height: 6px;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
}
.comment-list .title{
  line-height: .6rem;
  text-indent: .2rem;
  border-bottom: 1px solid #e8e8e8;
}
.comment-list .cont{
}
.comment-list .cont-item{
  padding: .3rem .2rem .3rem 0;
  margin-left: .2rem;
  position: relative;
  border-bottom: 1px solid #e8e8e8;
}
.comment-list .cl-headimg{
  width: .8rem;
  height: .8rem;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
}
.comment-list .cl-headimg img{
  width: 100%;
}
.comment-list .cl-top{
  margin-left: .9rem;
  position: relative;
}
.comment-list .cl-name{
  margin-bottom: 0;
  margin-right: 1.2rem;
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
  color: #b1b0b0;
}
.comment-list .cl-thumb{
  position: absolute;
  top: 0;
  right: 0;    
  height: .6rem;
  line-height: .6rem;
  color: #bfbfbf;
}
.comment-list .cl-time{
  margin-left: .9rem;
  color: #b1b0b0;
  font-size: .2rem;
}
.comment-list .cl-description{
  margin-left: .9rem;    
  margin-bottom: .1rem;
  margin-top: 3px;
}
.comment-list .cl-photos{
  margin-left: .9rem;
}
.comment-list .cl-photos-item{
  width: 1.1rem;
  height: 1.1rem;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  float: left;
  margin: 0 .1rem .1rem 0;
}
.comment-list .comment-btn{
  width: .9rem;
  height: .4rem;
  line-height: .4rem;
  font-size: .2rem;
  text-indent: 0;
  border-radius: 5px;
  text-align: center;
  background: #384277;
  color: #fff;
  float: right;
  display: block;
  margin: .1rem;
}
.more-comment{
  padding: .2rem;
  text-align: center;
  text-decoration: underline;
}
.qrcode-mask{
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
  pointer-events:auto;
  background-color:rgba(0,0,0,.6);
  pointer-events:auto;
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content: center;
  -webkit-justify-content: center;
  align-items: center;
  -webkit-align-items: center;
}
.qrcode-cont{
  width: 4.4rem;
  background: #fff;
  position: relative;
  z-index: 999;
  border-radius: .1rem;
  padding: .3rem 0 .4rem;
}
.qrcode-cont img{
  width: 3rem;
  display: block;
  margin: 0 auto;
}
.qrcode-cont p{
  font-size: .2rem;
  color: #aeaeae;
  text-align: center;
}
.icon-close{
  width: .5rem;
  height: .5rem;
  position: absolute;
  top: -.15rem;
  right: -.15rem;
  z-index: 999;
  background: #fff;
  border-radius: 50%;
}
.c-blue{
  color: #384275;
}
.status0 {
  width: 100%;
  height: .8rem;
  background: #aeaeae;
  text-align: center;
  position: absolute;
  color: #fff;
  top: 0;
  right: 0;
}
.commentPopup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #f7f7f7;
  z-index: 9999;
  color: #4d4d4d;    
  overflow: auto;
}
.cp-head {
  background: #fff;
  padding: .8rem .2rem .4rem;
  margin-bottom: .2rem;
  box-sizing: border-box;
  position: relative;    
  text-align: center;
}
.cp-item {
  border: 1px solid #ccc;
  border-radius: .24rem;
  margin-right: .2rem;
  padding: 5px 10px;
}
.cp-main {
  background: #fff;
  padding: 1px 0;
  margin-bottom: 1rem;
}
.cp-upload-list {
  margin: .2rem;
}
.cp-textarea {
  display: block;
  width: 6rem;
  height: 4rem;
  margin: .2rem auto 0;
  outline: 0;
  border: 0;
  font-size: .24rem;
}
.cp-upload-item {
  float: left;
  width: 1.26rem;
  height: 1.26rem;
  border: 1px solid #ececec;
  margin: .1rem;
  overflow: hidden;
}
.cp-active{
  border: 1px solid #384275;
  color: #384275;
}
.cp-btn {
  width: 100%;
  height: .8rem;
  line-height: .8rem;
  background: #384275;
  text-align: center;
  position: fixed;
  color: #fff;
  bottom: 0;
  left: 0;
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
  bottom: 2rem;
  z-index: 10;
}
.goToOrder {
  display: block;
  width: .8rem;
  height: .8rem;
  background: url(../assets/img/detail_icon_top.png) no-repeat;
  background-size: .8rem 1.6rem;
  background-position: 0 -.8rem;
  position: fixed;
  right: .3rem;
  bottom: 1rem;
  z-index: 10;
}
</style>
