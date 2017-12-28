<template>
  <section class="goodsList">
<!--     <div class="tab">
      <div class="tab-item" @click="onItemClick(1)"><span :class="{'line':cat_id === 1}">美容</span></div>
      <div class="tab-item" @click="onItemClick(2)"><span :class="{'line':cat_id === 2}">美甲</span></div>
      <div class="tab-item" @click="onItemClick(3)"><span :class="{'line':cat_id === 3}">美睫</span></div>
      <div class="tab-item" @click="onItemClick(4)"><span :class="{'line':cat_id === 4}">半永久</span></div>
      <div class="tab-item" @click="onItemClick(5)"><span :class="{'line':cat_id === 5}">祛斑</span></div>
      <div class="tab-item" @click="onItemClick(6)"><span :class="{'line':cat_id === 6}">光电理疗</span></div>
      <div class="tab-item" @click="onItemClick(7)"><span :class="{'line':cat_id === 7}">商城热卖</span></div>
    </div> -->
     <div id="tab" style="width: 100%;overflow:scroll;-webkit-overflow-scrolling:touch;">
      <tab style="width:480px;" bar-active-color="#d2bf97" defaultColor="#666" :line-width="3" active-color="#d2bf97">
        <tab-item @on-item-click="onItemClick(1)" :selected="cat_id === 1">美容</tab-item>
        <tab-item @on-item-click="onItemClick(2)" :selected="cat_id === 2">美甲</tab-item>
        <tab-item @on-item-click="onItemClick(3)" :selected="cat_id === 3">美睫</tab-item>
        <tab-item @on-item-click="onItemClick(4)" :selected="cat_id === 4">半永久</tab-item>
        <tab-item @on-item-click="onItemClick(5)" :selected="cat_id === 5">祛斑</tab-item>
        <tab-item @on-item-click="onItemClick(6)" :selected="cat_id === 6">光电理疗</tab-item>
        <tab-item @on-item-click="onItemClick(7)" :selected="cat_id === 7">商城热卖</tab-item>
      </tab>
    </div>

    <div class="list">
      <div class="list-row" @click="goToInfo(item.id)" v-for="(item, index) in goodsList" :key="index">
        <div class="list-row-left"><img :src="item.main_img+'?imageView2/1/w/200/h/200'" width="100%" /></div>
        <div class="list-row-center">
          <div class="title">【{{item.cat_name}}】{{item.name}}</div>
          <div class="mb-04">已预约 <b>{{item.sell_amount}}</b></div>
          <div>
            <span class="fw fs-028">￥{{item.sale_price / 100}}</span>
            <span class="price">￥{{item.market_price / 100}}</span>
          </div>
        </div>
      </div>
      <div class="no-data" v-if="isEmpty(goodsList)">暂无相关数据...</div>
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
import Popup from '@/components/common/popup'
import { isEmpty, getStamp, fetchArray, saveArray } from '../utils/utils'
import { getCatList, getGoodsList } from '../api/getData'
import { Swiper, Loading, SwiperItem, Tab, TabItem } from 'vux'
import { prefixUrl } from '@/utils/env'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Swiper,
    SwiperItem,
    Tab,
    TabItem
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
      goodsList: [], // 特价商品列表
      categoryList: [], // 类别列表
      cat_id: 1, // 1美容2美甲3美睫4半永久5祛斑6护肤品7面膜8补差价
      naviList: ['美容', '美甲', '美瞳', '半永久', '祛斑', '护肤品', '面膜', '补差价'],
      orderNum: '10000',
      discount: '198.00',
      price: '498.00',
      title: '【美容】度妍3D纳米美肤',
      status: 0
    }
  },
  created () {
    if (!isEmpty(this.$route.query.cat_id)) {
      this.cat_id = parseInt(this.$route.query.cat_id)
    }
    console.log(document.path)
    // 查看产品详情后，返回到当前页，回显选项卡栏目
    if (document.path === '/app/goodsInfo') {
      this.cat_id = fetchArray('cat_id')
    }
  },
  mounted () {
    this.getCatList()
    this.getGoodsList()
    if (this.cat_id > 4) {
      document.getElementById('tab').scrollLeft = 150
      console.log(document.getElementById('tab').scrollLeft)
    }
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
    goToInfo (val) { // 前往商品详情
      saveArray('cat_id', this.cat_id)
      this.$router.push({ path: prefixUrl + '/goodsInfo', query: { goods_id: val } })
    },
    getCatList () {
      var self = this
      getCatList().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.categoryList)) {
            self.categoryList = data.obj.categoryList
            // console.log(self.categoryList)
          }
        }
      })
    },
    getGoodsList () {
      var self = this
      self.showLoadingText = '加载中...'
      self.showLoading = true
      getGoodsList(self.cat_id).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.goodsList)) {
            self.goodsList = data.obj.goodsList
            console.log(self.goodsList)
          } else {
            self.goodsList = []
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
        self.showLoading = false
      })
    },
    onItemClick (index) {
      this.cat_id = index
      this.$route.query.cat_id = index
      this.getGoodsList()
      console.log('on item click:', this.cat_id)
    }
  }
}
</script>

<style lang="less" scoped>
.title {
  width: 4rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.list-row-center {
  position: absolute;
  top: .2rem;
  left: 2rem;
  line-height: .4rem;
}

.list-row-left {
  width: 1.6rem;
  height: 1.6rem;
}

.list-row {
  padding: .2rem;
  background: white;
  color: #2c2c2c;
  position: relative;
  margin-bottom: .2rem;
}
// 奇数行
.list-row:nth-child(odd) {
  background: #f6f0e2;
}
// 偶数行
.list-row:nth-child(even) {
  background: #e8e0c9;
}

.tab {
  padding: .2rem;
  display: flex;
  flex-direction: row; 
  justify-content: center;
  // flex-wrap: nowrap;
  background: white;
  position: relative;
  border-bottom: 1px solid #f1efec;
}

.tab-item {
  text-align: center;
  margin: 0 .1rem;
  display: inline-block;
}

.line {
  color: #d2bf97;
  border-bottom: 2px solid #d2bf97;
  // padding: .1rem 0;
}

.price {
  font-size: .24rem;
  text-decoration: line-through;
  color: #7c7c7c;
}

.mb-04 {
  font-size: .24rem;
  margin-bottom: .4rem;
  color: #7c7c7c;
}

.fs-028 {
  font-size: .28rem;
}

.naviBar {
  width: 100%;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  background: white;
  margin-top: -.1rem;
  padding: .2rem 0;
}
.naviBar-item {
  width: 1.6rem;
  text-align: center;
  line-height: .3rem;
  color: #868584;
  padding: .1rem 0;
}
.naviBar-item-img {
  width: .8rem;
}
.no-data {
  font-size: .2rem;
  color: #aeaeae;
  text-align: center;
  padding: .3rem 0;
}
</style>
