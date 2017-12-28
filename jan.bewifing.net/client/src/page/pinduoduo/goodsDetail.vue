<template>
  <div class="goodsDetail" ref="box">
    <!--图片轮播图  -->
    <div class="swiper">
      <swiper :list="imgs" auto style="width:100%; margin:0 auto;" :aspect-ratio="480/480" dots-class="custom-bottom" dots-position="center"></swiper>
    </div>
    <!-- 商品说明  -->
    <div class="goodsdexplain">
      <div class="g-explain">
        <!--价格  -->
        <div class="rows">
          <span class="discount">￥{{ goods.discount }}</span>
          <span class="price ml02 color-gray">￥{{ goods.price }}</span>
        </div>
        <!-- 标题  -->
        <div class="rows">
          <div class="title">{{ goods.title}}</div>
        </div>
        <!-- 内容  -->
        <div class="g-desc">
          <div class="mt01 fs022 ">{{ goods.content }}</div>
          <!-- 规则  -->
          <div class="g-rule">
            <p>规则</p>
            <p>活动时间: 9月13日00:00~9月22日16:00</p>
            <ol>
              <li>活动结束后将从拼单成功的所有订单中，随机选取1名试用者赠送。</li>
              <li>一等奖为iPhone X，二等奖为88元优惠券。</li>
              <li>试用的商品预计9月24日发放。</li>
              <li>试用者完成试用报告后可以保留试用品。</li>
            </ol>
          </div>
        </div>
      <div class="rows color-2 fs013 service-list">
        <span class="service-list-span"><img src="../../assets/img/pinduoduo/nike.png" alt="" class="icon">全场包邮</span>
        <span class="service-list-span"><img src="../../assets/img/pinduoduo/nike.png" alt="" class="icon">7天退换</span>
        <span class="service-list-span"><img src="../../assets/img/pinduoduo/nike.png" alt="" class="icon">假一赔十</span>
      </div>
      </div>
    </div>
    
      <!-- 商品详情  -->
      <div class="g-detail">
        <div class="g-detail-title">商品详情</div>
        <div class="g-detail-list">
          <ul>
            <li><img src="http://omsproductionimg.yangkeduo.com/images/2017-06-18/98b130304cc63c0065fdfe1c1383283f.jpeg" alt="" class="g-detail-list-img"></li>
            <li><img src="http://omsproductionimg.yangkeduo.com/images/2017-06-15/dfc8c3c3dd379cfa5c70e0872f977332.jpeg" alt="" class="g-detail-list-img"></li>
            <li><img src="http://omsproductionimg.yangkeduo.com/images/2017-06-14/521887cded75696d8a8aa2383b22bf77.jpeg" alt="" class="g-detail-list-img"></li>
            <li><img src="http://omsproductionimg.yangkeduo.com/images/2017-06-14/dfebcdb94daa04b2ec7295a834cc659d.jpeg" alt="" class="g-detail-list-img"></li>
          </ul>
        </div>
        <!-- 价格说明  -->
        <div class="btn-display" @click="display" v-show="!istrue">点击查看商品价格说明</div>
        <div class="g-price" v-show="istrue">
          <div class="g-detail-title color-1 fs028">价格说明</div>
          <ul>
            <li><i>单独购买价：</i>是您单独购买商品的价格</li>
            <li><i>一键拼单价</i>是您拼单购买商品的价格</li>
            <li><i>划线价</i>可能是商品的专柜价、吊牌价、零售价、指导价或该商品曾经展示过的销售价等，<i>并非《价格法》、《禁止价格欺诈行为的规定》规定的“原价”，</i>仅供您参考</li>
            <li><i>特别提示：</i>实际的成交价格可能因您使用优惠券等发生变化，最终以订单结算页的价格为准。若商家单独对价格进行说明的，以商家的表述为准</li>
          </ul>
        </div>
      </div>

      <div class="goods-recommend-title">为你推荐</div>
      <div class="recommend-content">
         <div class="recommend-goodslist">
           <div class="recommend-goodslist-item">
            <div class="recommend-image"><img src="https://g-search1.alicdn.com/img/bao/uploaded/i4/i1/TB11yRLIpXXXXcJXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg" alt="" class="recommend-goodslist-item-img"></div>
            <div class="recommend-title">【商务三折伞】超强抗风加固成人商务加叠防晒雨伞</div>
            <div class="recommend-price">￥30</div>
          </div>
          <div class="recommend-goodslist-item">
            <div class="recommend-image"><img src="https://img.alicdn.com/imgextra/i3/11563585/TB2MWgsXHKFJuJjSszgXXXVnXXa_!!0-saturn_solar.jpg_270x270.jpg" alt="" class="recommend-goodslist-item-img"></div>
            <div class="recommend-title">歌瑞尔秋冬新款甜美刺绣性感小胸聚拢内衣时尚可爱女士文胸罩慕艇</div>
            <div class="recommend-price">￥30</div>
          </div>
          <div class="recommend-goodslist-item">
            <div class="recommend-image"><img src="http://omsproductionimg.yangkeduo.com/images/2017-09-24/d75bee6421e7f15e7be9bd9a552a723f.jpeg" alt="" class="recommend-goodslist-item-img"></div>
            <div class="recommend-title">呆呆兔 蛋黄月饼6个300g/12个600g多规格可选  中秋中秋传统糕点零食</div>
            <div class="recommend-price">￥30</div>
          </div>
          <div class="recommend-goodslist-item">
            <div class="recommend-image"><img src="http://omsproductionimg.yangkeduo.com/images/2017-09-25/8b0a0ab6c3a6365b7c3d23efd50603f0.jpeg" alt="" class="recommend-goodslist-item-img"></div>
            <div class="recommend-title">【浪莎正品】【多款家居服任选】睡衣女春秋季长袖少女韩版秋冬宽松修身圆领睡衣薄款棉质家居服套装【上衣+长裤】</div>
            <div class="recommend-price">￥30</div>
          </div>
         </div>
      </div>

      <div class="goods-recommend-bottom">
        <div class="baseline"></div>
          <p>已经到达底部了</p>
      </div>

      <div class="toTop" v-show="isTop" ref="top">顶部</div>

    <!-- 下面就是图片+价格说明  -->

    <!-- 底部是固定的菜单栏：(首页+收藏+客服),单独购买+一键开团  -->
      <div class="footer" >
      <div class="footer-rows">
      <div class="btn-home" @click="goHome">首页</div>
       <div class="btn-collection">收藏</div>  
      <div class="btn-service" @click="goService">客服</div>
      <div class="btn-buy transparent">
        <div>￥{{goods.price}}</div>
        <div>单独购买</div>
      </div>
      <div class="btn-buy btn-buy-2">
        <div>￥{{goods.discount}}</div>
        <div>一键开团</div>
      </div> 
      </div>
    </div>  
  </div>
</template>
<script>
import { Swiper } from 'vux'

const imgList = [
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/c31e16550020b8ec6c19a89208ea23c9.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/77a1738ea5032c12536ef23a7f42e146.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/84abc9be751729df7d7f906b2034fd21.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/85401eb6bd64d54331e521e076c65dd9.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/410ecff1250ca2a7cac1d86d9e37a36d.jpeg',
  'http://omsproductionimg.yangkeduo.com/images/2017-09-13/4a4e691f3a3c5b583e97ba7f9f6805a1.jpeg'
]

const urlList = imgList.map((one, index) => ({
  url: 'javascript:', // 这里填写图片点击的链接
  img: one
}))

export default {
  data () {
    return {
      imgs: urlList,
      goods: {
        content: '一直以来，我们都心存一个设想，期待着能够打造出这样一部 iPhone：它有整面的屏幕，能让你在使用时完全沉浸其中，仿佛忘记了它的存在。它是如此智能，你的一触、一碰、一言、一语，哪怕是轻轻一瞥，都会得到它心有灵犀的回应。而这个设想，终于随着 iPhone X 的到来成为了现实。现在，就跟未来见个面吧。',
        price: 9980,
        discount: 0,
        title: '【新品首发】iPhone X  256GB手机  5.8 英寸显示屏 银色/深空灰色 2色可选【特别提示】该商品11月3日开始发货',
        priceDescription: '' // 价格说明
      },
      istrue: false,
      isTop: false
    }
  },
  components: {
    Swiper
  },
  methods: {
    display () {
      this.istrue = true
    },
    goHome () {
      return this.$router.push('/pinduoduoindex')
    },
    goService () {
      return this.$router.push('/pinduoduoService')
    }
  }
  // mounted () {
  //   var self = this
  //   this.$nextTick(function () {
  //     window.addEventListener('scroll', self.noScroll)
  //   })
  // }
}
</script>


<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.goodsDetail {
  padding-bottom: 1rem; 
}
.toTop {
  width: .75rem;
  height: .75rem;
  background: white;
  border: 1px solid #9c9c9c;
  border-radius: .5rem;
  text-align: center;
  line-height: .9rem;
  position: fixed;
  bottom: 1.1rem;
  left: 5.3rem;
  font-size: .2rem;
}
.toTop::before {
  content: '';
  display: block;
  width: .15rem;
  height: .15rem;
  border-top: 1px solid #9c9c9c;
  border-right: 1px solid #9c9c9c;
  transform: rotate(-45deg);
  position: absolute;
  top: .16rem;
  left: .25rem;
}
.goods-recommend-bottom p {
  width: 2rem;
  position: relative;
  top: -.24rem;
  left: 50%;
  margin-left: -1rem;
  padding: 0 .1rem;
  font-size: .14rem;
  background: #f7f7f7;
  color: #9c9c9c;
}
.goods-recommend-bottom {
  height: .5rem;
  width: 100%;
  line-height: .5rem;
  text-align: center;
  margin-top: .2rem;
}
.baseline {
  width: 90%;
  height: .25rem;
  border-bottom: 1px solid #e0e0e0;
  margin: 0 auto;
}
.recommend-price {
  color: #e02e24;
  font-size: .25rem;
  padding: .1rem;
  font-weight: bold;
}
.recommend-title {
  width: 3.1rem;
  height: .8rem;
  max-height: .8rem;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: .1rem .1rem;
}
.recommend-goodslist-item-img {
  width: 100%;
  height:auto;
  max-height: 3rem;
}
.recommend-goodslist {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.recommend-goodslist-item {
  width: 3rem;
  flex-grow: 1;
  margin: 0 .05rem;
  background: white;
}
.content {
  margin-top:.2rem;
  margin-bottom: 1rem;
}
.goods-recommend-title {
  width: 100%;
  text-align: center;
  color: #ff7878;
  font-size: .28rem;
  padding: .2rem 0;
}
.goods-recommend-title::before {
  content: "";
  background: url('../../assets/img/pinduoduo/recommend.png');
  display: inline-block;
  background-size: 100%;
  width: .3rem;
  height: .3rem;
  position: relative;
  top: .05rem;
  margin-right: .1rem; 
}
.btn-display {
  width:100%;
  font-size: .25rem;
  color: rgba(128, 124, 124, 0.7);
  text-align: center;
  padding: .2rem 0;
}
.btn-display::after {
  content: "";
  display: inline-block;
  width: .15rem;
  height:  .15rem;
  border-right: 1px solid #c5c5c5;
  border-bottom: 1px solid #c5c5c5;
  transform: rotate(45deg);
  margin-left: .15rem;
  position: relative;
  top: -.05rem;
}
.g-price {
  color: rgba(128, 124, 124, 0.7);
  font-size: .23rem;
  line-height: .44rem;
}
.g-price ul {
  margin-top: .1rem;
}
.g-price li i{
  color: black;
}
.g-detail-list-img {
  width:100%;
  
}
.g-detail-list {
  margin-top: .2rem;
}
.g-detail-list li {
  list-style-type: none;
}
.g-detail-title {
  border-bottom: 1px solid #f2f2f2;
  padding: .1rem 0;
}
.g-detail {
  margin-top: .2rem;

  background: white;
  padding: .2rem;
}
.btn-home {
  flex-grow: 1;
  font-size: .2rem;
  padding: .1rem 0;
  border-right: 1px solid #f2f2f2;
}
.btn-home::before {
  content: "";
  background: url('../../assets/img/pinduoduo/home.png') no-repeat;
  width: .4rem;
  height: .4rem;
  background-size: 100%;
  display: block;
  margin: 0 auto;
}
.btn-collection {
  flex-grow: 1;
  font-size: .2rem;
  padding: .1rem 0;
  border-right: 1px solid #f2f2f2;
}
.btn-collection::before {
  content: "";
  background: url('../../assets/img/pinduoduo/collection.png') no-repeat;
  width: .4rem;
  height: .4rem;
  background-size: 100%;
  display: block;
  margin: 0 auto;
}
.btn-service {
  flex-grow: 1;
  font-size: .2rem;
  padding: .1rem 0;
  border-right: 1px solid #f2f2f2;
}
.btn-service::before {
  content: "";
  background: url('../../assets/img/pinduoduo/service.png') no-repeat;
  width: .4rem;
  height: .4rem;
  background-size: 100%;
  display: block;
  margin: 0 auto;
}
.btn-buy {
  flex-grow: 2;
  text-align: center;
  background: #e02e24;
  color: white;
  padding: .1rem 0;
}
.btn-buy-2 {
  flex-grow: 4;
  border-right: none;
}
.transparent {
  background: rgba(224, 46, 36, 0.3);
}
.footer-rows {
  display: flex;
  flex-direction: row;
  color: #777;
  text-align: center;
}
.goodsdexplain {
  background: white;
}

.g-explain {
  padding: 0 .2rem;
}

.g-desc {
  color: #58595b;
}

.g-rule {
  padding-top: .1rem;
  font-size: .22rem;
}

.g-rule ol {
  padding: 0 .2rem .2rem .2rem;
  border-bottom: 1px solid rgba(136, 137, 138, 0.1);
}

.service-list {
  padding: .15rem 0;
}

.service-list-span {
  position: relative;
  margin-left: .2rem;
}

.service-list::after {
  content: "";
  width: .13rem;
  height: .13rem;
  border-right: 1.5px solid #cfcfcf;
  border-bottom: 1.5px solid #cfcfcf;
  transform: rotate(-45deg);
  display: inline-block;
  position: relative;
  left: 1.3rem;
}

.title {
  width: 100%;
  font-weight: bold;
  font-size: .25rem;
}

.price {
  text-decoration: line-through;
}

.discount {
  font-size: .4rem;
  color: #e02e24;
}

.rows {
  width: 100%;
  margin-top: .1rem;
}

.ml02 {
  margin-left: .2rem;
}

.color-gray {
  color: #88898a;
}

.mt01 {
  margin-top: .1rem;
}

.fs022 {
  font-size: .22rem;
}
.color-2 {
  color:#58595b;
}
.icon {
  width:.3rem;
  height: .3rem;
  vertical-align: middle;
  position: relative;
  top: -.02rem;
}
.color-1 {
  color: #9a9a9c;
}
.fs028 {
  font-size: .28rem;
}
.icon, i, em {
  font-style: normal;
}
</style>
