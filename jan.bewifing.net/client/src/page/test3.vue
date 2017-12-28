<template>
  <div class="region">
    <div class="head"><img src="../assets/img/1.png" class="head-img"></div>
    <div class="region-box">
      <div class="region-item" @click="gotoRegionList">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">南宁青秀赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">南宁西乡塘赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">玉林赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">崇左赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">贺州赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">河池赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">百色赛区</span>
      </div>
      <div class="region-item">
        <img src="../assets/img/8.png" class="region-item-bg">
        <span class="item-text">网络赛区</span>
      </div>
      <div class="content-box-body-title">
        <div class="line" style="border-bottom: 1px solid white;"></div>
        <div class="content-box-body-title-text line-text" style="">主办方</div>
      </div>
      <div class="qrcode clearfix">
        <div class="qrcode-item">
          <img src="../assets/img/qrcode4.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">下载小象嗨TV</div>
            <div class="fs-015">手机直播看电视</div>
          </div>
        </div>
        <div class="qrcode-item">
          <img src="../assets/img/qrcode2.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">关注广西广电网络</div>
            <div class="fs-015">每天投1票</div>
          </div>
        </div>
        <div class="qrcode-item">
          <img src="../assets/img/qrcode1.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">关注超级点子王</div>
            <div class="fs-015">每天投1票</div>
          </div>
        </div>
        <div class="qrcode-item">
          <img src="../assets/img/qrcode3.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">关注社区大明星</div>
            <div class="fs-015">了解更多比赛信息</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
    }
  },
  methods: {
    gotoRegionList () {
      return this.$router.push('/test4')
    }
  }
}
</script>
<style scoped>
.region {
  padding-bottom: 1rem;
  width:100%;
  height:100%;
  position: relative;
  top: 0;
  left: 0;
  background: -moz-linear-gradient(top, #558cc5, #63346a, #2c293c); /* 想要多少种颜色，在后面加上就可以了*/
  background: -o-linear-gradient(top, #558cc5, #63346a, #2c293c);
  background: -webkit-linear-gradient(top, #558cc5, #63346a, #2c293c);
}
.head {
  width: 100%;
}
.head-img {
  width: 100%;
  height: 100%;
}
.region-box {
  padding: .2rem;
}
.region-item {
  margin: .12rem 1rem;
  position: relative;
}
.region-item-bg {
  width: 100%;
}
.item-text {
  display: block;
  position: absolute;
  top: .25rem;
  left: 50%;
  margin-left: -1rem;
  color: #808080;
  font-size: .26rem;
}
.item-text::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../assets/img/9.png') no-repeat;
  background-size: 80%;
  position: relative;
  top: .02rem;
  left: -.1rem;
}
.content-box-body-title {
  height: .6rem;
  position: relative;
  line-height: .6rem;
  font-size: .26rem;
}
.content-box-body-title-text {
  width: 1.8rem;
  text-align: center;
  position: absolute;
  top: 0;
  left: 50%;
  margin-left: -.9rem;
  z-index: 5;
  background: white;
  color: #f11728;
  font-weight: bolder;
}
.line {
  width: 100%;
  border-bottom: 1px solid #e43b47;
  padding-top: .3rem;
  z-index: 0;
}
.qrcode-img {
  width: 1rem;
  height: 1rem;
}
.qrcode-text {
  color: white;
  text-align: center;
}
.qrcode {
  width: 100%;
  padding: .15rem 0;
}
.qrcode-item {
  width: 1.5rem;
  float: left;
  text-align: center;
}
.line-text {
  background: #362b44;
  width: 1.4rem;
  color: white;
}
.fs-02 { font-size: .2rem; }
.fs-016 { font-size: .16rem; }
.fs-015 { font-size: .15rem; }
.fw { font-weight: bolder; }
.c-red { color: #e43b47; }
</style>
