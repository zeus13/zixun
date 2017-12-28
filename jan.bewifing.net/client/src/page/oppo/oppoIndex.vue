<template>
  <div class="oppoIndex">
    <div class="masklayer" v-if="ok"></div>
    <transition name="custom-classes-transition" enter-active-class="animated tada" leave-active-class="animated bounceOutRight">
      <!--<div>-->
      <div class="div-vip" v-if="ok">
        <img src="../../assets/img/bg-top2.png" class="bg-top2" alt="">
        <div class="div-vip-item">
          <div class="frame-box color-w position-t">
            <div class="frame-box color-r position-2">
              <img src="../../assets/img/file.png" class="img-file" alt="">
            </div>
          </div>
          <div class="div-input">
             <img src="../../assets/img/close.png" alt="" class="img-close" @click="isClose"> 
            <input type="text" class="input" v-model.trim="chuanma" maxlength="11">
            <div class="input-txt" v-if="tip">
              <div>该串码有误或已被其他业务员使用。</div>
              <div>如有疑问，请点击
                <router-link to="/oppoAppeal" class="shenshu">申诉</router-link>
              </div>
            </div>
          </div>
          <div class="btn btn-luru" @click="luru">录入</div>
        </div>
      </div>
      <!--</div>-->
    </transition>
  
    <div>
      <div class="bg-1">
        <img src="../../assets/img/bg-top3.png" alt="" class="bg-top">
        <div class="div-b">
          <div class="frame-box">
            <img src="../../assets/img/header.png" class="img-header" alt="" @click="clickimg">
            <img src="../../assets/img/start.png" class="img-start" alt="">
            <!--<span class="my">我的</span>-->
          </div>
          <span class="my">我的</span>
          <!-- 奖金金额 -->
          <div class="title">
            <img src="../../assets/img/money-title.png" style="width: 100%;" alt="">
          </div>
          <div class="div-2">
            <div class="jiaobiao">当日奖池</div>
            <img src="../../assets/img/check.png" alt="" class="badge" @click="clickDangyuejiangjin">
            <div class="qian">
              <span class="txt">{{dayBonus}}</span>
            </div>
            <div class="time">
              <span class="f-10">每日22:30 抽奖</span>
            </div>
          </div>
          <div class="flex">
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
          </div>
  
          <div class="btn" @click="ok = !ok">
            <span>扫描串码</span>
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
      ok: false,
      chuanma: '',
      tip: false,
      isClick: false,
      dayBonus: ''
    }
  },
  mounted () {
    this.initData()
  },
  methods: {
    initData () {
      this.$http({url: '/ajaxOppoIndex', params: {}, method: 'POST'}).then((response) => {
        // 响应成功
        var result = response.data
        if (result.code === 200) {
          console.log('result:' + result)
          this.dayBonus = this.formate(result.obj.bonus)
        }
      }, (response) => {
        // 响应失败
        console.log('没有获取到')
      })
    },
    formate (bonus) {
      if (bonus === 0 || bonus < 10) {
        return '000' + bonus
      } else if (bonus >= 10 && bonus < 100) {
        return '00' + bonus
      } else if (bonus >= 100 && bonus < 1000) {
        return '0' + bonus
      } else if (bonus >= 1000 && bonus <= 9999) {
        return bonus
      }
    },
    luru () {
      console.log('点击录入')
      this.isClick = true
      if (this.chuanma === '') {
        alert('乖，别闹！请输入串码')
      } else {
        this.$http({ url: '/ajaxOppoInput', params: { tel: this.tel, chuanma: this.chuanma }, method: 'POST' }).then(function (response) {
          // 响应成功回调
          let result = response.data
          if (result.code === 200) {
            // alert('恭喜你，你录入的串码没有被人使用过，已成功录入')
            this.$router.push('/oppoSuccess')
          } else if (result.code === 501) {
            // alert('很遗憾的告诉你，你录入的串码已被录入过了')
            this.tip = true
          } else if (result.code === 500) {
            alert('你还没有登陆呢，请先登陆')
            this.$router.go(-1)
          }
        }, function (response) {
          // 响应失败回调
        })
      }
    },
    isClose () {
      this.ok = false
    },
    clickimg () {
      // alert('你点击了头像')
      this.$router.push('/oppoDayList')
    },
    clickDangyuejiangjin () {
      alert('点击查看当月奖池明细')
    },
    clickBenzhoujiangjin () {
      alert('查看周抽奖活动规则')
    },
    clickMeiyuechoujiang () {
      alert('查看每月抽奖活动规则')
    }
    // clickbtn (event) {
    //   console.log('点击扫描串码')
    //   console.log(event)
    //   this.noOk = !this.noOk
    //   this.ok = !this.ok
    // },
    // 初始化时获取基本数据
    // async initData () {
    //   await this.$http({ url: '/ajaxOppoIndex', params: {}, method: 'POST' }).then(function (response) {
    //     let result = response.data
    //     console.log(result)
    //   }, function (response) {
    //     console.log(response)
    //   })
    // }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
* {
  	margin: auto;
	max-width: 640px;
}
.oppoIndex {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/bg3.png) no-repeat;
  background-size: cover;
  position: absolute;
  z-index: -1;
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

.shenshu {
  font-size: .3rem;
  text-decoration: none;
}

.div-input {
  height: .7rem;
  margin: -.5rem .2rem;
  border: 1px solid red;
  border-radius: 5px;
}

.input {
  margin: 0rem 0.2rem;
  height: .7rem;
  width: 3.7rem;
  border: none;
  outline: none;
}

.bg-1 {
  height: 7.5rem;
  background: #feea7b;
  margin: 1rem 10px 0 10px;
  border-radius: 5px;
}

.bg-top {
  width: 100%;
  background-size: 100%;
  position: relative;
  top: -.2rem;
}

.bg-top2 {
  width: 100%;
  background-size: 100%;
  position: relative;
  top: -.2rem;
}

.top {
  height: 20px;
  margin: 0 10px;
  background: #F9E79F;
}

.div-b {
  margin: 1rem 10px 0 10px;
  height: 6.5rem;
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
  width: 1rem;
  height: 1rem;
  margin-left: -.5rem;
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

.img-file {
  width: 25px;
  height: 25px;
  position: relative;
  top: .11rem;
  left: 50%;
  margin-left: -12.5px;
}

.img-close {
  width: 0.4rem;
  height: .4rem;
  position: absolute;
  top: .4rem;
  left: 4.6rem;
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
  letter-spacing: .36rem;
  text-indent: .78rem;
  color: #1d8348;
  display: inline-block;
}

.flex {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row;
  margin: 2.5px 7.5px;
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
  top: -40px;
}

.div-1 {
  display: inline-block;
  margin: 0px 2.5px;
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
  top: -22px;
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
  width: 2rem;
  position: relative;
  top: -1.9rem;
  left: .3rem;
  text-align: center;
}

div.input-txt {
  text-align: center;
  font-size: .2rem;
  margin-top: .2rem;
  line-height: .4rem;
}

div.btn {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: relative;
  top: -.3rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  padding-top: .1rem;
  color: white;
}

div.btn:active {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: relative;
  top: -.3rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn_s.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  padding-top: .1rem;
  color: white;
}

div>.link {
  color: white;
  text-decoration: none;
}

div.btn-luru {
  width: 3.5rem;
  margin-left: -1.75rem;
  position: relative;
  top: 1.5rem;
}

div.btn-luru:active {
  width: 3.5rem;
  margin-left: -1.75rem;
  position: relative;
  top: 1.5rem;
}

div.div-vip {
  width: 5rem;
  height: 4rem;
  background: red;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -2.5rem;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  z-index: 5;
}

div.div-vip-item {
  height: 100%;
  background: white;
  margin-top: 1rem;
  margin: .25rem 10px;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
}

div.color-w {
  background: white;
}

div.color-r {
  background: red;
}

div.position-t {
  top: -.5rem;
}

div.position-2 {
  width: 40px;
  height: 40px;
  top: .1rem;
  left: 50%;
  margin-left: -20px;
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
  font-size: .2rem;
}

.f-15 {
  font-size: .35rem;
}
</style>
