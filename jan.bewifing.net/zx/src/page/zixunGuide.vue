<template>
  <section class="zixunGuide"> 
    <div class="line"><h3>GUIDE</h3></div>
    <div class="line-cell thin" @touchstart="goToPage('zixunActivityIndex')">
      <div class="line-cell-bd tag-tick">活动首页</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunActivityInfo')">
      <div class="line-cell-bd tag-tick">活动详情</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunSelectTicket')">
      <div class="line-cell-bd tag-tick">选票</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunBuyTicket')">
      <div class="line-cell-bd tag-tick">购票</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunOrderList')">
      <div class="line-cell-bd tag-tick">订单列表</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunOrderInfo')">
      <div class="line-cell-bd tag-tick">订单信息</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunTicketList')">
      <div class="line-cell-bd tag-tick">票券列表</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunTicketInfo')">
      <div class="line-cell-bd tag-tick">票券信息</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunUserHome')">
      <div class="line-cell-bd tag-tick">个人信息</div>
    </div>
    <div class="line-cell thin" @touchstart="goToPage('zixunUserEdit')">
      <div class="line-cell-bd tag-tick">个人信息编辑</div>
    </div>
    <div class="gray-div"></div>
  </section>
  
</template>

<script>
export default {
  data () {
    return {
      foodNum: 0
    }
  },
  methods: {
    goToPage (val) { // 跳转链接
      this.$router.push({name: val, query: {}})
    }
  }
}
</script>
<style lang="less" scoped>
.zixunGuide{
  color: #535353;
}
.gray-div{
  width: 100%;
  height: .15rem;
  background: #f6f6f6;
}
.line{
  line-height: .3rem;
  padding-left: .3rem;
  position: relative;
  padding-top: .23rem;
  padding-bottom: .22rem;
  position: relative;
}
.s-line{
    line-height: .3rem;
    padding-left: .3rem;
    padding-top: .15rem;
    padding-bottom: .15rem;
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
.line-label {
    display: block;
    width: 1rem;
    margin-right: .2rem;
    word-wrap: break-word;
    word-break: break-all;
}
.line-cell-bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
}
.line-input {
    width: 100%;
    border: 0;
    outline: 0;
    -webkit-appearance: none;
    background-color: transparent;
    font-size: inherit;
    color: inherit;
    height: 1.41176471em;
    line-height: 1.41176471;
    color: #7d7d7d;
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
  color: #7d7d7d;
  font-family: "PingFangSC-Light";
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
