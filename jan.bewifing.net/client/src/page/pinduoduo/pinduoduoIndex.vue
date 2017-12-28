<template>
  <div class="pinduoduoIndex">
    <div class="navi-bar">
      <div class="chosen-swiper">
        <router-link to="pinindex">首页</router-link>
        <a href="fushi">服饰</a>
        <a href="">男装</a>
        <a href="">母婴</a>
        <a href="">家居</a>
        <a href="">美食</a>
        <a href="">电器</a>
        <a href="">美妆</a>
        <a href="">家纺</a>
        <a href="">手机</a>
        <a href="">运动</a>
        <a href="">水果</a>
      </div>
    </div>
    <div class="swiper">
      <swiper :list="imgs" auto style="width:100%;margin:0 auto;" height="180px" dots-class="custom-bottom" dots-position="center"></swiper>
    </div>
    <!-- 滑动栏 -->
    <div class="quick-entrance-scroll" style="touch-action: pan-x;">
      <ul class="qes-scroller">
        <li class="qes-row">
          <div class="scroll-item" @click="seckill">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/spike.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">限时秒杀</div>
          </div>
          <div class="scroll-item" @click="clearance()">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_14.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">品牌清仓</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/economical_brand.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">名品折扣</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/oversea.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">海淘</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/assist_free_coupon.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">助力享免单</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_19.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">手机充值</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_18.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">家居优品</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/sing_china_vote_v2.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">新歌声投票</div>
          </div>
        </li>
        <li class="qes-row">
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_15.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">爱逛街</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_12.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">9块9特卖</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/attendance_new.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">现金签到</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_17.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">美食汇</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_20.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">省钱妈咪</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_23.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">电器城</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/subjects_22.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">时尚穿搭</div>
          </div>
          <div class="scroll-item">
            <div><img src="http://pinduoduoimg.yangkeduo.com/entrance/v5/flash_groups.png" alt="" class="scroll-img"></div>
            <div class="scroll-txt">极速红包</div>
          </div>
        </li>
      </ul>
    </div>

    <div class="index-goodsList">
      <div class="goods-info" @click="toDetail">
        <div class="goods-header"><img src="http://omsproductionimg.yangkeduo.com/images/2017-09-13/f4ef3dc93b9439fd71fe7d9d91b094cd.jpeg@750w_1l_50Q" alt="" class="goods-img"></div>
        <div class="goods-info-title">{{title}}</div>
        <div class="goods-rows">
          <div class="goods-rows-left">
            <span class="discount">￥{{discount}}</span>
            <span class="txt">{{peopleNumber}}人拼单，单买价{{price}}元</span>
          </div>
          <div class="btn-go">
            <div class="btn-txt">去拼单</div>
          </div>
        </div>
      </div>
      <div class="goods-info">
        <div class="goods-header"><img src="http://omsproductionimg.yangkeduo.com/images/2017-04-28/6d99b7cb743da393797b650697bb1197.jpeg@750w_1l_50Q" alt="" class="goods-img"></div>
        <div class="goods-info-title">{{title}}</div>
        <div class="goods-rows">
          <div class="goods-rows-left">
            <span class="discount">￥{{discount}}</span>
            <span class="txt">{{peopleNumber}}人拼单，单买价{{price}}元</span>
          </div>
          <div class="btn-go">
            <div class="btn-txt">去拼单</div>
          </div>
        </div>
      </div>
      <div class="goods-info">
        <div class="goods-header"><img src="http://omsproductionimg.yangkeduo.com/images/goods/1702221747896886/PBAGxwcLgGVyw49PWUL9VbPDKZwyR1Km.jpg@750w_1l_50Q" alt="" class="goods-img"></div>
        <div class="goods-info-title">{{title}}</div>
        <div class="goods-rows">
          <div class="goods-rows-left">
            <span class="discount">￥{{discount}}</span>
            <span class="txt">{{peopleNumber}}人拼单，单买价{{price}}元</span>
          </div>
          <div class="btn-go">
            <div class="btn-txt">去拼单</div>
          </div>
        </div>
      </div>

    </div>

    <div class="footer">
      <div class="footer-rows">
        <div class="footer-rows-item" @click="goHome">
          <!-- <img src="../../assets/img/pinduoduo/tabbar.png" alt="" class="footer-img"> -->
          <div class="footer-img footer-img-1" :class="{ 'footer-index': isClick===1 }"></div>
           <div :class="{'active': isClick ===1}">首页</div> 
        </div>
         <div class="footer-rows-item" @click="goNew">
          <div class="footer-img footer-img-2" :class="{ 'footer-new': isClick===2 }"></div>
          <div :class="{'active': isClick ===2}">新品</div>
        </div>
        <div class="footer-rows-item" @click="goSearch">
          <div class="footer-img footer-img-3" :class="{ 'footer-search': isClick ===3 }"></div>
          <div :class="{'active': isClick ===3}">搜索</div>
        </div>
        <div class="footer-rows-item" @click="goTalk">
          <div class="footer-img footer-img-4" :class="{ 'footer-talk': isClick ===4 }"></div>
          <div :class="{'active': isClick ===4}">聊天</div>
        </div>
        <div class="footer-rows-item" @click="goUser">
          <div class="footer-img footer-img-5" :class="{ 'footer-user': isClick ===5 }"></div>
          <div :class="{'active': isClick ===5}">个人中心</div>
        </div> 
      </div>
    </div>
  </div>
</template>

<script>
import { Swiper } from 'vux'

const imgList = [
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/f130fb05f4ba38903a59aa70ba5d4f1e.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-12/51470104b5208fff11ed397dd15f1714.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-10/cae26ff9e838ec2ef8fd74aecadff1d6.jpeg',
  'http://boringcdn.bewifing.net/FjdIW_GAZt39xMcxvDAYyjvDIxeM',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-10/c5d4eed6a319ae263b837940b25530c2.jpeg'
]

const urlList = imgList.map((one, index) => ({
  url: 'javascript:', // 这里填写图片点击的链接
  img: one
}))

export default {
  name: 'app',
  data () {
    return {
      imgs: urlList,
      title: '华为Meta9 Pro旗舰手机 4GB+64GB 全网通移动联通电信4G手机',
      peopleNumber: '999',
      price: '9699',
      discount: '9999',
      isClick: 1
    }
  },
  components: {
    Swiper
  },
  methods: {
    goHome () {
      // return this.$router.push('/pinduoduoIndex')
      this.isClick = 1
    },
    goNew () {
      this.isClick = 2
      return this.$router.push('/newgoods')
    },
    goSearch () {
      this.isClick = 3
    },
    goTalk () {
      this.isClick = 4
    },
    goUser () {
      this.isClick = 5
      return this.$router.push('/pinduoduoUser')
    },
    clearance () {
      return this.$router.push('/pinduoduoClearance')
    },
    seckill () {
      return this.$router.push('/pinduoduoSeckill')
    },
    toDetail () {
      return this.$router.push('/goodsDetail')
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.swiper {
  margin-top: .7rem;
}
ul {
  list-style: none;
}
.quick-entrance-scroll {
  background: white;
  padding: .1rem .1rem;
  display: block;
  /* position: relative; */
}
.qes-scroller {
  width: 6.16rem;
  transform: translate(0px, 0px);
  overflow: auto;
}
.qes-row {
  display: block;
  white-space: nowrap;
  font-size:0;
}
.scroll-item {
  padding: .05rem .12rem;
  display: inline-block;
}

.scroll-img {
  width: .6rem;
  height: .6rem;
  margin: 0 .2rem;
  vertical-align: middle;
}
.scroll-txt {
  width: 1rem;
  text-align: center;
  color: #969696;
  font-size: .2rem;
}

.isScrollHorizontaScrollbar {
  transform: scalex(.267);
  border-radius: .2rem;
  z-index: 1 !important;
  left: 0 !important;
  right: 0 !important;
  height: .02rem !important;
  background: #e8e8e8!important;
  margin-bottom: .1rem; 
  position: absolute;
  bottom: 0;

}
.isScrollIndicator {
  border: none !important;
  height: .02rem !important;
  background: #ff6969!important;

  /* box-sizing: border-box;
  position: absolute;
  background: rgba(0, 0, 0, 0.5);
  border-radius: 3px;
  transition-duration: 0ms;
  display: block;
  width: 234px;
  transform: translate(0px, 0px); */
}
.goods-info {
  margin-top: .2rem;
  background: white;
  padding-bottom: .2rem;
}

.goods-img {
  width: 100%;
}
.goods-info-title {
  padding: 0 .2rem;
  font-size: .25rem;
  color: #34495E;
}
.goods-rows {
  display: flex;
  justify-content: space-between;
  padding: 0 .2rem;
  color: white;
  margin-top: .15rem;
}
.btn-go {
  width: 1.6rem;
  height: .5rem;
  background: red;
  border-radius: 3px;
  line-height: .55rem;
  color: white;
  text-align: center;
}
.btn-txt {
  font-size: .25rem;
  display: inline-flex;
}
.btn-txt::after {
  content: "";
  width: .13rem;
  height: .13rem;
  border-right: 2px solid white;
  border-bottom: 2px solid white;
  transform: rotate(-45deg);
  display: inline-flex;
  margin-top: .17rem; 
  margin-left: .1rem;
}
.discount {
  font-size: .3rem;
  color: red;
}
.txt {
  color: #9c9c9c;
  font-size: .2rem;
}
.goods-rows-left {
  width: 4.5rem;
}

 .index-goodsList {
  margin-bottom: 1rem;
} 
.footer-rows {
  display: flex;
  flex-direction: row;
  color: #777;
}
.footer-rows-item {
  font-size: .2rem;
  flex-grow: 1;
  text-align: center;
}
</style>
