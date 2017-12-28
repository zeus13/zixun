<template>
  <section class="popup">


<!--     <div id="popup2" class="popup-loading" style="display:none">
      <div class="popup-loading-shade pls-black"></div>
      <div class="popup-loading-main">
        <div class="popup-loading-section">
          <div class="popup-loading-cont2">
            <i></i><i class="popup-loading-icon2"></i><i></i>
            <p>正在提交数据</p>
          </div>
        </div>
      </div>
    </div> -->

    <div id="popup1" class="popup-loading" v-show="type === 'load'">
      <div class="popup-loading-shade pls-white"></div>
      <div class="popup-loading-main">
        <div class="popup-loading-section">
          <div class="popup-loading-cont1">
            <i class="popup-loading-icon1"></i>
            <p>正在提交数据</p>
          </div>
        </div>
      </div>
    </div>

    <div id="popup-msg" v-show="type === 'msg'">
      <div class="popup-msg-cont">
        <div class="popup-msg-text">{{msg}}</div>
      </div>
    </div>

    <div id="popup3" class="popup-loading" v-show="type === 'alert'">
      <div class="popup-loading-shade pls-black"></div>
      <div class="popupAuto">
        <div class="popup-main popup-anim">
          <div class="popup-top-line"></div>
          <div class="popup-cont">
            <img :src="'http://fanglucdn.bewifing.net/popupFace'+icon+'.png'" class="popup-face">
            <p>{{msg}}</p>
          </div>
          <div class="popup-btn" @click="closePopupFun()"><i class="icons icon-tick"></i> 我知道了</div>
        </div>
      </div>
    </div>

  </section>
</template>

<script>
export default {
  props: ['type', 'msg', 'icon'],
  data () {
    return {
    }
  },
  methods: {
    closePopupFun () {
      this.$emit('closePopupFun')
    }
  }
}
</script>

<style lang="less" scoped>
#popup-msg {
  position:fixed;
  width:100%;
  height:100%;
  top:0;
  left:0;
  pointer-events:none;
  display:table;
}
.popup-msg-cont {
  display:table-cell;
  vertical-align:middle;
  text-align:center;
}
.popup-msg-text {
  border:none;
  background-color:rgba(0,0,0,.6);
  color:#fff;
  display:inline-block;
  min-width:100px;
  font-size:14px;
  border-radius:3px;
  box-shadow:0 0 8px rgba(0,0,0,.1);
  -webkit-animation-fill-mode:both;
  animation-fill-mode:both;
  -webkit-animation-duration:.18s;
  animation-duration:.18s;
  animation-name:popup-anim;
  -webkit-animation-name:popup-anim;
  z-index:19940303;
  padding:12px 25px;
  line-height:24px;
  text-align:center;
  margin:0 auto;
}
@-webkit-keyframes popup-anim {
  0% {
  opacity:0;
  -webkit-transform:scale(.5);
  transform:scale(.5)
}
100% {
  opacity:1;
  -webkit-transform:scale(1);
  transform:scale(1)
}
}@keyframes popup-anim {
  0% {
  opacity:0;
  -webkit-transform:scale(.5);
  -ms-transform:scale(.5);
  transform:scale(.5)
}
100% {
  opacity:1;
  -webkit-transform:scale(1);
  -ms-transform:scale(1);
  transform:scale(1)
}
}.popup-loading {
  position:relative;
  z-index:19940303;
}
.popup-loading-main,.popup-loading-shade {
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
  pointer-events:auto;
}
.pls-white {
  background-color:rgba(0,0,0,0);
  pointer-events:auto;
}
.pls-black {
  background-color:rgba(0,0,0,0.7);
  pointer-events:auto;
}
.popup-loading-main {
  display:table;
  font-family:Helvetica,arial,sans-serif;
  pointer-events:none
}
.popup-loading-section {
  display:table-cell;
  vertical-align:middle;
  text-align:center
}
.popup-loading-cont1 {
  width:1.8rem;
  height:1.8rem;
  margin:0 auto;
  background:rgba(17,17,17,0.7);
  text-align:center;
  border-radius:.1rem;
  color:#FFFFFF;
}
.popup-loading-icon1 {
  margin:.4rem 0 0;
  width:.6rem;
  height:.6rem;
  vertical-align:baseline;
  display:inline-block;
  -webkit-animation:loadingAniOne 1s steps(12,end) infinite;
  animation:loadingAniOne 1s steps(12,end) infinite;
  background:transparent url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZmlsbD0ibm9uZSIgZD0iTTAgMGgxMDB2MTAwSDB6Ii8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjRTlFOUU5IiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTMwKSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iIzk4OTY5NyIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSgzMCAxMDUuOTggNjUpIi8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjOUI5OTlBIiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0icm90YXRlKDYwIDc1Ljk4IDY1KSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iI0EzQTFBMiIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSg5MCA2NSA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNBQkE5QUEiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoMTIwIDU4LjY2IDY1KSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iI0IyQjJCMiIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSgxNTAgNTQuMDIgNjUpIi8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjQkFCOEI5IiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0icm90YXRlKDE4MCA1MCA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNDMkMwQzEiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoLTE1MCA0NS45OCA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNDQkNCQ0IiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoLTEyMCA0MS4zNCA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNEMkQyRDIiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoLTkwIDM1IDY1KSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iI0RBREFEQSIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSgtNjAgMjQuMDIgNjUpIi8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjRTJFMkUyIiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0icm90YXRlKC0zMCAtNS45OCA2NSkiLz48L3N2Zz4=) no-repeat;
  background-size:100%;
}
@-webkit-keyframes loadingAniOne {
  0% {
  -webkit-transform:rotate3d(0,0,1,0deg);
  transform:rotate3d(0,0,1,0deg);
}
100% {
  -webkit-transform:rotate3d(0,0,1,360deg);
  transform:rotate3d(0,0,1,360deg);
}
}@keyframes loadingAniOne {
  0% {
  -webkit-transform:rotate3d(0,0,1,0deg);
  transform:rotate3d(0,0,1,0deg);
}
100% {
  -webkit-transform:rotate3d(0,0,1,360deg);
  transform:rotate3d(0,0,1,360deg);
}
}.popup-loading-cont1 p {
  line-height:1.6;
  font-size:.24rem;
  margin:0;
}
.popup-loading-child {
  position:relative;
  display:inline-block;
  text-align:left;
  background-color:#fff;
  font-size:14px;
  border-radius:5px;
  box-shadow:0 0 8px rgba(0,0,0,.1);
  pointer-events:auto;
  -webkit-overflow-scrolling:touch;
  -webkit-animation-fill-mode:both;
  animation-fill-mode:both;
  -webkit-animation-duration:.2s;
  animation-duration:.2s
}
@-webkit-keyframes popup-loading-anim-scale {
  0% {
  opacity:0;
  -webkit-transform:scale(.5);
  transform:scale(.5)
}
100% {
  opacity:1;
  -webkit-transform:scale(1);
  transform:scale(1)
}
}@keyframes popup-loading-anim-scale {
  0% {
  opacity:0;
  -webkit-transform:scale(.5);
  transform:scale(.5)
}
100% {
  opacity:1;
  -webkit-transform:scale(1);
  transform:scale(1)
}
}.popup-loading-anim-scale {
  animation-name:popup-loading-anim-scale;
  -webkit-animation-name:popup-loading-anim-scale
}
.popup-loading-cont2 {
  width:100%;
  border:none;
  background:0 0;
  box-shadow:none;
  color:#fff;
  text-align:center;
  padding:0;
  line-height:0;
  font-size:14px;
}
.popup-loading-cont2 i {
  width:25px;
  height:25px;
  margin-left:8px;
  display:inline-block;
  background-color:#fff;
  border-radius:100%;
  -webkit-animation:loadingAniZero 1.4s infinite ease-in-out;
  animation:loadingAniZero 1.4s infinite ease-in-out;
  -webkit-animation-fill-mode:both;
  animation-fill-mode:both
}
.popup-loading-cont2 p {
  margin-top:20px
}
@-webkit-keyframes loadingAniZero {
  0%,100%,80% {
  transform:scale(0);
  -webkit-transform:scale(0)
}
40% {
  transform:scale(1);
  -webkit-transform:scale(1)
}
}@keyframes loadingAniZero {
  0%,100%,80% {
  transform:scale(0);
  -webkit-transform:scale(0)
}
40% {
  transform:scale(1);
  -webkit-transform:scale(1)
}
}.popup-loading-cont2 i:first-child {
  margin-left:0;
  -webkit-animation-delay:-.32s;
  animation-delay:-.32s
}
.popup-loading-cont2 i.popup-loading-icon2 {
  -webkit-animation-delay:-.16s;
  animation-delay:-.16s
}

/* 弹窗动画 */
@-webkit-keyframes bounceIn {
    0% {
        opacity:0;
        -webkit-transform:scale(.5);
    }
    100% {
        opacity:1;
        -webkit-transform:scale(1);
    }
}
@keyframes bounceIn {
    0% {
        opacity:0;
        transform:scale(.5)
    }
    100% {
        opacity:1;
        transform:scale(1)
    }
}
.popup-anim {
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-duration: .18s;
    animation-duration: .18s;
    animation-name: bounceIn;
    -webkit-animation-name: bounceIn;
}
.popupAuto{
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content: center;
  -webkit-justify-content: center;
  align-items: center;
  -webkit-align-items: center;
}
.popup-top-line{
  background: #445194;
  height: .15rem;
}
.popup-main{
  width: 4.6rem;
  background: #fff;
  position: relative;
  z-index: 999;
  border-radius: .1rem;
  overflow: hidden;
}
.popup-cont{
  padding: .5rem .3rem .2rem;
  display: -webkit-flex; /* Safari */
  display: flex;
  align-items: center;
}
.popup-face{
  width: .8rem;
  margin-right: .1rem;
}
.popup-cont p{
  color: #979797;
  text-align: justify;
}
.popup-btn{
  width: 2rem;
  border-radius: .1rem;
  background: #445194;
  color: #fff;
  text-align: center;
  line-height: .3rem;
  font-size: .28rem;
  padding: .15rem 0;
  margin: .2rem auto;
  position: relative;
}
.popup-btn:after{
  content: "";
  width: 4.4rem;
  border-bottom: 1px solid #d9d9d9;
  -webkit-transform-origin: 0 100%;
  transform-origin: 0 100%;
  position: absolute;
  top: -.2rem;
  left: -1rem;
  -webkit-transform: scaleY(.5);
  transform: scaleY(.5);
}
</style>
