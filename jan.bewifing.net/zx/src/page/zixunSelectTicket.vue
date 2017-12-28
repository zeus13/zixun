<template>
<section class="zixunSelectTicket">
  <div v-if="!showXLoading">
    <div class="top">
      <div class="thumbnail" v-for="(i, index) in activity.image" v-show="index === 0" v-bind:style="{ 'background': 'url('+i+'?imageView2/1/w/200/h/200) no-repeat','background-size':'cover','background-position':'50%'}"></div>
      <span>{{activity.name}}</span>
    </div>
    <div class="m2">
      <div class="title">票种选择</div>
      <div class="ticketList">
        <div :class="{choosed: index === ticketIndex, ticket:true}" v-for="(item,index) in ticket" @click="clickTicketIndex(index, item)" class="clearfix">
          <div class="ticket-left">
            <p class="ticket-left-title">{{item.name}}</p>
            <div class="fs-02 text-c" v-html="item.introduce"></div>
          </div>
          <div class="ticket-right" v-show="item.is_limit_buy === 0">
            <div>￥{{item.price}}</div>
          </div>
          <div class="ticket-right2" v-show="item.is_limit_buy === 1">
            <div>￥{{item.price}}</div>
            <div for="small" class="subtitle2" v-if="item.limit_buy_num-item.ticket.length > 0">剩余{{item.limit_buy_num-item.ticket.length}}张</div>
            <div for="small" class="subtitle2" v-else>已售空</div>
          </div>
        </div>
      </div>
      <div class="title">数量</div>
      <div class="ticketNum clearfix">
        <div class="minus" @click="clickMinus()">
          <svg class="small-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M126.960756 550.458157h767.021166v-73.407459H126.960756v73.407459z" /></svg>
        </div>
        <input type="tel" id="total"v-model="num" name="total">
        <div class="plus" @click="clickPlus()">
          <svg class="small-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M964.266667 472.177778h-412.444445v-412.444445c0-22.755556-17.066667-39.822222-39.822222-39.822222s-39.822222 17.066667-39.822222 39.822222v412.444445h-412.444445c-22.755556 0-39.822222 17.066667-39.822222 39.822222s17.066667 39.822222 39.822222 39.822222h412.444445v412.444445c0 22.755556 17.066667 39.822222 39.822222 39.822222s39.822222-17.066667 39.822222-39.822222v-412.444445h412.444445c22.755556 0 39.822222-17.066667 39.822222-39.822222s-17.066667-39.822222-39.822222-39.822222z" /></svg>
        </div>
        <div class="num-info">每人限购99份</div>
      </div>
    </div>
    <div class="foot-blank-div"></div>
    <div class="foot">
      <span class="price">￥{{beautifyTicketTotalPrice()}}</span>
      <div class="join-btn" @click="clickBuy()" v-if="isCheck">我要参加</div>
      <div class="join-btn-gray" v-else>我要参加</div>
    </div>
  </div>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getStamp } from '@/components/common/utils'
export default {
  components: {
    XLoading,
    popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      activity: {}, // 活动信息
      act_id: 0, // 活动id
      ticktype_id: 0, // 票型id
      ticketIndex: -1, // 票型下标
      num: 1, // 购买数量
      ticket: {},
      isCheck: false
    }
  },
  created () {
    if (!isEmpty(this.$route.query.act_id)) {
      this.act_id = this.$route.query.act_id
    } else {
      this.$router.go(-1)
    }
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    clickTicketIndex (val, item) { // 选票
      var _self = this
      this.ticketIndex = val
      this.ticktype_id = this.activity.ticket_types[val].id
      console.log('check', item)
      if (item.is_limit_buy === 1) {
        console.log('1')
        if (item.limit_buy_num - item.ticket.length > 0) {
          console.log('2')
          _self.isCheck = true
        } else {
          console.log('3')
          _self.isCheck = false
        }
      } else {
        _self.isCheck = true
      }
    },
    clickMinus () { // 点击减少
      if (this.num <= 1) {
        return
      }
      this.num -= 1
    },
    clickPlus () { // 点击增加
      if (this.num >= 99) {
        return
      }
      this.num += 1
    },
    beautifyTicketTotalPrice () { // 优化票总价
      var index = 0
      if (this.ticketIndex === -1) {
        return 0
      }
      var price = parseFloat(this.activity.ticket_types[this.ticketIndex].price)
      while (!isEmpty(this.activity.ticket_types[this.ticketIndex].discount) && !isEmpty(this.activity.ticket_types[this.ticketIndex].discount[index])) {
        if (this.num < this.activity.ticket_types[this.ticketIndex].discount[index]['amount']) {
          index = -1
        } else {
          price = parseFloat(this.activity.ticket_types[this.ticketIndex].price) * parseFloat(this.activity.ticket_types[this.ticketIndex].discount[index]['off'].toFixed(2))
          index = index + 1
        }
      }
      var temp = price * this.num
      return temp
    },
    clickBuy () { // 点击参加
      this.$router.replace({name: 'zixunBuyTicket', query: {act_id: this.act_id, ticktype_id: this.ticktype_id, num: this.num}})
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunActivityInfo', params: {act_id: this.act_id}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          this.activity = result.obj.activity
          this.ticket = result.obj.ticket
          console.log('this.activity', this.activity)
          console.log('this.ticke', result.obj.ticket)
          // if (!isEmpty(this.activity.ticket_types)) {
          //   this.ticktype_id = this.activity.ticket_types[0].id
          // }
        }
      }, function (response) {
        console.log(response)
      })
      this.showXLoading = false
    }
  },
  watch: {
  }
}
</script>
<style lang="less" scoped>
.subtitle2 {
  // display: inline-block;
  font-size: .2rem;
}
.fs-02 { font-size: .2rem }
.text-c { text-align: center; }
.ticket-left {
  width: 3.5rem;
  border-right: 1px solid #d9d9d9;
  padding: .1rem 0;
  text-align: center;
}
.ticket-left-title {
  font-size: .28rem;
  font-weight: bold;
}
.ticket-right {
  font-size: .3rem;
  position: absolute;
  top: 50%;
  right: 0;
  width: 1.8rem;
  text-align: center;
  margin-top: -.18rem
}
.ticket-right2 {
  font-size: .3rem;
  position: absolute;
  top: 40%;
  right: 0;
  width: 1.8rem;
  text-align: center;
  margin-top: -.18rem
}
.zixunSelectTicket{
  color: #0b1e30;
}
.m2{
  margin: 0 .2rem;
}
.top{
  min-height: 1.4rem;
  background: #fff;
  position: relative;
  border-bottom: 1px dotted #9e9ed4;
}
.thumbnail{
  width: 1rem;
  height: 1rem;
  position: absolute;
  top: .2rem;
  left: .2rem;
}
.top span{
  padding-top: .3rem;
  margin-left: 1.4rem;
  display: block;
}
.title{
  line-height: .5rem;
  font-size: .2rem;
  text-indent: .2rem;
  color: #aeaeae;
}
.ticketList{
  background: #fff;
  padding: .2rem;
}
.ticket{
  margin: .1rem;
  border: 1px solid #d9d9d9;
  color: #aeaeae;
  position: relative;
  border-radius: .08rem;
  // padding: 0 .2rem;
}
.ticketList .choosed{
  border: 1px solid #384275;
  color: #384275;
  .ticket-left {
    border-right: 1px solid #384275;
  }
}
.ticketList .choosed:before{
  content: '';
  display: block;
  position: absolute;
  width: .4rem;
  height: .5rem;
  background: url(../assets/img/icon-tick.png) center no-repeat;
  background-size: cover;
  right: 0;
  bottom: 0;
}
.ticketNum{
  background: #fff;
  padding: .2rem;
}
.ticketNum #total{
  width: .7rem;
  height: .4rem;
  -webkit-appearance: none;
  padding: 0 .1rem;
  line-height: .4rem;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 3px;
  outline: 0;
  float: left;
  margin: 0 .1rem;
  text-align: center;
  color: #0b1e30;
}
.ticketNum .minus,.ticketNum .plus{
  float: left;
  width: .4rem;
  height: .4rem;
  text-align: center;    
  line-height: .4rem;
  font-size: .4rem;
  border: 1px solid #8b8b8b;
  border-radius: 3px;
}
.ticketNum .small-icon{
  width: .2rem;
  height: .2rem;
  margin: .1rem;
  fill: #171717;
}
.num-info{
  font-size: .2rem;
  color: #aeaeae;
  line-height: .46rem;
  padding-left: .2rem;
  overflow: hidden;
}
.ticketNum .disabled{
  border: 1px solid #ddd;
}
.ticketNum .disabled svg{
  fill: #a9a9a9;
}
</style>
