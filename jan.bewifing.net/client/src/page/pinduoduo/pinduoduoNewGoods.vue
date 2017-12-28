<template>
  <div class="pinduoduoNewGoods">
    <div class="head">
      <div class="head-item">
        <div><img src="../../assets/img/pinduoduo/floor.png" alt="" class="head-img">
          <span>邻里团</span>
        </div>
        <div>身边的人都在拼</div>
        <div>
          <img src="../../assets/img/pinduoduo/anger.png" alt="" class="head-item-left">
          <img src="../../assets/img/pinduoduo/overdue.png" alt="" class="head-item-left">
          <img src="../../assets/img/pinduoduo/anger.png" alt="" class="head-item-left">
          <img src="../../assets/img/pinduoduo/overdue.png" alt="" class="head-item-left">
        </div>
      </div>
      <div class="line"></div>
      <div class="head-item">
        <div><img src="../../assets/img/pinduoduo/magic.png" alt="" class="head-img">
          <span>精选专题</span>
        </div>
        <div>你要的，都整理好了</div>
        <div></div>
      </div>
    </div>
    <div class="content">
      <div class="content-head"><img src="../../assets/img/pinduoduo/jingxuan.png" alt="" class="icon">
        <span class="mt-01">精选商品</span>
      </div>
      <div class="goodslist">
        <div class="goodslist-item">
          <div class="image"><img src="https://g-search1.alicdn.com/img/bao/uploaded/i4/i1/TB11yRLIpXXXXcJXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg" alt="" class="goodslist-item-img"></div>
          <div class="title">{{title}}</div>
          <div class="price">￥{{price}}</div>
        </div>
        <div class="goodslist-item">
          <div class="image"><img src="https://img.alicdn.com/imgextra/i3/11563585/TB2MWgsXHKFJuJjSszgXXXVnXXa_!!0-saturn_solar.jpg_270x270.jpg" alt="" class="goodslist-item-img"></div>
          <div class="title">歌瑞尔秋冬新款甜美刺绣性感小胸聚拢内衣时尚可爱女士文胸罩慕艇</div>
          <div class="price">￥{{price}}</div>
        </div>
        <div class="goodslist-item">
          <div class="image"><img src="https://g-search1.alicdn.com/img/bao/uploaded/i4/i1/TB11yRLIpXXXXcJXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg" alt="" class="goodslist-item-img"></div>
          <div class="title">{{title}}</div>
          <div class="price">￥{{price}}</div>
        </div>
        <div class="goodslist-item">
          <div class="image"><img src="https://img.alicdn.com/imgextra/i3/11563585/TB2MWgsXHKFJuJjSszgXXXVnXXa_!!0-saturn_solar.jpg_270x270.jpg" alt="" class="goodslist-item-img"></div>
          <div class="title">歌瑞尔秋冬新款甜美刺绣性感小胸聚拢内衣时尚可爱女士文胸罩慕艇</div>
          <div class="price">￥{{price}}</div>
        </div>
        <div class="goodslist-item">
          <div class="image"><img src="https://g-search1.alicdn.com/img/bao/uploaded/i4/i1/TB11yRLIpXXXXcJXpXXXXXXXXXX_!!0-item_pic.jpg_250x250.jpg" alt="" class="goodslist-item-img"></div>
          <div class="title">{{title}}</div>
          <div class="price">￥{{price}}</div>
        </div>
        <div class="goodslist-item">
          <div class="image"><img src="https://img.alicdn.com/imgextra/i3/11563585/TB2MWgsXHKFJuJjSszgXXXVnXXa_!!0-saturn_solar.jpg_270x270.jpg" alt="" class="goodslist-item-img"></div>
          <div class="title">歌瑞尔秋冬新款甜美刺绣性感小胸聚拢内衣时尚可爱女士文胸罩慕艇</div>
          <div class="price">￥{{price}}</div>
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
export default {
  data () {
    return {
      title: '【商务三折伞】超强抗风加固成人商务加叠防晒雨伞',
      price: '30',
      isClick: 2
    }
  },
  methods: {
    goHome () {
      this.isClick = 1
      return this.$router.push('/pinduoduoIndex')
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
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.head {
  width: 100%;
  display: flex;
  flex-direction: row;
  background: white;
}
.head-item {
  flex-grow: 1;
  text-align: center;
  margin: .2rem;
  width: 100%;
}
.line {
  border: 0.1px solid rgba(119, 119, 119, 0.1);
  margin: .15rem 0;
}
.head-img {
  width: .35rem;
  vertical-align: middle;
  margin-top: -.1rem
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
.head-item-left {
  width: .5rem;
  height: .5rem;
  border-radius: .5rem;
  border: 1px solid #e8e8e8;
  margin-left: -.2rem;
}
.content {
  margin-top:.2rem;
  margin-bottom: 1rem;
}
.icon {
  width: .3rem;
  vertical-align: middle;
  margin-top: -.1rem;
  margin-right:.1rem;
}
.content-head {
  text-align: center;
  background: white;
  padding: .2rem;
  font-weight: bold;
  color: #e02e24;
  font-size: .25rem;
  border-bottom: 1px solid #f0f0f0;
}
.image {
  width: 100%;
  height: 3rem;
}
.goodslist-item-img {
  width: 100%;
  height:auto;
  max-height: 3rem;
}
.goodslist {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.goodslist-item {
  width: 3rem;
  flex-grow: 1;
  margin: 0 .05rem;
  background: white;
}
.price {
  color: #e02e24;
  font-size: .25rem;
  padding: .1rem;
  font-weight: bold;
}
.title {
  width: 3.1rem;
  height: .8rem;
  max-height: .8rem;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: .1rem .1rem;
}

</style>
