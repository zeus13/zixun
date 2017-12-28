<template>
  <section class="goodsIndex">
    <div class="head">
      <!-- <img src="../assets/img/aimaspa/bg3.png" class="bg-img-1"> -->
      <swiper :aspect-ratio="310/550" dots-class="custom-bottom" dots-position="center">
        <swiper-item class="swiper-demo-img" v-for="(item, index) in advList" :key="index">
          <div class="vux-img" :style="'background-image: url('+item.img+'?imageView2/1/w/550/h/310);'"></div>
        </swiper-item>
      </swiper>
      <div class="naviBar">
        <div class="naviBar-item" v-for="(item,index) in naviBar" :key="index" @click="goToList(item.id)">
          <div><img :src="item.url" class="naviBar-item-img"></div>
          <div>{{item.txt}}</div>
        </div>
      </div>
    </div>

    <div class="goodslist">
      <div class="goodslist-title">
        <div class="line"></div>
         <div class="line-txt">超值折扣 大家都在买</div> 
      </div>
      <ul class="row">
        <li v-for="(item, index) in goodsList" :key="index" @click="goToInfo(item.id)">
          <div class="goodslist-item-left"><img :src="item.main_img+'?imageView2/1/w/200/h/200'" class="goodslist-img"></div> 
          <div class="goodslist-item-right">
            <div class="title">【{{item.cat_name}}】{{item.name}}</div>
            <div class="description">{{item.description}}</div>
            <div style=""><span class="fs-028">￥{{item.sale_price / 100}}</span><span class="price-txt">￥{{item.market_price / 100}}</span></div>
          </div>
        </li>
      </ul>
    </div>
    <div class="support"> / 技术支持 / 南宁好无聊</div>

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
import { isEmpty, getStamp, wxshare } from '../utils/utils'
import { getGoodsIndex, getAdvList, getJssdk } from '../api/getData'
import { Swiper, Loading, SwiperItem } from 'vux'
import { prefixUrl } from '@/utils/env'
import wx from 'weixin-js-sdk'

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
      categoryList: [], // 类别列表
      advList: [], // 广告列表
      cat_id: 1, // 1美容2美甲3美睫4半永久5祛斑6护肤品7面膜8补差价
      naviBar: [
        {
          url: require('../assets/img/aimaspa/icon12.png'),
          txt: '美容',
          id: 1
        },
        {
          url: require('../assets/img/aimaspa/icon13.png'),
          txt: '美甲',
          id: 2
        },
        {
          url: require('../assets/img/aimaspa/icon14.png'),
          txt: '美睫',
          id: 3
        },
        {
          url: require('../assets/img/aimaspa/icon15.png'),
          txt: '半永久',
          id: 4
        },
        {
          url: require('../assets/img/aimaspa/icon16.png'),
          txt: '祛斑',
          id: 5
        },
        {
          url: require('../assets/img/aimaspa/icon17.png'),
          txt: '光电理疗',
          id: 6
        },
        {
          url: require('../assets/img/aimaspa/icon18.png'),
          txt: '商城热卖',
          id: 7
        },
        {
          url: require('../assets/img/aimaspa/icon19.png'),
          txt: '补差价',
          id: 8
        }
      ],
      goodsList: []
    }
  },
  created () {
    // this.wxShareFun()
  },
  mounted () {
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
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    goToList (val) { // 前往商品列表
      if (val !== 8) {
        this.$router.push({path: prefixUrl + '/goodsList', query: {cat_id: val}})
      } else {
        // this.$router.push({path: prefixUrl + '/goodsList', query: {cat_id: 1}})
        this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: 14}})
      }
    },
    goToInfo (val) { // 前往商品详情
      console.log(val)
      this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: val}})
    },
    fetchData () {
      var self = this
      getJssdk().then(response => {
        let result = response.data
        if (result.code === 200) {
          wx.config(result.obj.jssdk)
          wxshare(wx)
        }
      })
      getAdvList().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.advList)) {
            self.advList = data.obj.advList
            // console.log(self.advList)
          }
        }
      })
      getGoodsIndex().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.goodsList)) {
            self.goodsList = data.obj.goodsList
            console.log(self.goodsList)
          }
          if (!isEmpty(data.obj.categoryList)) {
            self.categoryList = data.obj.categoryList
            // console.log(self.categoryList)
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
.line {
  border-bottom: 1px solid #d2bf97;
}
.line-txt {
  position: absolute;
  top: .13rem;
  left: 50%;
  /* padding: .2rem; */
  width: 2.5rem;
  margin-left: -1.25rem;
  text-align: center;
  background: white;
  color: #d2bf97;
}
.goodslist-title {
  // text-align: center;
  // line-height: .3rem;
  padding: .3rem 1rem;
  position: relative;
}

.row {
  list-style-type: none;
}
.row li {
  width: 100%;
  position: relative;
  min-height: 2.05rem;
  margin-bottom: .2rem;
  padding: 1px;
}
// 奇数行
.row li:nth-child(odd) {
  background: #f6f0e2;
}
// 偶数行
.row li:nth-child(even) {
  background: #e8e0c9;
}
.description {
  // width: 3.5rem;
  font-size: .24rem;
  color: #808080;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.goodslist {
  width: 100%;
  background: white;
}
.goodslist-img {
  width: 100%;
  vertical-align: middle;
}
.goodslist-item-left {
  width: 1.8rem;
  position: absolute;
  top: .13rem;
  left: .13rem;
}
.goodslist-item-right {
  margin-left: 2.1rem;
  margin-top: .2rem;
  max-width: 4rem;
}
// .bg-img {
//   width: 100%;
//   height:3rem;
//   background: url('../assets/img/aimaspa/bg3.png') no-repeat;
//   background-size: 100%;
// }
.bg-img-1 {
  width:100%;
}
.naviBar {
  width: 100%;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  background: white;
  margin-top: -.1rem;
  padding: .15rem 0;
}
.naviBar-item {
  width: 1.6rem;
  text-align: center;
  line-height: .3rem;
  padding: .1rem 0;
  font-size: .24rem;
}
.naviBar-item-img {
  width: .6rem;
}
.price-txt {
  text-decoration: line-through;
  color: #808080;
  margin-left: .1rem;
}
.title {
  height: .8rem;
  overflow: hidden;
}
.head {margin-bottom: .12rem;}
.fs-02 {font-size: .2rem;}
.fs-028 {font-size: .28rem;}
.color-1 {color: #808080;}

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
  .support {
    font-family: "Microsoft YaHei", Arial, sans-serif;
    text-align: center;
    color: rgb(156, 156, 156);
    margin: .2rem 0;
    font-size: .2rem;
  }

</style>

