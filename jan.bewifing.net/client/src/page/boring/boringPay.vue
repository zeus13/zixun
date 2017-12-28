<template>
  <div class="boringPay">
    <div class="mask"></div>
    <div class="header">
      <div class="header-title"><span>{{title}}</span></div>
      <div class="number">
        <span>类型：{{type}}</span>
        <span>数量：{{number}}张</span>
      </div>
      <div class="address">
        <img src="../../assets/img/boring/icon-map.png" alt="" class="img-address">
        <div class="address-content"><span>{{address}}</span></div>
      </div>
      <!-- 取票方式 -->
    <div class="ticket">
      <img src="../../assets/img/boring/icon-book4.png" alt="" class="img-address">
      <span class="ticket-content">取票方式：{{ticket}}</span>
    </div>
    </div>

    <div class="info-title"><span>购买信息</span></div>
    <div class="info-row">
      <span>手机</span>
      <input type="text" placeholder="接收预订成功短信" class="ing-row-input">
    </div>
    <div class="footer">
      <div class="footer-item">
        <div class="footer-total">合计: ￥{{total}}</div>
        <div class="footer-pay"><span>支付</span></div>
      </div>
    </div>
    <div class="placeholder"></div>
  </div>
</template>
<style lang="less" scoped>
@import '../../assets/css/mycss.css';
.boringPay {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;

}
.mask {
  width: 100%;
  height: 100%;
  background: #F7F9F9;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}
.header {
  margin: 0.2rem;
  position: relative;
  top: 0;
  left: 0;
  background: white;
}
.header-title {
  padding:  0.1rem 0rem 0.1rem .4rem;
  font-size: .26rem;
  width: 5.5rem;
}
.number {
  padding: 0rem 0rem 0.1rem .4rem;
  font-size: .24rem;
}
.img-address {
  width: .2rem;
  height: .2rem;
  background-size: 100%;
  position: relative;
  top: 0;
  left: .1rem;
  vertical-align: middle;
}
.address {
  position: relative;
  top: 0;
  left: 0;
  border-bottom: 1px dashed #384275;
  font-size: .24rem;
}
.address-content {
  position: relative;
  top: -.35rem;
  left: .4rem;
  width: 5.5rem;
}
.ticket {
  position: relative;
  top: 0;
  left: 0;
  font-size: .24rem;
  padding:.1rem 0;
}
.ticket-content {
  position: relative;
  top:0;
  left:.2rem;
  width: 5.5rem;
}

.info-title {
  margin: .1rem .2rem;
  font-size: .26rem;
  color: gray;
  padding: 0 .2rem;
}
.info-row {
  margin: .1rem .2rem;
  padding: .1rem .2rem;
  background: white;
  font-size: .24rem;
}
.ing-row-input {
  height: .3rem;
  width: 4rem;
  outline: none;
  border: none;
  margin-left: .2rem;
}
.footer {
  position: fixed;
  bottom: 0px;
  background: white;
  width: 100%;
}
.footer-item {
  display: flex;
  flex-direction: row;
  line-height: 0.8rem;
}
.footer-total {
  flex-grow: 1;
  padding-left: 0.2rem;
  height: 0.8rem;
}
.footer-pay {
  flex-grow: 2;
  text-align: center;
  background: #384275;
  color: white;
  height: 0.8rem;
}
.placeholder {
  height: 1rem;
}
</style>
<script>

export default {
  data () {
    return {
      title: '2017中国东盟(国际)|青年文化创意博览会|',
      type: '普通票',
      number: '1',
      address: '南宁国际会展中心D区12号展厅 7月7日~7月9日 10:30~22:30',
      ticket: '电子票',
      total: '100'
    }
  }
}
</script>

