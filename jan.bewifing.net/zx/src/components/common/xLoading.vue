<template>
  <section class="xLoading">
    <div class="loader">
<!--       <div class="loader-inner pacman">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div> -->
      <div class="loader-inner line-scale-pulse-out">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
}
</script>
<style lang="less">
.xLoading{
  width: 100%;
  height: 100%;
  background: #fff;
  position: fixed;
  top: 0;
  left: 0;
}
.loader {
  box-sizing: border-box;
  width: 100%;
  position: absolute;
  top: 50%;
  margin-top: -30px;
  text-align: center;
}
.loader-inner {
  display: inline-block;
}

/**
 * 动画一
 */
.pacman {
  position: relative;
}
.pacman > div:nth-child(2) {
  -webkit-animation: pacman-balls 1s 0s infinite linear;
          animation: pacman-balls 1s 0s infinite linear; 
}
.pacman > div:nth-child(3) {
  -webkit-animation: pacman-balls 1s 0.33s infinite linear;
          animation: pacman-balls 1s 0.33s infinite linear; 
}
.pacman > div:nth-child(4) {
  -webkit-animation: pacman-balls 1s 0.66s infinite linear;
          animation: pacman-balls 1s 0.66s infinite linear; 
}
.pacman > div:nth-child(5) {
  -webkit-animation: pacman-balls 1s 0.99s infinite linear;
          animation: pacman-balls 1s 0.99s infinite linear; 
}
.pacman > div:first-of-type {
  width: 0px;
  height: 0px;
  border-right: 20px solid transparent;
  border-top: 20px solid #3c4992;
  border-left: 20px solid #3c4992;
  border-bottom: 20px solid #3c4992;
  border-radius: 20px;
  -webkit-animation: rotate_pacman_half_up 0.5s 0s infinite;
          animation: rotate_pacman_half_up 0.5s 0s infinite; 
}
.pacman > div:nth-child(2) {
  width: 0px;
  height: 0px;
  border-right: 20px solid transparent;
  border-top: 20px solid #3c4992;
  border-left: 20px solid #3c4992;
  border-bottom: 20px solid #3c4992;
  border-radius: 20px;
  -webkit-animation: rotate_pacman_half_down 0.5s 0s infinite;
          animation: rotate_pacman_half_down 0.5s 0s infinite;
  margin-top: -40px; 
}
.pacman > div:nth-child(3), .pacman > div:nth-child(4), .pacman > div:nth-child(5), .pacman > div:nth-child(6) {
  background-color: #3c4992;
  width: 15px;
  height: 15px;
  border-radius: 100%;
  margin: 2px;
  width: 10px;
  height: 10px;
  position: absolute;
  -webkit-transform: translate(0, -6.25px);
      -ms-transform: translate(0, -6.25px);
          transform: translate(0, -6.25px);
  top: 20px;
  left: 100px; 
}

@-webkit-keyframes rotate_pacman_half_up {
  0% {
    -webkit-transform: rotate(270deg);
            transform: rotate(270deg); }

  50% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg); }

  100% {
    -webkit-transform: rotate(270deg);
            transform: rotate(270deg); } 
}

@keyframes rotate_pacman_half_up {
  0% {
    -webkit-transform: rotate(270deg);
            transform: rotate(270deg); }

  50% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg); }

  100% {
    -webkit-transform: rotate(270deg);
            transform: rotate(270deg); } }

@-webkit-keyframes rotate_pacman_half_down {
  0% {
    -webkit-transform: rotate(90deg);
            transform: rotate(90deg); }

  50% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg); }

  100% {
    -webkit-transform: rotate(90deg);
            transform: rotate(90deg); } }

@keyframes rotate_pacman_half_down {
  0% {
    -webkit-transform: rotate(90deg);
            transform: rotate(90deg); }

  50% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg); }

  100% {
    -webkit-transform: rotate(90deg);
            transform: rotate(90deg); } }

@-webkit-keyframes pacman-balls {
  75% {
    opacity: 0.7; }

  100% {
    -webkit-transform: translate(-100px, -6.25px);
            transform: translate(-100px, -6.25px); } }

@keyframes pacman-balls {
  75% {
    opacity: 0.7; }

  100% {
    -webkit-transform: translate(-100px, -6.25px);
            transform: translate(-100px, -6.25px); } }



/**
 * 动画二
 */
@-webkit-keyframes line-scale {
  0% {
    -webkit-transform: scaley(1);
            transform: scaley(1); }

  50% {
    -webkit-transform: scaley(0.4);
            transform: scaley(0.4); }

  100% {
    -webkit-transform: scaley(1);
            transform: scaley(1); } }
@keyframes line-scale {
  0% {
    -webkit-transform: scaley(1);
            transform: scaley(1); }

  50% {
    -webkit-transform: scaley(0.4);
            transform: scaley(0.4); }

  100% {
    -webkit-transform: scaley(1);
            transform: scaley(1); } }

.line-scale > div:nth-child(1) {
  -webkit-animation: line-scale .6s 0.1s infinite cubic-bezier(.2, .68, .18, 1.08);
          animation: line-scale .6s 0.1s infinite cubic-bezier(.2, .68, .18, 1.08); }
.line-scale > div:nth-child(2) {
  -webkit-animation: line-scale .6s 0.2s infinite cubic-bezier(.2, .68, .18, 1.08);
          animation: line-scale .6s 0.2s infinite cubic-bezier(.2, .68, .18, 1.08); }
.line-scale > div:nth-child(3) {
  -webkit-animation: line-scale .6s 0.3s infinite cubic-bezier(.2, .68, .18, 1.08);
          animation: line-scale .6s 0.3s infinite cubic-bezier(.2, .68, .18, 1.08); }
.line-scale > div:nth-child(4) {
  -webkit-animation: line-scale .6s 0.4s infinite cubic-bezier(.2, .68, .18, 1.08);
          animation: line-scale .6s 0.4s infinite cubic-bezier(.2, .68, .18, 1.08); }
.line-scale > div:nth-child(5) {
  -webkit-animation: line-scale .6s 0.5s infinite cubic-bezier(.2, .68, .18, 1.08);
          animation: line-scale .6s 0.5s infinite cubic-bezier(.2, .68, .18, 1.08); }
.line-scale > div {
  background-color: #fff;
  width: 4px;
  height: 35px;
  border-radius: 2px;
  margin: 2px;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
  display: inline-block; }

/**
 * 动画二
 */
  @-webkit-keyframes line-scale-pulse-out {
  0% {
    -webkit-transform: scaley(1);
            transform: scaley(1); }

  50% {
    -webkit-transform: scaley(0.4);
            transform: scaley(0.4); }

  100% {
    -webkit-transform: scaley(1);
            transform: scaley(1); } }

@keyframes line-scale-pulse-out {
  0% {
    -webkit-transform: scaley(1);
            transform: scaley(1); }

  50% {
    -webkit-transform: scaley(0.4);
            transform: scaley(0.4); }

  100% {
    -webkit-transform: scaley(1);
            transform: scaley(1); } }

.line-scale-pulse-out > div {
  background-color: #3c4992;
  width: 4px;
  height: 35px;
  border-radius: 2px;
  margin: 2px;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
  display: inline-block;
  -webkit-animation: line-scale-pulse-out 0.6s 0s infinite cubic-bezier(.85, .25, .37, .85);
          animation: line-scale-pulse-out 0.6s 0s infinite cubic-bezier(.85, .25, .37, .85); }
  .line-scale-pulse-out > div:nth-child(2), .line-scale-pulse-out > div:nth-child(4) {
    -webkit-animation-delay: 0.2s !important;
            animation-delay: 0.2s !important; }
  .line-scale-pulse-out > div:nth-child(1), .line-scale-pulse-out > div:nth-child(5) {
    -webkit-animation-delay: 0.4s !important;
            animation-delay: 0.4s !important; }
</style>
