<template>
  <div class="pinduoduoUser">
    <!-- 顶部： 头像+电话号码  -->
    <div class="head">
      <div class="head-bg">
        <!-- 头像  -->
        <div class="personal-head">
          <img src="../../assets/img/404.jpg" alt="" class="header-img">
          <span>13607872764</span>
        </div>
      </div>
      <div>
        <div class="rows">
          <span>我的订单</span>
          <span class="rows-right">查看全部</span>
        </div>
      </div>
      <div class="personal-wrapper-1 rows ">
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-1"></div>
          <p>待付款</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-2"></div>
          <p>待拼单</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-3"></div>
          <p>待发货</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-4"></div>
          <p>待收货</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-5"></div>
          <p>待评价</p>
        </div>
      </div>
      
    </div>
    <div class="personal-wrapper-2 rows">
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-11"></div>
          <p>我的消息</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-22"></div>
          <p>我的优惠券</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-33"></div>
          <p>我的收藏</p>
        </div>
        <div class="personal-wrapper-item">
          <div class="personal-wrapper-item-bg item-bg-44"></div>
          <p>退款/售后</p>
        </div>
      </div>

    <div class="personal-list">
      <ul>
        <li>
          <div class="personal-list-item-bg list-bg-1"></div>
          <span>我的足迹</span>
        </li>
        <li>
          <div class="personal-list-item-bg list-bg-2"></div>
          <span>我的抽奖</span>
        </li>
        <li>
          <div class="personal-list-item-bg list-bg-3"></div>
          <span>我的拼单</span>
        </li>
        <li>
          <div class="personal-list-item-bg list-bg-4"></div>
          <span>我的免单券</span>
        </li>
        <li @click="toAddress">
          <div class="personal-list-item-bg list-bg-5"></div>
          <span>我的收货地址(可点击)</span>
        </li>
        <li>
          <div class="personal-list-item-bg list-bg-6"></div>
          <span>设置</span>
        </li>
      </ul>
    </div>

    <div class="footer">
      <div class="footer-rows">
        <div class="footer-rows-item" @click="goHome">
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
      isClick: 5
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
    },
    toAddress () {
      return this.$router.push('/address')
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.pinduoduoUser{
  padding-bottom: 1rem;
}
.personal-list {
  margin-top: .2rem;
}
.personal-list ul {
  list-style-type: none;
  background: white;
}
.personal-list li {
  margin-left: .2rem;
  padding: .2rem 0;
  border-bottom: 1px solid rgba(119, 119, 119, 0.2);
  line-height: .2rem;
}
.personal-list span {
  position: relative;
  top: -.1rem;
}
.personal-list-item-bg  {
  width:  .4rem;
  height: .4rem;
  background: url('../../assets/img/pinduoduo/personal_sprite.png') no-repeat;
  background-size: 1600%;
  display: inline-block;
}
.list-bg-1 {
  background-position: 100% 94%;
}
.list-bg-2 {
  background-position: 61.35% 94%;
}
.list-bg-3 {
  background-position: 68% 94%;
}
.list-bg-4 {
  background-position: 74.5% 94%;
}
.list-bg-5 {
  background-position: 11.5% 94%;
}
.list-bg-6 {
  background-position: 36.6% 94%;
}
.personal-wrapper-2 {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  border-bottom: none !important;
  margin-top: .2rem;
}
.personal-wrapper-1 {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  border-bottom: none !important;
  padding: .1rem !important; 
}
.personal-wrapper-item {
  flex-grow: 1;
  text-align: center;
  font-size: .2rem;
  color:#5f5f5f;
}
.personal-wrapper-item-bg {
  width: .5rem;
  height: .5rem;
  background: url('../../assets/img/pinduoduo/personal_sprite.png') no-repeat;
  background-size: 1500%;
  margin: 0 auto;
}
.item-bg-1 {
  background-position: 34% 69%;
}
.item-bg-2 {
  background-position: 0 69%;
}
.item-bg-3 {
  background-position: 13% 69%;
}
.item-bg-4 {
  background-position: 6.5% 69%;
}
.item-bg-5 {
  background-position: 20% 69%;
}
.item-bg-11 {
  background-position: 0 82%;
  margin-bottom:.1rem;
}
.item-bg-22 {
  background-position: 8.25% 82%;
  margin-bottom:.1rem;
}
.item-bg-33 {
  background-position: 49% 82%;
  margin-bottom:.1rem;
}
.item-bg-44 {
  background-position: 40.8% 82%;
  margin-bottom:.1rem;
}
.head-bg {
  width:100%;
  height: 2rem;
  background: url('../../assets/img/pinduoduo/personal_sprite.png') no-repeat;
}
.rows-right {
  float: right;
  margin-right: 0rem;
  font-size: .2rem;
  color: rgba(119, 119, 119, 0.5);
  line-height: .5rem;
}
.rows-right::after {
  content: '';
  display: inline-block;
  width: .15rem;
  height: 0.15rem;
  border-right: 2px solid rgba(119, 119, 119, 0.2);
  border-bottom: 2px solid rgba(119, 119, 119, 0.2);
  transform: rotate(-45deg);
  margin-left: .2rem;
}
.personal-head {
  padding-top: .5rem;
  padding-left: .3rem;
  color: white;
}
.personal-head span {
  margin-left:.2rem;
}
.header-img {
  width: 1rem;
  height: 1rem;
  border: 1px solid #ed9a97;
  border-radius: 50%;
  vertical-align: middle;
}
.rows {
  padding: .2rem;
  background: white;
  border-bottom: 1px solid rgba(119, 119, 119, 0.2);
  font-size: .25rem;
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

.icon, i, em {
  font-style: normal;
}
</style>

