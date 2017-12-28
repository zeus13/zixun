<template>
  <section class="goodsInfo">
    <div class="head">
    <!--   <div class="head-ad"><img src="../assets/img/aimaspa/bg4.png" class="ad-img"></div> -->
      <swiper :aspect-ratio="430/749" dots-class="custom-bottom" dots-position="center">
        <swiper-item class="swiper-demo-img" v-for="(item, index) in goodsText.goods_img_arr" :key="index">
          <div class="vux-img" :style="'background-image: url('+item+'?imageView2/1/w/749/h/430);'"></div>
        </swiper-item>
      </swiper>

      <div class="row border-bottom">
        <div><div class="title">【{{goods.cat_name}}】{{goods.name}}</div></div>
        <div style="margin-top: .2rem; line-height: .3rem;">
          <span class="fs-033 ">￥{{goods.sale_price / 100}}</span>
          <span class="price">市场价：￥{{goods.market_price / 100}}</span>
          <span class="row-right">{{goods.sell_amount}}人购买</span>
          <div class="cb"></div>
        </div>
      </div>
      <div class="supplement">
        <div class="supplement-item">
          <img src="../assets/img/aimaspa/icon20.png" class="icon">
          快速上门
        </div>
        <div class="supplement-item">
          <img src="../assets/img/aimaspa/icon21.png" class="icon">
          高端产品
        </div>
        <div class="supplement-item">
          <img src="../assets/img/aimaspa/icon22.png" class="icon">
          专业服务
        </div>
      </div>
    </div>

    <div class="content">
      <div class="content-title">
        <div class="content-title-item" :class="{bgColor: isCheck === 1}" @click="isCheck = 1">项目详情</div>
         <div class="content-title-item" :class="{bgColor: isCheck === 2}" @click="isCheck = 2">评价（{{goodsComment.length}}）</div> 
      </div>
      <div class="content-box" v-show="isCheck === 1">
        <!-- <img v-if="!isEmpty(goodsText.goods_detail)" :src="goodsText.goods_detail" alt="" class="content-img"> -->
        <div class="content-details" v-html="goodsText.goods_detail"></div>
        <p v-show="isEmpty(goodsText.goods_detail)" class="txt">暂无数据...</p>
      </div>
      <div class="content-box" v-show="isCheck === 2">
        
        <div class="comment-list-item" v-for="(item, index) in goodsComment">
          <img :src="item.headimg" class="head-img">
          <div class="comment-list-item-right">
            <div style="line-height: .4rem;">
              <span class="fs-028">{{item.member_name}}</span>
              <span class="fr" style="color: #a5a5a5; font-size: .2rem;">{{getStamp(item.created_at, 'ymdhms')}}</span>
              <span class="cb"></span>
            </div>
            <p class="">{{item.content}}</p>
            <div class="pic-box">
              <div class="pic-box-item" v-for="item1 in item.img" :style="'background-image: url('+item1+'?imageView2/1/w/150/h/150);'"></div>
            </div>
          </div>
        </div>
        <p class="txt" v-if="isEmpty(goodsComment)">暂无评价...</p>

      </div>
    </div>

    <div class="foot" @click="goToPlaceOrder(goods.id)">
      <div class="foot-btn1"><p>￥{{goods.sale_price / 100}}</p><p>立即购买</p></div>
      <div class="foot-btn2"><del>￥{{goods.market_price / 100}}</del><p>原价</p></div>
    </div>
    <div class="foot-blank"></div>
    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>

    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { getGoodsInfo } from '../api/getData'
import { Swiper, Loading, SwiperItem } from 'vux'
import { prefixUrl } from '@/utils/env'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Swiper,
    SwiperItem
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      type: '', // 提交类型
      goods_id: 0, // 商品id
      goods: {}, // 商品信息
      goodsText: {}, // 商品信息（存文本类）
      goodsComment: [], // 商品评论
      isCheck: 1 // 切换商品详情和评论
    }
  },
  created () {
    if (!isEmpty(this.$route.query.goods_id)) {
      this.goods_id = this.$route.query.goods_id
    } else {
      this.$router.go(-1)
    }
  },
  mounted () {
    this.getGoodsInfo()
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
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    goToPlaceOrder (val) { // 跳转下单详情
      this.$router.push({path: prefixUrl + '/placeOrder', query: {goods_id: val}})
    },
    getGoodsInfo () {
      var self = this
      getGoodsInfo(self.type, self.goods_id).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.goods)) {
            self.goods = data.obj.goods
            console.log(self.goods)
          }
          if (!isEmpty(data.obj.goodsText)) {
            self.goodsText = data.obj.goodsText
            console.log('goodsText', self.goodsText)
          }
          if (!isEmpty(data.obj.goodsComment)) {
            self.goodsComment = data.obj.goodsComment
            // console.log(self.goodsComment)
          }
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
@yellow: #d2bf97;
.pic-box {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.pic-box-item {
  width: 1.4rem;
  height: 1.4rem;
  background: url('../assets/img/aimaspa/bg4.png') no-repeat;
  background-size: cover;
  background-position: 50%;
  margin: .1rem;
  border: 1px solid #ddd;
}
.txt {
  font-size: .24rem;
  padding: .3rem;
  min-height: 3.6rem;
  
}
.comment-list-item-right {
  margin-left: 1.2rem;
}
.comment-list-item {
  width: 100%;
  min-height: 1.5rem;
  background: white;
  position: relative;
  padding: .15rem;
  color: #666;
  border-bottom: 1px solid #dedede;
}
.head-img {
  width: 1rem;
  height: 1rem;
  border: 1px solid white;
  border-radius: 50%;
  position: absolute;
  top: .15rem;
  left: .15rem;
}
.head {
  margin-bottom: .2rem;
}
.head-ad {
  width: 100%;
}
.ad-img {
  width: 100%;
}
.row-right {
  float: right;
  font-size: .24rem;
}
.row {
  padding: .15rem;
  background: white;
  margin-top: -.1rem;
  position: relative;
}
.price {
  text-decoration: line-through;
  margin-left: .1rem;
  font-size: .24rem;
  color: #999;
}
.supplement {
  display: flex;
  flex-direction: row;
  padding: .1rem;
  background: white;
  color: #999;
}
.supplement-item {
  flex-grow: 1;
  position: relative;
  font-size: .2rem;
  text-align: center;
}
.icon {
  width: .3rem;
  height: .3rem;
  vertical-align: middle;
  position: relative;
  top: 0rem;
  left: .05rem;
}
.content-title {
  display: flex;
  flex-direction: row;
  background: white;
  margin-top: .1rem;
  position: relative;
  border-bottom: 1px solid #d2bf97;
}
.content-title-item {
  width: 50%;
  text-align: center;
  padding: .15rem;
}
.content-box {
  width: 100%;
  background: white;
}
.content-img {width: 100%;}
.border-bottom:before {
  content: " ";
  position: absolute;
  left: 0;
  bottom: 0;
  right: 0;
  height: 1px;
  border-bottom: 1px solid @yellow;
  -webkit-transform-origin: 0 100%;
  transform-origin: 0 100%;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.title {
  display: inline-block;
  width:100%;
  font-size: .28rem;
}
.foot {
  width: 100%;
  position: fixed;
  bottom: 0;
  font-size: .24rem;
  text-align: center;
  height: .8rem;
  background: #f1f1f1;
  color: #18110b;
  z-index: 10;
}
.foot-blank {
  width: 100%;
  height: .8rem;
  background: #fff;
}
.sty3 {
  margin-top: .1rem;
}
.foot-btn2{
  float: right;
  background: #4a4a4a;
  color: #fff;
  padding: 0 .5rem;
  text-align: center;
  height: .8rem;
  line-height: 1.3;
  padding-top: .1rem;
}
.foot-btn1 {
  float: right;
  background: #bd9d62;
  color: #fff;
  padding: 0 .8rem;
  text-align: center;
  height: .8rem;
  line-height: 1.3;
  padding-top: .1rem;
}
.bgColor {
  background: @yellow;
}
.fs-028 {font-size: .28rem;}
.fs-033 {font-size: .32rem; }
.cb {clear:both;}
.fw {font-weight: bolder;}
.fr { float: right;}
.mt-01 {margin-top: .1rem}
.vux-img{
  display: block;
  width: 100%;
  height: 100%;
  background: center center no-repeat;
  background-size: cover;
  position: relative;
}
.vux-swiper-desc{
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 1.4em;
  font-size: 16px;
  padding: 0 0 30px 10px;
  margin: 0;
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.7) 100%);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.7) 100%);
  color: #fff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.5);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  word-wrap: normal;
}
</style>
<style>
.content-details {
  width: 100%;
}
.content-details .mg{
  width: 100%;
  display: block;
  margin: 0 0 .2rem;
  vertical-align: middle;
}
.content-details .nomg{
  width: 100%;
  display: block;
  vertical-align: middle;
}
.content-details .ad-title{
  font-weight: 700;
  display: block;
  font-size: .28rem;
  margin: .2rem .2rem .1rem;
  position: relative;
}
.content-details .sty1{
  font-size: .24rem;
  line-height: 1.5;
  margin: 0 .2rem .1rem;
}
.content-details .sty2{
  font-size: .24rem;
  line-height: 1.5;
  margin: 0 .2rem;
}
.content-details em{
  color: #999;
  display: block;
  text-align: center;
}
.content-details ul{
  list-style: none;
  padding: 0;
  margin: .1rem .2rem .3rem;
}
.content-details ul li{
  position: relative;
}
.content-details video{
  background: url(../assets/img/video_bg.jpg) no-repeat;
  background-size: 100%;
}
.parth-box {
  background: #19110c;
  color: #d2bf97;
  padding: .3rem 0;
}
.parth-box-title {
  font-size: .28rem;
  text-align: center;
  border-top: 1px solid #d2bf97;
  border-bottom: 1px solid #d2bf97;
  line-height: .6rem;
}
.parth-box-row {
  min-height: .9rem;
}
.parth-box-left {
  float: left;
  width: 30%;
  text-align: right;
  padding-right: .2rem;
  padding-top: .1rem;
}
.parth-box-line {
  float: left;
  width: .4rem;
  border-bottom: 1px solid #d2bf97;
  margin-top: .4rem;
}
.parth-box-right {
  float: left;
  border-left: 1px solid #d2bf97;
  min-height: .9rem;
}
.parth-box-right-text {
  width: 3.6rem;
  float: left;
  text-align: left;
  margin-left: .2rem;
  margin-top: .2rem;
}
.fs-04 {
font-size: .4rem;
}
</style>
