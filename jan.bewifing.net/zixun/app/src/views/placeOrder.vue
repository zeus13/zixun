<template>
  <section class="placeOrder">
    <div class="head" @click="gotoAddressList()">
      <div>{{is_express === 1 ? '快递至' : '上门服务至'}}</div>
      <div v-if="!isEmpty(dispatch)">
        <div class="address-box">
          <div class="address">{{dispatch.dispatch_province + dispatch.dispatch_city + dispatch.dispatch_area + dispatch.dispatch_address}}</div>
          <p>
            <span>{{dispatch.dispatch_name}}</span>
            <span class="ml-03">{{dispatch.dispatch_tel}}</span>
          </p>
        </div>
      </div>
      <div class="no-addr" v-else>
        请输入地址
      </div>
    </div>
    <div class="row">
      <div class="row-left"><img :src="goods.main_img+'?imageView2/1/w/200/h/200'" width="100%" /></div>
      <div class="row-content">
        <div class="title">【{{goods.cat_name}}】{{goods.name}}</div>
        <div class="fs-028 fw">￥{{calcUnitFun()}}<span class="sty2" v-if="is_go_door > 0"> (价格￥{{goods.sale_price / 100}}，技师费￥{{technician_price / 100}})</span></div>
      </div>
      <div class="row-right" v-show="goods.is_limit_buy == 0">
          <img src="../assets/img/aimaspa/minus.png" class="icon" @click="minusFun">
          <input v-model="amount" type="tel" class="number" v-on:input="inputFun">
          <img src="../assets/img/aimaspa/plus.png" class="icon"  @click="plusFun" >
      </div>
      <div class="row-right" v-show="goods.is_limit_buy == 1">
          <span class="number" style="margin-left:30px;">x{{amount}}</span>
      </div>
    </div>
    <div class="list" v-if="!isEmpty(goods)">
      <div v-if="goods.is_go_door === 1">
        <div class="line-cell thin ">
          <h3 class="line-label"><img src="../assets/img/aimaspa/icon25.png" class="icon2">选择技师</h3>
          <div class="line-cell-bd tag-tick">
            <select v-model="technician_id" @change="changeTechnicianFun()" class="line-select">
              <option v-for="(option, index) in goodsSpecList.goods_specs" :key="index" :value="option.id">
                {{ option.name }}
              </option>
            </select>
          </div>
        </div>
        <div class="line-cell thin ">
          <h3 class="line-label"><img src="../assets/img/aimaspa/icon25.png" class="icon2">上门日期</h3>
          <div class="line-cell-bd tag-tick">
            <select v-model="door_date_id" @change="selectDoorDate()" class="line-select">
              <option v-for="(item,index) in doorList" :key="index" :value="item.id">{{item.name}}</option>
            </select>
          </div>
        </div>
        <div class="line-cell thin ">
          <h3 class="line-label"><img src="../assets/img/aimaspa/icon25.png" class="icon2">上门时间</h3>
          <div class="line-cell-bd tag-tick">
            <select v-model="go_door_time" class="line-select">
              <option v-for="(item,index) in door_time_list" :key="index" :value="item.time">{{getStamp(item.time,'hm')}}</option> 
            </select>
          </div>
        </div>
      </div>
      <div class="a-i line-cell thin" v-if="goods.cat_id === 8">
        <h3 class="line-label"><img src="../assets/img/aimaspa/icon26.png" class="icon2">项目名称</h3>
        <div class="line-cell-bd">
          <textarea class="line-textarea" placeholder="这里输入补差价项目" v-model="project_name"></textarea>
        </div>
      </div>
      <div class="line-cell thin " v-if="goods.gold_limit > 0 && member.gold > 0 && goods.cat_id !== 8">
        <h3 class="line-label1"><img src="../assets/img/aimaspa/icon25.png" class="icon2">使用金币<span class="sty3">(我的金币{{member.gold}})</span></h3>
        <div class="line-cell-bd text-r">
          <span class="input-tips">最多可使用{{goods.gold_limit * amount}}金币</span>
          <input type="tel" maxlength="2" class="input-sty" v-model="gold" v-on:input="inputFun">
        </div>
      </div>
      
      <div class="a-i line-cell thin">
        <h3 class="line-label"><img src="../assets/img/aimaspa/icon26.png" class="icon2">买家留言</h3>
        <div class="line-cell-bd">
          <textarea class="line-textarea" placeholder="选填" v-model="remark"></textarea>
        </div>
      </div>
    </div>
    <div class="title-row">如有疑问请联系客服</div>
    <div class="tel-row">
      <span>客服电话</span><a class="tel-row-right" href="tel:15078822247">15078822247</a>
    </div>
    <img src="../assets/img/aimaspa/code5.jpg" class="qrcode">
    <p class="qrcode-text">扫一扫上面的二维码图案，加度研客服微信</p>
<!--     <div class="list">
        <group>
          <spec :spec='item' v-for="(item,index) in goodsSpecList" :key="index" :index="index" :totalPrice="total_price"  @showSpec="callbackSpec"></spec>
        </group>

        <group v-show="goods.is_go_door === 1">
          <div class="vux-selector weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
              <label for="vux-selector-ppx1s" class="weui-label"><img src="../assets/img/aimaspa/icon24.png" class="icon2">上门日期</label>
            </div> 
            <div class="weui-cell__bd">
              <select id="vux-selector-ppx1s" ddd="" class="weui-select" @change="selectDoorDate()" v-model="door_date_id">
                <option v-for="(item,index) in doorList" :key="index" :value="item.id">{{item.name}}</option> 
              </select>
            </div>
          </div>
          <div class="vux-selector weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
              <label for="vux-selector-ppx1s" class="weui-label"><img src="../assets/img/aimaspa/icon25.png" class="icon2">上门时间</label>
            </div> 
            <div class="weui-cell__bd">
              <select id="vux-selector-ppx1s" ddd="" class="weui-select" v-model="go_door_time">
                <option v-for="(item,index) in door_time_list" :key="index" :value="item.time">{{getStamp(item.time,'hm')}}</option> 
              </select>
            </div>
          </div>
        </group>

      <group>
          <div class="vux-x-input weui-cell">
            <div class="weui-cell__hd">
              <img src="../assets/img/aimaspa/icon26.png" class="icon2">买家留言：
            </div> 
            <div class="weui-cell__bd weui-cell__primary">
              <input autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" type="text" placeholder="选填" class="weui-input" v-model="remark"> 
            </div> 
            <div class="weui-cell__ft"></div>
          </div>
      </group>


    </div> -->

    <div class="foot">
      <!-- <div class="foot-item-left" >合计：￥{{(isEmpty(total_price)?0:total_price / 100) + (goods.sale_price / 100)}}</div> -->
      <div class="foot-item-left" v-if="!isEmpty(goods)">合计：￥{{calcTotalFun()}}</div>
      <div class="foot-item-right" @click="placeOrder()">确认订单</div>
    </div>


    <!-- <div @click="placeOrder()">生成订单</div> -->
    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>

    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { getGoodsDetail, placeOrder } from '../api/getData'
import { Loading, Selector, Group, XInput } from 'vux'
import Spec from '@/components/other/spec'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Selector,
    Group,
    XInput,
    Spec
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      type: '', // 提交类型
      goods_id: 0,
      goods: {},
      dispatch: {}, // 配送地址
      doorList: [], // 上门时间
      goodsSpecList: [], // 特殊规格
      amount: 1, // 购买数量
      remark: '', // 备注
      is_go_door: 0, // 1上门（显示选择技师）
      go_door_time: 0, // 上门时间
      specs: [], // 选中规格
      is_express: 0, // 1是快递0否
      number: 0,
      door_date_id: 0, // 选择日期
      door_time_list: [], // 时间临时列表
      total_price: 0,
      technician_price: 0, // 技师价格
      technician_id: 0, // 技师id
      gold: 0, // 金币
      member: [],
      project_name: '' // 项目名称（补差价专用）
    }
  },
  created () {
    if (!isEmpty(this.$route.query.goods_id)) {
      this.goods_id = this.$route.query.goods_id
    } else {
      this.$router.go(-1)
    }
  },
  mounted () {
    this.getGoodsDetail()
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
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    inputFun () { // 当gold输入框有变化时执行
      console.log(this.gold)
      if (this.gold > this.member.gold) {
        this.openPopupFun('alert', '你的金币还剩' + this.member.gold + '个', 2)
        this.gold = this.member.gold
      }
      if (this.gold > (this.goods.gold_limit * this.amount)) {
        this.openPopupFun('alert', '本次最多使用' + (this.goods.gold_limit * this.amount) + '个金币哟', 2)
        this.gold = this.goods.gold_limit * this.amount
      }
    },
    // callbackSpec (totalPriceTemp, index, specId) {
    //   this.total_price = totalPriceTemp
    //   this.specs[index] = specId
    // },
    minusFun () {
      if (this.amount <= 1) {
        return
      }
      this.amount--
      this.inputFun()
      // this.total_price = this.total_price - (this.goods.sale_price / 100 + this.technician_price)
    },
    plusFun () {
      this.amount++
      this.inputFun()
      // this.total_price = this.total_price + (this.goods.sale_price / 100 + this.technician_price)
    },
    changeTechnicianFun () { // 动态变更技师价格
      var arr = this.goodsSpecList.goods_specs
      var len = arr.length
      for (var i = 0; i < len; i++) {
        if (arr[i].id === this.technician_id) {
          this.technician_price = arr[i].price
          break
        }
      }
    },
    calcUnitFun () {
      var t = 0
      t = (this.goods.sale_price / 100) + (this.technician_price / 100)
      console.log(t)
      return t.toFixed(2)
    },
    calcTotalFun () {
      var t = 0
      t = ((this.technician_price + this.goods.sale_price) * this.amount) / 100 - this.gold * 10
      console.log(t)
      t = t < 0 ? 0 : t
      return t.toFixed(2)
    },
    selectDoorDate () { // 选择日期
      console.log(this.door_date_id)
      for (var i = this.doorList.length - 1; i >= 0; i--) {
        if (this.doorList[i].id === this.door_date_id) {
          this.door_time_list = this.doorList[i].door_times
        }
      }
    },
    addressFun () {
      this.$router.push({path: prefixUrl + '/addressList', query: {}})
    },
    placeOrder () { // 生成订单
      var self = this
      if (parseInt(self.amount) === 0) {
        self.openPopupFun('alert', '购买数量不能为0', 2)
        return
      }
      if (isEmpty(self.dispatch)) {
        self.openPopupFun('alert', '请填写收货信息', 2)
        return
      }
      if (self.is_go_door === 1 && (self.go_door_time === 0 || isEmpty(self.go_door_time))) {
        self.openPopupFun('alert', '请选择上门时间', 2)
        return
      }
      if (self.goods.cat_id === 8 && self.project_name === '') {
        self.openPopupFun('alert', '请填写项目名称', 2)
        return
      }
      // var specs = []
      // for (var i = self.goodsSpecList.goods_specs.length - 1; i >= 0; i--) {
      //   console.log(self.goodsSpecList.goods_specs[i])
      //   if (self.goodsSpecList.goods_specs[i] !== 0) {
      //     specs.push(self.specs[i])
      //   }
      // }
      var arr = []
      if (self.is_go_door === 1) {
        arr.push(self.technician_id)
      }
      var object = {
        project_name: self.project_name,
        goods_id: self.goods_id,
        amount: self.amount,
        gold: self.gold,
        dispatch: self.dispatch,
        remark: self.remark,
        specs: arr,
        is_go_door: self.is_go_door,
        go_door_time: self.go_door_time,
        is_express: self.is_express
      }
      // console.log(placeOrder)
      // console.log(object)
      self.showLoadingText = '提交中'
      self.showLoading = true
      placeOrder(self.type, object).then(response => {
        var data = response.data
        if (data.code === 200) {
          console.log('~~~~')
          self.$router.replace({path: prefixUrl + '/pay', query: {ordersn: data.obj}})
          // window.location.href = prefixUrl + '/pay?ordersn' + data.obj
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    },
    getGoodsDetail () {
      var self = this
      getGoodsDetail(self.type, self.goods_id).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (!isEmpty(data.obj.goods)) {
            self.goods = data.obj.goods
            self.is_go_door = self.goods.is_go_door
            self.is_express = self.goods.is_express
            console.log(data.obj.goodsSpecList)
            if (!isEmpty(data.obj.goodsSpecList[0]) && !isEmpty(data.obj.goodsSpecList[0].goods_specs[0])) {
              // 三个select默认选中第一个
              self.technician_id = data.obj.goodsSpecList[0].goods_specs[0].id
              if (self.is_go_door === 1) {
                self.technician_price = data.obj.goodsSpecList[0].goods_specs[0].price
              }
            }
            self.total_price = (self.goods.sale_price / 100) * self.amount
          }
          if (!isEmpty(data.obj.dispatch)) {
            self.dispatch = data.obj.dispatch
          }
          if (!isEmpty(data.obj.doorList)) {
            var list = data.obj.doorList
            var arr = []
            for (var i = 0; i < list.length; i++) {
              if (!isEmpty(list[i].door_times)) {
                arr.push(list[i])
              }
            }
            self.doorList = arr
          }
          if (!isEmpty(data.obj.goodsSpecList)) {
            self.goodsSpecList = data.obj.goodsSpecList[0]
          }
          if (!isEmpty(data.obj.member)) {
            self.member = data.obj.member
            console.log(self.member)
          }
          // 三个select默认选中第一个
          self.door_date_id = self.doorList[0].id
          self.go_door_time = self.doorList[0].door_times[0].time
          self.selectDoorDate()
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    },
    gotoAddressList () {
      return this.$router.push({path: prefixUrl + '/addressList', query: {}})
    }
  },
  watch: {
    // goodsSpecList: function (value, value1) {
    //   console.log(value)
    //   console.log(value1)
    //   // console.log(value)
    // }
  }
}
</script>

<style lang="less" scoped>
.placeOrder {
  padding-bottom: 1rem;
}
.input-sty {
  width: .6rem;
  border: 1px solid #999;
  outline: 0;
  border-radius: 0;
  text-align: center;
}
.a-i{
  -webkit-box-align: stretch !important;
  -webkit-align-items: stretch !important;
  align-items: stretch !important;
}
.sty2 {
  font-size: .2rem;
  color: #999;
  font-weight: 400;
}
.sty3 {
  font-size: .2rem;
  color: #999;
}
.line-cell {
    padding: .2rem .4rem .2rem .3rem;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
}
.line-label {
    display: block;
    width: 1.6rem;
    margin-right: .1rem;
    word-wrap: break-word;
    word-break: break-all;
}
.line-label1 {
    display: block;
    width: 2.8rem;
    margin-right: .1rem;
    word-wrap: break-word;
    word-break: break-all;
}
.thin:before {
    content: " ";
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    height: 1px;
    border-top: 1px solid #D9D9D9;
    color: #D9D9D9;
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
    -webkit-transform: scaleY(0.5);
    transform: scaleY(0.5);
    left: .3rem;
}
.line-cell-bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
}
.tag-tick:after {
    content: " ";
    display: inline-block;
    height: 6px;
    width: 6px;
    border-width: 2px 2px 0 0;
    border-color: #d2bf97;
    border-style: solid;
    -webkit-transform: matrix(0.71, 0.71, -0.71, 0.71, 0, 0);
    transform: matrix(0.71, 0.71, -0.71, 0.71, 0, 0);
    position: relative;
    top: -2px;
    position: absolute;
    top: 50%;
    right: 15px;
    margin-top: -4px;
}
.line-select{
  -webkit-appearance: none;
  border: 0;
  outline: 0;
  background-color: transparent;
  width: 100%;
  font-size: .24rem;
  position: relative;
  z-index: 1;
  color: #232323;
  direction: rtl;
  padding: 0 .1rem;
}
.line-textarea {
    display: block;
    border: 0;
    resize: none;
    width: 100%;
    color: inherit;
    font-size: .24rem;
    line-height: inherit;
    outline: 0;
}

.number {
  display: inline-block;
  width: .8rem;
  text-align: center;
  border: 1px solid #999;
  outline: 0;
}
.textara-row {
  display: inline;
}
.message {
  width: 1.8rem;
  line-height: .5rem;
  display: inline;
}
.message::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../assets/img/aimaspa/icon9.png');
  background-size: 100%;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
  margin-right: .1rem;
}
.textara-box {
  margin: .2rem;
  border: 1px solid #d2bf97;
  border-radius: 5px;
  background: white;
}
.icon {
  width: .4rem;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
}
.icon2 {
  width: .3rem;
  height: .3rem;
  vertical-align: middle;
  position: relative;
  top: 0;
  margin-right: .1rem;
}
.list {
  margin-top: .2rem;
  background: white;
}
.list-item {
  padding: .2rem;
  line-height: .5rem;
  border-bottom: 1px solid #d2bf97;
  color: #9a8d70;
}
.list-item-input {
  padding: .2rem;
  line-height: .5rem;
  border-bottom: 1px solid #d2bf97;
  color: #9a8d70;
  position: relative;
}
.input-left {
  position: absolute;
  top: .2rem;
}
.input {
  width: 100%;
  padding-left: 1.5rem;
  outline: none;
  border: none;
}
.list-item::after {
  content: '';
  display: inline-block;
  width: .2rem;
  height: .2rem;
  border-right: 1px solid #d2bf97;
  border-bottom: 1px solid #d2bf97;
  transform: rotate(-45deg);
  margin-right: .1rem;
  margin-top: .15rem;
  float: right;
}
.list-item-right {
  display: inline-block;
  width: 2rem;
  text-align: right;
  margin-left: 2.2rem;
}
.row-left {
  width: 1.2rem;
  height: 1.2rem;
}

.row {
  padding: .3rem .2rem;
  position: relative;
  background: white;
}
.row-content {
  position: absolute;
  top: .2rem;
  left: 1.6rem;
  line-height: .5rem;
}
.row-right {
  position: absolute;
  bottom: 0;
  right: .2rem;
}
.head {
  width: 100%;
  padding: .2rem;
  background: #948d87;
  color: white;
  line-height: .5rem;
  position: relative;
}
.head::after {
  content: '';
  display: inline-block;
  width: .24rem;
  height: .24rem;
  border-right: 1px solid white;
  border-bottom: 1px solid white;
  transform: rotate(-45deg);
  position: absolute;
  top: 50%;
  margin-top: -.12rem;
  right: .3rem;
}
.address {
  width: 5.4rem;
  padding-left: .3rem;
}
.address-box {
  font-size: .24rem;
}
.address-box::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../assets/img/aimaspa/icon23.png');
  background-size: 100%;
  vertical-align: middle;
  position: absolute;
  top: .84rem;
  margin-right: .1rem;
}
.foot {
  position: fixed;
  bottom: 0;
  width: 100%;
  display: flex;
  flex-direction: row;
  line-height: .4rem;
  font-size: .28rem;
}
.foot-item-left {
  flex-grow: 2;
  background: #d2bf97;
  padding: .2rem;
}
.foot-item-right {
  flex-grow: 1;
  text-align: center;
  background: black;
  color: #d2bf97;
  padding: .2rem;
}
.title {
  width: 4.5rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-weight: bolder;
}
.ml-03 {margin-left: .2rem;}
.fs-028 {font-size:.28rem;}
.fw {font-weight: bolder;}
.no-addr {
  color: #d2bf97;
  padding-left: .3rem;
}
.no-addr:before {
  content: '';
  display: block;
  width: .25rem;
  height: .25rem;
  background: url('../assets/img/tips.svg');
  background-size: 100%;
  vertical-align: middle;
  position: absolute;
  top: .8rem;
  left: .2rem;
  margin-right: .1rem;
}
.input-tips {
  font-size: .2rem;
  color: #F44336;
  margin-left: .1rem;
}
.title-row {
  padding: .2rem .3rem;
  font-size: .24rem;
  color: #999;
}
.tel-row {
  padding: .2rem .4rem .2rem .3rem;
  background: white;
  font-size: .28rem;
}
.tel-row a {
  color: #666;
}
.qrcode {
  width: 3rem;
  height: 3rem;
  display: block;
  margin: .4rem auto .1rem;
}
.qrcode-text {
  font-size: .24rem;
  text-align: center;
  color: #999;
  margin-bottom: .3rem;
}
.tel-row::before {
  content: '';
  display: inline-block;
  width: .35rem;
  height: .35rem;
  background: url('../assets/img/aimaspa/icon28.png') no-repeat;
  background-size: 100%;
  position: relative;
  top: .08rem;
  margin-right: .1rem;
}
.tel-row-right::after {
  content: '';
  display: inline-block;
  width: .12rem;
  height: .12rem;
  border-right: 2px solid #d2bf97;
  border-bottom: 2px solid #d2bf97;
  transform: rotate(-45deg);
  margin-left: .1rem;
}
.tel-row-right {
  float: right;
}
</style>
<style lang="less">
.placeOrder .weui-cell__hd{
  color: #9a8d70 !important;
}
.placeOrder .weui-cell:before{
  border-top:2px solid #ecdec2 !important;

}
.placeOrder .weui-cells:before{
  border-top:2px solid #ecdec2 !important;
}
.placeOrder .weui-cells:after{
  border-top:2px solid #ecdec2 !important;
}
.placeOrder .vux-selector.weui-cell_select-after{
  // padding: 10px 0 10px 15px !important;
}
.placeOrder .weui-cell_select .weui-cell__bd:after{
    height: 12px;
    width: 12px;
    border-color: #ecdec2;
    // content: '';
    // display: inline-block;
    // width: .2rem;
    // height: .2rem;
    // border-right: 1px solid #d2bf97;
    // border-bottom: 1px solid #d2bf97;
    // -webkit-transform: rotate(-45deg);
    // transform: rotate(-45deg);
    // margin-right: .1rem;
    // margin-top: .15rem;
    // float: right;
}
.placeOrder .vux-x-input{
  // padding: 20px 15px;
}
.placeOrder .weui-select{
  color: #9a8d70 !important;
}
.placeOrder .weui-cell_select-after .weui-select {
  direction: rtl;
}
.weui-cells:after {
    content: " ";
    position: absolute;
    left: 0;
    bottom: 0;
    right: 0;
    height: 1px;
    border-bottom: 1px solid #fff !important;
    color: #fff;
    -webkit-transform-origin: 0 100%;
    transform-origin: 0 100%;
    -webkit-transform: scaleY(0.5);
    transform: scaleY(0.5);
}
.weui-cell_select .weui-cell__bd:after {
    margin-top: -7px !important;
}

</style>
