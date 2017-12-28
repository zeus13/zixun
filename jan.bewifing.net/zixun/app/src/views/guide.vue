<template>
<section class="guide"> 
    <div class="title">GUIDE</div>
    <div class="cells">
      <div class="line-cell thin" @click="goToPage('login')">
        <div class="line-cell-bd tag-tick">登录</div>
      </div>
      <div class="line-cell thin" @click="goToPage('goodsIndex')">
        <div class="line-cell-bd tag-tick">度研美学美业</div>
      </div>
      <div class="line-cell thin" @click="goToPage('memberCenter')">
        <div class="line-cell-bd tag-tick">会员中心</div>
      </div>
      <div class="line-cell thin" @click="goToPage('orderList')">
        <div class="line-cell-bd tag-tick">我的订单</div>
      </div>
      <div class="line-cell thin" @click="goToPage('addressList')">
        <div class="line-cell-bd tag-tick">收货地址管理</div>
      </div>
      <div class="line-cell thin" @click="goToPage('staffIndex')">
        <div class="line-cell-bd tag-tick">后台管理</div>
      </div>
      <div class="line-cell thin" @click="goToPage('staffOrderList')">
        <div class="line-cell-bd tag-tick">后台订单</div>
      </div>
    </div>
</section>
</template>

<script>
import { prefixUrl } from '@/utils/env'
export default {
  data () {
    return {
      showXLoading: true, // 显示加载动画
      shopId: null, // 商店id值
      totalPrice: 0 // 商品总价
    }
  },
  methods: {
    goToPage (val) { // 跳转页面
      this.$router.push({path: prefixUrl + '/' + val, query: {}})
    }
  }
}
</script>
<style lang="less" scoped>
.guide{
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: -1;
  background-color: #f9f9f9;
  color: #232323;
}
.title{
  padding-top: .77em;
  padding-bottom: .3em;
  padding-left: 15px;
  padding-right: 15px;
  color: #999;
  font-size: 14px;
  background-color: #fff;
}
.cells{
  background-color: #fff;
  position: relative;
}
.cells:after, .cells:before {
  content: " ";
  position: absolute;
  left: 0;
  right: 0;
  height: 1px;
  color: #d9d9d9;
}
.cells:before {
  top: 0;
  border-top: 1px solid #d9d9d9;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scaleY(.5);
  transform: scaleY(.5);
}
.cells:after {
  bottom: 0;
  border-bottom: 1px solid #d9d9d9;
  -webkit-transform-origin: 0 100%;
  transform-origin: 0 100%;
  -webkit-transform: scaleY(.5);
  transform: scaleY(.5);
}
.line{
  line-height: .3rem;
  padding-left: .3rem;
  position: relative;
  padding-top: .23rem;
  padding-bottom: .22rem;
  position: relative;
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
.line-cell {
  padding: .2rem .3rem;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  align-items: center;
}
.line-cell-switch {
  padding: .15rem .3rem;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  align-items: center;
}
.line-cell-bd {
  font-size: 16px;
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
  border-color: #C8C8CD;
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
</style>
