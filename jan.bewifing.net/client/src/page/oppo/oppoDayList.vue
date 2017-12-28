<template>
  <div class="oppoDayList">
    <div class="masklayer" v-if="ok"></div>

    <div class="popup" v-if="layer1">
      <img src="../../assets/img/close.png" alt="" class="img-close" @click="isClose">
      <div class="bag-header color-1">
        <div class="f-3">现金红包</div>
        <div class="f-4">￥88.88</div>
      </div>
      <div class="bag-content f-3">
        <div>由于你的超强人品，</div>
        <div>获得了<span style="font-weight: bold">现金红包88.00元</span></div>
      </div>
      <div class="tag-btn">
        <span>藏到小金库</span>
      </div>
    </div>

   <div class="popup2" v-if="layer2">
      <img src="../../assets/img/close.png" alt="" class="img-close2" @click="isClose">
      <div class="bag-header color-1">
        <div class="letter">{{letter}}</div>
      </div>
      <div class="bag-content2 f-3">
        <div>恭喜你！</div>
        <div>获得了<span style="font-weight: bold">字母卡牌</span></div>
      </div>
      <div class="tag-btn2">
        <span>藏到小金库</span>
      </div>
    </div>

       <div class="popup3" v-if="layer3">
      <img src="../../assets/img/close.png" alt="" class="img-close3" @click="isClose">
      <div class="bag-header color-1">
        <!-- <div>{{letter}}</div> -->
      </div>
      <div class="bag-content3 f-3">
        <div>你来晚了，</div>
        <div>奖金被瓜分完了！</div>
      </div>
      <div class="tag-btn3" @click="again">
        <span>再接再厉</span>
      </div>
    </div>
  
    <div class="bg-1">
      <img src="../../assets/img/bg-top3.png" alt="" class="bg-top">
      <div class="div-b">
        <div class="frame-box">
          <img src="../../assets/img/redbag3.png" class="img-header" alt="">
          <img src="../../assets/img/start.png" class="img-start" alt="">
        </div>
  
        <div class="title">
          <img src="../../assets/img/money-title-yellow.png" style="width: 100%;" alt="">
        </div>
        <div class="div-2">
          <div class="jiaobiao">当月奖池</div>
          <!--<img src="../../assets/img/check.png" alt="" class="badge" @click="clickDangyuejiangjin">-->
          <div class="qian">
            <span class="txt">{{dayBonus}}</span>
          </div>
        </div>
  
        <div class="title2">
          <img src="../../assets/img/countdown.png" style="width: 100%;" alt="">
        </div>
        <div class="div-3">
          <!--<span class="txt2">{{time}}</span>-->
          <zk-time-down @time-end="timeEnd ()" :endTime="endTime" class="txt2"></zk-time-down>
        </div>
        <!--<div class="btn">
            <span>抽奖</span>
          </div>-->
        <div :class="isBtn?btn2:btn" @click="choujiang">
          <span>抽奖</span>
        </div>
  
      </div>
      <div class="div-list">
        <div class="div-row">
          <span>我的串码</span>
          <span class="fr">0/0</span>
        </div>
        <div class="line"></div>
        <div class="condition" v-if="isNo">
          <span>你还没有录入串码，加油哦！</span>
        </div>
        <div class="condition2">
          <div class="div-row2" v-for=" (item, index) in items" v-bind:key="item.id">
            <span class="txt3">{{item.string_code}}</span>
            <span class="fr" v-if="item.state==='0'">未使用</span>
            <span class="fr" v-else-if="item.state==='1'">已使用</span>
            <div>
              <span class="f-02">录入时间:{{getStamp(item.input_time, 'ymdhms')}}</span>
            </div>
            <div class="cb"></div>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</template>
<script>
import zkTimeDown from '../../components/zkTimeDown.vue'
import { getStamp } from '@/config/utils'
export default {
  data  () {
    return {
      showLoading: true,
      isNo: true,
      items: {},
      time: '',
      endTime: '2017/07/20 17:50:00',
      isBtn: false,
      btn: 'btn',
      btn2: 'btn2',
      ok: false,
      layer1: false,
      layer2: false,
      layer3: false,
      letter: 'P',
      dayBonus: ''
    }
  },
  components: {
    zkTimeDown
  },
  created  () {
    // this.iniData ()
  },
  mounted () {
    this.iniData()
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    async iniData () {
      await this.$http({ url: '/ajaxOppoDayList', params: {}, method: 'POST' }).then((response) => {
        // 响应成功回调
        var a = response.data
        if (a.code === 200) {
          // let result = response.data
          this.items = a.obj.check
          var bonus = a.obj.bonus
          this.dayBonus = this.formate(bonus)
          console.log(bonus)
          this.isNo = false
        } else {
          alert(a.msg)
        }
      }, (response) => {
        // 响应失败回调
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
    isClose () {
      this.ok = false
      this.layer1 = false
      this.layer2 = false
      this.layer3 = false
    },
    timeEnd () {
      this.isBtn = true
      // this.$http({url: '/ajaxOppoSaveDayBonus', params: {}, method: 'POST'}).then((res) => {
      //   let result = res.data
      //   if (result === 200) {
      //     this.dayBonus = 0
      //   } else {
      //     alert('结算失败')
      //   }
      // }, (res) => {

      // })
    },
    // 抽奖
    choujiang () {
      if (this.isBtn) {
        this.$http({url: '/ajaxOppoChouJiang', params: {}, method: 'POST'}).then((response) => {
          // 响应成功
          let result = response.data
          if (result.code === 201) {
            alert('可以抽奖')
            this.ok = true
            // this.layer2 = true
            // console.log('prize:' + response.data.obj.prize)
            console.log(result.obj)
            if (result.obj.prize_id === 1) {
              this.layer1 = true
            } else if (result.obj.prize_id === 2) {
              this.layer2 = true
            } else if (result.obj.prize_id === 3) {
              this.layer3 = true
            }
          } else {
            alert('该串码已使用')
          }
        }, (reponse) => {
          // 响应失败
        })
      }
    },
    again () {
      this.layer3 = false
      this.ok = false
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
.oppoDayList {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/bg3.png) no-repeat;
  background-size: cover;
  position: absolute;
  z-index: -1; // text-align: center;
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

div.popup {
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

div.popup2 {
  width: 5rem;
  height: 9rem;
  position: absolute;
  left: 50%;
  top: 50%;
  margin: -3rem 0 0 -2.5rem;
  background: url(../../assets/img/popup3.png) no-repeat;
  background-size: 100%;
  z-index: 5;
}

div.popup3 {
  width: 5rem;
  height: 9rem;
  position: absolute;
  left: 50%;
  top: 50%;
  margin: -3rem 0 0 -2.5rem;
  background: url(../../assets/img/popup2.png) no-repeat;
  background-size: 100%;
  z-index: 5;
}

div.bag-header {
  text-align: center;
  margin: 1.5rem 0 0 .5rem;
  font-weight: bold;
}
div.bag-content {
  margin: 1.6rem 0 0 .5rem;
  text-align: center;
  color: white;
  line-height: .5rem;
}

div.bag-content2 {
  margin: 1.6rem 0 0 0rem;
  text-align: center;
  color: white;
  line-height: .5rem;
}

div.bag-content3 {
  margin: 3.3rem 0 0 .5rem;
  text-align: center;
  color: white;
  line-height: .5rem;
}


.cb {
  clear: both;
}

.zkTime {
  padding: .5rem;
}

.bg-1 {
  // height: 8rem;
  height: auto;
  background: #feea7b;
  margin: 1rem 10px 0 10px;
  border-radius: 5px;
  padding-bottom: 1rem;
}

.bg-top {
  width: 100%;
  background-size: 100%;
  position: relative;
  top: -14px;
}

.div-b {
  margin: -.35rem 10px 0 10px;
  height: 7rem;
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
  width: .7rem; // height: .7rem;
  // position: relative;
  // top: -1.28rem;
  // left: 1.1rem;
  // background-size: 100%;
}
.img-popup{
  width: 2rem;
  height: 0.5rem;
  position: relative;
  top: -0.4rem;
  left: 50%;
  margin-left: -1rem; 
}

.img-close {
  width: 0.4rem;
  height: .4rem;
  position: relative;
  top: 1.25rem;
  left: 4.4rem;
}

.img-close2 {
  width: 0.4rem;
  height: .4rem;
  position: relative;
  top: -.15rem;
  left: 4rem;
}

.img-close3 {
  width: 0.4rem;
  height: .4rem;
  position: relative;
  top: -.15rem;
  left: 4.2rem;
}

div.title {
  width: 120px;
  background-size: 100%;
  position: relative;
  top: -.88rem;
  z-index: 1;
  left: 50%;
  margin-left: -60px;
}

div.title2 {
  width: 120px;
  background-size: 100%;
  position: relative;
  top: -1rem;
  z-index: 1;
  left: 50%;
  margin-left: -60px;
}
div.letter {
  font-size: 1.5rem;
  margin-top: -2rem;
}


.div-2 {
  margin: 1px 10px;
  height: 2.5rem;
  border-radius: 5px;
  overflow: hidden;
  background: #1D8348;
  position: relative;
  top: -1.2rem;
}

.div-3 {
  margin: 1px 10px;
  height: 2rem;
  border-radius: 5px;
  overflow: hidden;
  background: white;
  position: relative;
  top: -1.4rem;
  text-align: center;
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

.badge {
  width: .4rem;
  height: .4rem;
  position: absolute;
  top: .15rem;
  right: .15rem;
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

.txt2 {
  position: relative;
  top: .4rem;
  font-size: .7rem;
  display: inline-block;
  letter-spacing: .15rem;
}

.txt3 {
  width: 100px;
  height: .25rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

div.btn {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 6.1rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn-black.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  color: white;
  padding-top: .1rem;
  disabled: none;
}

div.tag-btn {
  width: 2rem;
  height: 1rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  margin: .3em 0 0 1.7rem;
  text-align: center;
  line-height: .5rem;
  color: white;
}
div.tag-btn2 {
  width: 2rem;
  height: 1rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  margin: .3em 0 0 1.5rem;
  text-align: center;
  line-height: .5rem;
  color: white;
}

div.tag-btn3 {
  width: 2rem;
  height: 1rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  margin: .3em 0 0 1.7rem;
  text-align: center;
  line-height: .5rem;
  color: white;
}

div.btn2 {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 6.1rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn3.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  color: white;
  padding-top: .1rem;
}

div.div-row {
  font-size: .25rem;
  margin: 10px 10px 0 10px;
}

div.div-row2 {
  font-size: .25rem;
  margin: 10px 10px 0px 10px;
  line-height: .25rem;
  background: white;
  padding: 10px;
}

.margin {
  margin: 10px 10px 10px 10px;
}

div.line {
  margin: 0px 10px;
  border: 1px solid #FBFCFC;
}

div.condition {
  text-align: center;
  margin: 10px 10px;
  font-size: .2rem;
}

div.condition2 {
  margin: 10px 10px;
  font-size: .2rem;
}

div.line-col {
  display: inline-block;
  height: 100%;
  border: 1px solid red;
}

.f-02 {
  font-size: .2rem;
}

.fr {
  float: right;
}
.color-1 {
  color: #f44031;
}

.f-3 {
  font-size: .25rem;
}

.f-4 {
  font-size: .6rem;
}

</style>

