<template>
  <section class="zixunSelectTicket">
		<div class="header clearfix">
			<div class="header-img" v-bind:style="{ 'background': 'url('+ image +'?imageView2/1/w/200/h/200) 50% center / cover no-repeat'}"></div>
			<div class="header-title">{{activity.name}}</div>
		</div>
		<!-- 票种选择 -->
		<div class="ticket">
			<div class="ticket-title">票种选择</div>
			<div class="ticket-list">
				<div class="ticket-list-item clearfix" v-for="(item, index) in ticket" :key="index" @click="clickChoosed(index, item)" :class="{'choosed': index === ticketIndex }">
					<div class="item-left" :class="{ 'item-left2': index === ticketIndex }">
						<div class="ticket-name fs-024">{{item.name}}</div>
						<div class="ticket-time">{{item.introduce}}</div>
					</div>
					<div class="item-right">
						<div class="item-right-text">
							<p class="price fs-028">￥{{item.price}}元</p>
							<p class="remain" v-if="item.limit_buy_num-item.ticket.length > 0">剩余{{item.limit_buy_num-item.ticket.length}}张</p>
              <p v-else-if="item.limit_buy_num> 0 && item.limit_buy_num-item.ticket.length <= 0">已售空</p>
              <p v-else="item.limit_buy_num === 0"></p>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<!-- 数量 -->
		<div class="ticket-num">
			<div class="ticket-title">数量</div>
			<div class="row-num">
				<img src="../assets/zixun/minus2.png" class="icon" @click="clickMinus">
        <div class="numbers">
          <input type="text" v-model="num" name="total" readonly maxlength="2">
        </div>
				<img src="../assets/zixun/plus2.png" class="icon" @click="clickPlus">
				<span class="fs-02">每人限购99份</span>
			</div>
		</div>
		
		<!-- 底部 -->
		<div class="footer">
			<div class="footer-left">￥{{count()}}</div>
			<div class="footer-right" @click="join">我要参加</div>
		</div>


    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import { Loading } from 'vux'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { ajaxZixunActivityInfo } from '../api/getData'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: true, // 是否显示加载动画
      showLoading: false, // 是否显示数据加载中弹窗
      showLoadingText: '', // 加载中弹窗文字
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      goodsList: [],
      act_id: '', // 活动id
      ticket: [], // 票券信息
      isChoose: false, // 是否选择
      ticketIndex: -1,
      activity: [], // 活动信息
      image: '',
      num: 1,
      ticktype_id: '',
      total: 0
    }
  },
  created () {
    this.act_id = this.$route.query.act_id
    this.fetchData()
  },
  computed: {
  },
  methods: {
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    },
    openPopupFun (type, msg, icon, back) { // 打开弹窗
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗
      this.showPopup = false
    },
    goToPage (val) { // 跳转页面
      console.log(val)
      this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: val}})
    },
    join () {
      if (this.total === 0) {
        this.openPopupFun('alert', '请选择票券', 2)
        return
      }
      return this.$router.push({path: prefixUrl + '/zixunBuyTicket', query: {act_id: this.act_id, ticktype_id: this.ticktype_id, num: this.num}})
    },
    fetchData () { // 初始化数据
      var self = this
      ajaxZixunActivityInfo(self.act_id).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.ticket)) {
            self.ticket = data.obj.ticket
          }
          if (!isEmpty(data.obj.activity)) {
            self.activity = data.obj.activity
            self.image = self.activity.image[0]
          }
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    },
    clickChoosed (val) {
      this.ticketIndex = val
      this.ticktype_id = this.ticket[val].id
      console.log(this.ticktype_id)
    },
    clickMinus () {
      if (this.num <= 1) {
        return 1
      } else {
        this.num -= 1
      }
    },
    clickPlus () {
      if (this.num < 99) {
        this.num += 1
      } else {
        return 99
      }
    },
    count () {
      var val = this.ticketIndex
      if (val === -1) {
        return 0
      }
      var price = this.ticket[val].price
      var $temp = this.num * price
      this.total = $temp
      return $temp
    }
  }
}
</script>

<style lang="less" scoped>
.zixunSelectTicket {
	padding-bottom: 1rem;
}
.header {
	padding: .1rem 0 .2rem 0;
	border-bottom: 1px dotted #384275;
	background: white;
}
.header-img {
	float: left;
	width: 1.2rem;
	height: 1.2rem;
	margin: 0 .15rem;
}
.header-title {
	float: left;
	margin-top: .2rem;
	width: 4.8rem;
	font-size: .22rem;
}
.ticket-title {
	padding: .1rem .2rem;
	font-size: .2rem;
	color: #a7a5a5;
}
.ticket-list {
	margin: 0 .2rem;
	padding: .2rem;
	background: white;
}
.ticket-list-item {
  position: relative;
	width: 100%;
	border: 1px solid #dedede;
	border-radius: 5px;
	position: relative;
	margin-bottom: .15rem;
	color: #aeaeae;
}
.item-left {
	float: left;
	width: 3.5rem;
	padding: .1rem;
	text-align: center;
	font-size: .22rem;
	border-right: 1px solid #dedede;
}
.item-left2 {
  border-right: 1px solid #384275;
}
.ticket-time {
  font-size: .2rem;
}
.item-right {
	position: absolute;
	top: 50%;
	right: 0;
	margin-top: -.35rem;
	width: 2rem;
	float: left;
	font-size: .2rem;
	text-align: center;
}
.row-num {
	margin: .15rem;
	padding: .1rem;
	background: white;
}
.icon {
	width: .6rem;
	height: .6rem;
	vertical-align: middle;
	transform: scalex(-1);
}
.numbers {
  display: inline-block;
	width: 1rem;
  padding: .03rem;
	text-align: center;
  background: white;
  border-radius: 5px;
	border: 1px solid #dedede;
}
.numbers input {
  width: .8rem;
  border: none;
  background: white;
  outline: none;
  text-align: center;
}
.footer {
	position: fixed;
	bottom: 0;
	margin-top: .1rem;
	width: 100%;
	height: .8rem;
	background: white;
	border-top: 1px solid #f7f7f7;
}
.footer-left {
	float: left;
  width: 40%;
  height: .8rem;
  line-height: .8rem;
  padding-left: .2rem;
}
.footer-right {
	float: left;
	width: 60%;
  height: .8rem;
  line-height: .8rem;
  text-align: center;
	background: #384275;
	color: white;
	font-size: .24rem;
}
.support {
  font-family: "Microsoft YaHei", Arial, sans-serif;
  text-align: center;
  color: rgb(156, 156, 156);
  margin: .2rem 0;
  font-size: .2rem;
}
.choosed {
  color: #384275;
  border: 1px solid #384275;
}
.choosed:before{
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
.fs-024 { font-size: .24rem }
.fs-028 { font-size: .28rem }
.fs-02 { font-size: .2rem }
</style>

