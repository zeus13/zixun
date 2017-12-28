<template>
<section class="bigImg">

  <div class="bigImg_container" v-if="demoshow" transition="expand">
      <swiper :height="screenHeight" :index="demoindex" @on-index-change="onIndexChange" v-show="demotype === 1">
        <swiper-item class="swiper-demo-img" v-for="item in demolist"><img :src="item.src"></swiper-item>
      </swiper>
      
      <swiper :height="screenHeight" :index="demoindex" @on-index-change="onIndexChange" v-show="demotype === 2">
        <swiper-item class="swiper-demo-img" v-for="item in demolist"><img :src="item"></swiper-item>
      </swiper>

      <div class="bigImg_bar">
        <p> {{demoindex+1}}/{{demolist.length}}</p>
        <div class="bigImg_button"><i class="fa fa-close fa-2x"></i></div>
      </div>
  </div>
  <div>
</section>
</template>

<script>
import { Swiper, SwiperItem, XButton } from 'vux/src/components'
export default {
  components: {
    Swiper,
    SwiperItem,
    XButton
  },
  props: {
    demolist: [],
    demoshow: false,
    demoindexs: -1,
    demotype: 1 // 传入数组的格式:1表示[{src: ''},{src: ''}];2表示['','','']
  },
  data () {
    return {
      screenHeight: '',
      demoindex: 0
    }
  },
  ready () {
    this.screenHeight = (window.screen.height - 40) + 'px'
  },
  methods: {
    onIndexChange (index) {
      this.demoindex = index
    }
  },
  watch: {
    demoindexs (val) {
      this.demoindex = val
    }
  }
}
</script>

<style lang="less">
.bigImg{

  /* 重新定义vux-swiper 垂直居中 */
  .vux-slider > .vux-swiper > .vux-swiper-item {
    display: -webkit-flex;
    display: flex;
    -webkit-align-items: center;
    align-items: center;
  }
  /* 隐藏滑动小圆点 */
  .vux-indicator{
    display: none;
  }

  /* 淡出淡入动画必需 */
  .expand-transition {
    transition: all .4s ease;
  }

  /* .expand-enter 定义进入的开始状态 */
  /* .expand-leave 定义离开的结束状态 */
  .expand-enter, .expand-leave {
    opacity: 0;
  }

  .bigImg_container{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: #000;
    color: #fff;
    z-index: 999;
  }
  .show{
    display: block;
  }
  .bigImg_wrap{
    width: 100%;
    height: 100%;
    display: -webkit-flex; /* Safari */
    display: flex;
    -webkit-align-items: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
  }
  .bigImg_img{
    width: 100%;
  }
  .bigImg_bar{    
    position: fixed;
    left: 0; 
    top: 0;
    height: 44px;
    line-height: 44px;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .bigImg_bar p{
    font-size: 16px;
    padding-left: 10px;
  }
  .bigImg_button{
    width: 44px;
    height: 44px;
    line-height: 50px;
    text-align: center;
    color: #fff;
    position: absolute;
    top: 0;
    right: 0;
  }
  .text-scroll {
    border: 1px solid #ddd;
    border-left: none;
    border-right: none;
  }
  .text-scroll p{
    font-size: 12px;
    text-align: center;
    line-height: 30px;
  }
  .black {
    background-color: #000;
  }
  .title{
    line-height: 100px;
    text-align: center;
    color: #fff;
  }
  .animated {
    animation-duration: 1s;
    animation-fill-mode: both;
  }
  .vux-indicator.custom-bottom {
    bottom: 30px;
  }
  @-webkit-keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translate3d(0, 100%, 0);
    }
    100% {
      opacity: 1;
      transform: none;
    }
  }
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translate3d(0, 100%, 0);
    }
    100% {
      opacity: 1;
      transform: none;
    }
  }
  .fadeInUp {
    animation-name: fadeInUp;
  }
  .swiper-demo-img img {
    width: 100%;
  }
}
</style>