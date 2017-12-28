<template>
  <div class="oppoSuccess">
    <div class="bg-1">
      <img src="../../assets/img/bg-top3.png" alt="" class="bg-top">
      <div class="div-b">
        <div class="frame-box">
          <img src="../../assets/img/redbag3.png" class="img-header" alt="" @click="clickimg">
          <img src="../../assets/img/start.png" class="img-start" alt="">
        </div>
        <!--<span class="my">我的</span>-->
        <!-- 奖金金额 -->
        <div class="title">
          <img src="../../assets/img/money-title.png" style="width: 100%;" alt="">
        </div>
        <div>
          <span class="money">+￥2</span>
        </div>
        <div class="div-2">
          <div class="jiaobiao">当月奖池</div>
          <!--<img src="../../assets/img/check.png" alt="" class="badge" @click="clickDangyuejiangjin">-->
  
          <div class="qian">
            <span class="txt">{{dayBonus}}</span>
          </div>
          <div class="time">
            <span class="f-10">每日22:30 抽奖</span>
          </div>
        </div>
        <div class="txt">
          <span class="f-15" style="font-weight:bold">串码录入成功!</span>
          <div class="f-12">感谢你的付出，为奖池增加了2元</div>
        </div>
        <!--<div class="flex">
              <div class="div-1">
                <div class="jiaobiao">本周奖金</div>
                <img src="../../assets/img/check.png" alt="" class="badge2" @click="clickBenzhoujiangjin">
                <img src="../../assets/img/redbag.png" class="img" alt="">
                <div class="txt">
                  <div class="f-15">￥200,000</div>
                  <div class="f-10">[每周瓜分2万奖金]</div>
                </div>
              </div>
              <div class="div-1">
                <div class="jiaobiao">每月抽奖</div>
                <img src="../../assets/img/check.png" alt="" class="badge2" @click="clickMeiyuechoujiang">
                <img src="../../assets/img/redbag2.png" class="img" alt="">
                <div class="txt ">
                  <div class="f-15">OPPO卡牌</div>
                  <div class="f-10">[每月抽取豪礼]</div>
                </div>
              </div>
            </div>-->
        <img src="../../assets/img/xianmu.png" class="img-xianmu" alt="">
        <div class="btn" @click="back">
          <span>返回</span>
        </div>
  
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      dayBonus: ''
    }
  },
  mounted () {
    this.initData()
  },
  methods: {
    initData () {
      this.$http({url: '/ajaxOppoIndex', params: {}, method: 'POST'}).then((res) => {
        // 响应成功
        let result = res.data
        if (result.code === 200) {
          console.log(result)
          this.dayBonus = result.obj.bonus
        }
      }, (res) => {
        // 响应失败
        console.log('获取失败')
      })
    },
    clickimg () {
      alert('你点击了头像')
    },
    clickDangyuejiangjin () {
      alert('点击查看当月奖池明细')
    },
    clickBenzhoujiangjin () {
      alert('查看周抽奖活动规则')
    },
    clickMeiyuechoujiang () {
      alert('查看每月抽奖活动规则')
    },
    back () {
      this.$router.go(-1)
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
.oppoSuccess {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/bg3.png) no-repeat;
  background-size: cover;
  position: absolute;
  z-index: -1;
}

.bg-1 {
  height: 8rem;
  background: #feea7b;
  margin: 1rem 10px 0 10px;
  border-radius: 5px;
}

.bg-top {
  width: 100%;
  background-size: 100%;
  position: relative;
  top: -14px;
}

.top {
  height: 20px;
  margin: 0 10px;
  background: #F9E79F;
}

.div-b {
  margin: -.3rem 10px 0 10px;
  height: 8.3rem;
  border: 1px solid red;
  border-radius: 5px;
  background: #E74C3C;
  z-index: -1;
}

.frame-box {
  border-radius: 50%;
  position: relative;
  top: -.65rem;
  left: 50%;
  background: #E74C3C;
  width: 1.2rem;
  height: 1.2rem;
  margin-left: -.6rem;
}

.img-header {
  position: relative;
  top: .1rem;
  left: 50%;
  width: .8rem;
  height: .8rem;
  margin-left: -0.4rem;
  background-size: 100%;
}

.img-start {
  width: .7rem;
  height: .7rem;
  position: relative;
  top: -1.28rem;
  left: 1.1rem;
  background-size: 100%;
}

.img-xianmu {
  width: 2.2rem;
  height: 2.2rem;
  background-size: 100%;
  position: absolute;
  top: 7rem;
  left: 50%;
  margin-left: -1.1rem;
}

span.my {
  font-size: .25rem;
  color: white;
  position: absolute;
  top: 2.7rem;
  left: 3.7rem;
}

span.txt {
  position: relative;
  top: -.2rem;
  font-size: 1rem;
  letter-spacing: .38rem;
  text-indent: .73rem;
  color: #1d8348;
  display: inline-block;
}

.flex {
  display: flex;
  flex-direction: row;
  margin: 1px 3px;
  position: relative;
  top: -40px;
}

.div-2 {
  margin: 1px 10px;
  height: 2.5rem;
  border-radius: 5px;
  overflow: hidden;
  background: #1D8348;
  position: relative;
  top: -1.5rem;
}

.div-1 {
  display: inline-block;
  margin: 1px;
  height: 2rem;
  width: 50%;
  float: left;
  border-radius: 5px;
  overflow: hidden;
  background: #82E0AA;
  position: relative;
}

.jiaobiao {
  margin: 30px;
  width: 100px;
  height: 15px;
  background-color: yellow;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
  position: relative;
  top: -17px;
  left: -58px;
  text-align: center;
  font-size: 10px;
}

.qian {
  height: 1.3rem;
  background: url(../../assets/img/qian.png) no-repeat;
  background-size: 100%;
  position: relative;
  top: -.7rem;
  left: 0px;
  margin: 0px .5rem;
}

div.title {
  width: 120px;
  background-size: 100%;
  position: relative;
  top: -.7rem;
  z-index: 1;
  left: 50%;
  margin-left: -60px;
}

div.time {
  text-align: center;
  position: relative;
  top: -.7rem;
  color: white;
}

div.txt {
  text-align: center;
  margin-top: -1.3rem;
}

div.btn {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 9rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  color: white;
  padding-top: .1rem;
}

span.money {
  font-size: 20px;
  color: #feea7b;
  position: relative;
  left: 4.5rem;
  top: -1.45rem;
}

.badge {
  width: .4rem;
  height: .4rem;
  position: absolute;
  top: .15rem;
  right: .15rem;
}

.badge2 {
  width: 20px;
  height: 20px;
  position: absolute;
  top: 4px;
  right: 4px;
}

.img {
  width: .65rem;
  height: 1rem;
  position: relative;
  top: -.6rem;
  left: .15rem;
}

.f-10 {
  font-size: .1rem;
}

.f-12 {
  font-size: .2rem;
}

.f-15 {
  font-size: .35rem;
}
</style>
