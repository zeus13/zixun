<template>
  <div class="demotest">
    <!--<button @click="show=!show">
            Toggle render
          </button>
          <transition 
          name="custom-classes-transition"
          enter-active-class="animated bounceIn"
          leave:-active-class="animated bounceOutRight"
          >
            <p v-if="show">hello word</p>
          </transition>-->
    <div class="masklayer" v-if="mask"></div>
    <div class="popup" >
      <div class="bag-header color-1">
        <div class="f-3 ">现金红包</div>
        <div class="f-4 ">￥88.88</div>
      </div>
      <div class="bag-content f-3">
        <div>由于你的超强人品，</div>
        <div>获得了<span style="font-weight: bold">现金红包88.00元</span></div>
      </div>
      <div class="btn">
        <span>藏到小金库</span>
      </div>
    </div>
  
    <div class="bg-1" style="display: none;">
  
      <img src="../../assets/img/bg-top2.png" alt="" class="bg-top">
      <div class="div-b"></div>
      <div class="btn-hecheng" :class="{'btn-hecheng2': isTouch}" @touchstart="changeTouch"></div>
      <div class="circle" :class="{'show': isShow}" ref="aniEnd">
        <div class="square" style="transform: rotate(0deg)">
          <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
        </div>
        <div class="square" style="transform: rotate(32.7deg)">
          <div class="square-item" style="transform: rotate(-32.7deg);">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(65.4deg)">
          <div class="square-item" style="transform: rotate(-65.4deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(98.1deg)">
          <div class="square-item" style="transform: rotate(-98.1deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(130.8deg)">
          <div class="square-item" style="transform: rotate(-130.8deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(163.5deg)">
          <div class="square-item" style="transform: rotate(-163.5deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(196.2deg)">
          <div class="square-item" style="transform: rotate(-196.2deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(228.9deg)">
          <div class="square-item" style="transform: rotate(-228.9deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(261.6deg)">
          <div class="square-item" style="transform: rotate(-261.6deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(294.3deg)">
          <div class="square-item" style="transform: rotate(-294.3deg)">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
        <div class="square" style="transform: rotate(327deg)">
          <div class="square-item" style="transform: rotate(-327deg);">
            <img src="../../assets/img/car.png" alt="" style="width: 35px; height: 40px;">
          </div>
        </div>
  
        <!--<img src="../../assets/img/kiss.png" alt="" class="img-kiss flipx">
            <div class="txt">
              <div class="f-3">凑齐卡牌可以抽取现金或手机</div>
              <div class="f-2">tips:没有得字母可以让好友赠送哟</div>
            </div>-->
      </div>
  
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      isShow: false,
      isTouch: false,
      mask: false
    }
  },
  methods: {
    changeTouch () {
      // alert('点击合成')
      this.isTouch = true
      this.isShow = true
      console.log('start')
      this.$refs.aniEnd.addEventListener('webkitAnimationEnd', () => {
        console.log('end')
        this.mask = true
      })
    },
    changeTouch2 () {
      this.isTouch = false
    }

  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
.demotest {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/bg3.png) no-repeat;
  background-size: cover;
  position: absolute;
  z-index: -1;
  top: 0;
}

.masklayer {
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  z-index: 4;
  position: absolute;
  top: 0;
  left: 0;
}

.popup {
  width: 5rem;
  height: 9rem;
  position: absolute;
  left: 50%;
  top: 50%;
  margin: -4.5rem 0 0 -2.5rem;
  background: url(../../assets/img/xiuxi.png) no-repeat;
  background-size: 100%;
  z-index: 5;
}


.bg-1 {
  height: 8rem;
  background: #f44031;
  margin: 1rem 10px 0 10px;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
}

.bg-top {
  width: 100%;
  background-size: 100%;
  position: relative;
  top: -12px;
}

div.div-b {
  height: 8rem;
  background: url(../../assets/img/bg4.png) no-repeat;
  background-size: 100%;
  margin: 0px 10px;
}

div.bag-header {
  text-align: center;
  margin: 2rem 0 0 .5rem;
  font-weight: bold;
}

div.bag-content {
  margin: 2rem 0 0 .5rem;
  text-align: center;
  color: white;
  line-height: .5rem;
}

.circle {

  position: relative;
  width: 100%;
  margin-top: 1rem;
  top: -6.4rem;
}

.show {
  animation: th 1s ease-in-out; // -webkit-animation-fill-mode: both;
  // animation-fill-mode: both;
  // -webkit-animation-duration: 1s;
  // animation-duration: 1s;
  // animation-name: narrow;
  // -webkit-animation-name: narrow;
  // animation-timing-function: ease-in-out;
  // -webkit-animation-timing-function: ease-in-out;
}

@keyframes th {
  from {
    opacity: 1;
  }
  50% {
    opacity: 0;
    transform: scale3d(.15, .15, 0);
  }
  to {
    opacity: 0;
    transform: scale3d(.15, .15, 0);
  }
}

.square {
  width: .3rem;
  height: .5rem;
  position: absolute;
  left: 50%; // top: 2rem;
  // top: -8.5rem;
  top: -2rem;
  margin-left: -.25rem;
  -webkit-transform-origin: .2rem 2.4rem;
  transform-origin: .2rem 2.4rem;
}

.square-item {
  width: 25px;
  height: 25px;
}
.btn {
  width: 2.5rem;
  height: 1rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  margin: .3em 0 0 1.6rem;
  text-align: center;
  line-height: 0.6rem;
  color: white;
}

.btn-hecheng {
  width: 2.5rem;
  height: 2.5rem;
  background: url(../../assets/img/btn-hecheng1.png) no-repeat;
  background-size: 100%;
  position: absolute; // top: -7.2rem;
  top: 3.2rem;
  left: 50%;
  margin-left: -1.15rem;
}

.btn-hecheng2 {
  width: 2.5rem;
  height: 2.5rem;
  background: url(../../assets/img/btn-hecheng2.png) no-repeat;
  background-size: 100%;
  position: absolute; // top: 3.2rem;
  // top: -7.2rem;
  top: 3.2rem;
  left: 50%;
  margin-left: -1.15rem;
}

.txt {
  margin: 0px .5rem;
  text-align: center;
  border-radius: 5px;
  padding: 5px 0px;
  margin-top: -1rem;
  background: #f44031;
  border: 1px solid black;
}

.img-xiuxi {
  width: 100%;
  height: 100%;
  background-size: 100%;
}

.img-kiss {
  width: 1.5rem;
  background-size: 100%;
  position: absolute;
  top: 7rem;
  left: 1.2rem;
}

.flipx {
  transform: rotateY(180deg);
}

.f-1 {
  font-size: .3rem;
}

.f-2 {
  font-size: .2rem;
}

.f-3 {
  font-size: .25rem;
}

.f-4 {
  font-size: .6rem;
}

.color-1 {
  color: #f44031;
}
</style>
