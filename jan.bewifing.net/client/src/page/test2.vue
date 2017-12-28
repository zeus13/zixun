<template>
  <div class="index">
    <div class="head"><img src="../assets/img/1.png" class="head-img"></div>
    <div class="video-box">
      <div class="video-box-item">
        <iframe id="iframe" frameborder="0" width="100%" height="200" src="http://v.qq.com/iframe/player.html?vid=t0199bai25n&tiny=0&auto=0" allowfullscreen></iframe>
<!--         <img src="../assets/img/3.png" class="video-box-img">
        <div class="play"></div> -->
      </div>
      <div class="btn-vote" @click="gotoRegion">我要投票</div>
    </div>
    <div class="content-box">
      <div class="content-box-title">
        <p>广西广电网络</p>
        <p>2017第三季舞动广西全民广场舞大赛</p>
      </div>
      <div class="content-box-body">
        <div class="content-box-body-item">
          <div class="content-box-body-title">
            <div class="line"></div>
            <div class="content-box-body-title-text">【比赛介绍】</div>
          </div>
          <div class="text">
            <p>“广西广电网络2017第三季舞动广西全民广场舞大赛 ”由广西广电网络公司、广西电视台、广西群众艺术馆共同主办，由广西电视台都市频道承办。</p>
            <br>
            <p>大赛于12月全新启动，举办7场城市海选赛、1场网络海选，即在小象互动平台设置“全民广场舞”网络海选专区，与7大城市海选同时进行，只要录制一个视频就可参赛，让更多的文艺爱好者通过网络参与比赛。2018年元月举办2场晋级赛、1场总决赛暨颁奖晚会。本次活动旨在通过广场舞这项展现全民健身正能量的运动，为大家传递时尚健康生活的理念。</p>
          </div>
        </div>
        <div class="content-box-body-item">
          <div class="content-box-body-title">
            <div class="line"></div>
            <div class="content-box-body-title-text">【赛制说明】</div>
          </div>
          <div class="text">
            <p>本次大赛分为三个阶段</p>
            <p style="font-weight: bolder;">1、全区海选：城市海选+网络海选，将产生全区48强</p>
            <p class="fs-02">（晋级方式：评委打分产生21人，全民投票产生27人）</p>
            <p style="font-weight: bolder;">2、全区晋级赛：将产生全区16强</p>
            <p class="fs-02">（晋级方式：评委打分占70%，全民投票占30%）</p>
            <p style="font-weight: bolder;">3、全区总决赛：16强巅峰对决</p>
            <br>
            <p style="font-weight: bolder;">所有赛事现场精彩视频，届时都将在广西广电网络小象互动“全民广场舞”专区中呈现。</p>
          </div>
        </div>
        <div class="content-box-body-item">
          <div class="content-box-body-title">
            <div class="line"></div>
            <div class="content-box-body-title-text">【投票规则】</div>
          </div>
          <div class="text">
            <p>在本次活动中，有小象互动电视端（10票）、广西广电网络微信公众号（1票）、超级点子王微信公众号（1票）三个投票渠道。</p>
            <div class="table" style="font-size: .2rem;">
              <div class="table-item" style="border-bottom: 1px solid #f96b0d;">
                <div class="table-item-left">电视端</div>
                <div class="table-item-mid">小象互动用户</div>
                <div class="table-item-right">10票/天</div>
              </div>
              <div class="table-item">
                <div class="table-item-left"><span class="table-item-text">移动端</span></div>
                <div class="table-item-mid">
                  <div style="border-bottom: 1px solid #f96b0d; width: 100%;">关注广西广电网络公众号用户</div>
                  <div>关注超级点子王公众号用户</div>
                </div>
                <div class="table-item-right">
                  <div style="border-bottom: 1px solid #f96b0d; width: 100%;">1票/天</div>
                  <div>1票/天</div>
                </div>
              </div>
            </div>
            <p>须知：投票活动是一项严肃的评选活动，投票将恪守公开、公平、公正的原则，我们的投票系统具有防刷票功能，请各位参赛者放心。禁止任何人采用程序刷票等作弊行为，投票以官网后台真实数据为准，恶意刷票数据将无效。如经证实发现参选者存在恶意刷票行为，主办方有取消参赛者参赛资格的权利。</p>
          </div>
        </div>
        <div class="row-time">
          投票截止时间：2018年1月15日00:00:00
        </div>
        <div style="padding: .2rem .2rem;">
          <p class="c-red fw">·城市海选投票评选：</p>
          <p>7场城市海选，除现场3组晋级者外，另有线上投票每场票数前3组进入晋级赛。</p>
          <br>
          <p class="c-red fw">·网络海选投票评选：</p>
          <p>不能参加城市海选的参赛者们可自己录制广场舞视频，并就近到当地广电网络营业厅交由工作人员将视频上载至小象互动专区，即可加入网络海选赛进行投票。票数前6组进入晋级赛。</p>
          <br>
          <p>【城市海选上线时间】每场比赛第二天凌晨00:00:00</p>
          <p>【网络赛区上线时间】按照广电收集交付时间</p>
        </div>
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
    gotoRegion () {
      return this.$router.push('/test3')
    }
  }
}
</script>

<style scoped>
.index {
  padding-bottom: 1rem;
  width:100%;
  height:100%;
  background: -moz-linear-gradient(top, #558cc5, #63346a, #2c293c); /* 想要多少种颜色，在后面加上就可以了*/
  background: -o-linear-gradient(top, #558cc5, #63346a, #2c293c);
  background: -webkit-linear-gradient(top, #558cc5, #63346a, #2c293c);
}
body {
  margin: 0;
  padding: 0;
}
.row-time {
  margin-top: .15rem;
  padding: .1rem .2rem;
  color: #e43b47;
  border-top: 1px solid #e43b47;
  border-bottom: 1px solid #e43b47;
  font-weight: bolder;
  margin-bottom: .1rem;
}
.table-item-text {
  display: block;
  margin-top: .25rem;
}
.table-item {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  line-height: .5rem;
}
.table-item-left {
  width: 20%;
}
.table-item-right {
  width: 20%;
  text-align: center;
}
.table-item-mid {
  width: 60%;
  border-left: 1px solid #f96b0d;
  border-right: 1px solid #f96b0d;
}

.table {
  width: 100%;
  border: 1px solid #f96b0d;
  text-align: center;
  border-radius: 5px;
  margin: .15rem 0;
}
.text {
  padding: 0 .2rem;
}

.head {
  width: 100%;
}
.head-img {
  width: 100%;
  height: 100%;
}
.video-box {
  margin: .2rem;
  padding: .2rem;
  background: white;
  border-radius: 5px;
}
.video-box-item {
  padding: .1rem;
  position: relative;
  top: 0;
  left: 0;
}
.video-box-img {
  width: 100%;
}
.play {
  width: 1rem;
  height: 1rem;
  background: url('../assets/img/2.png');
  background-size: 100%;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -.5rem;
  margin-top: -.5rem;
}
.btn-vote {
  text-align: center;
  margin: .2rem 1.5rem;
  padding: .15rem;
  border-radius: .5rem;
  color: white;
  font-size: .28rem;
  background: -moz-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -o-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -webkit-linear-gradient(left, #e72627, #f65a10, #fd8201);
}
.btn-vote::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../assets/img/4.png');
  background-size: 100%;
  position: relative;
  top: .02rem;
  margin-right: .1rem;
}
.content-box {
  margin: .1rem;
  padding: .1rem;
  border-radius: 10px;
}
.content-box-title {
  text-align: center;
  padding: .12rem;
  line-height: .5rem;
  color: white;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  font-weight: bolder;
  font-size: .28rem;
  background: -moz-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -o-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -webkit-linear-gradient(left, #e72627, #f65a10, #fd8201);
}
.content-box-body {
  background: white;
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
