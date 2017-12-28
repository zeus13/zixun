<template>
  <div class="boringBuyTicket">
    <div class="mask"></div>
    <div>
      <div class="row">
        <img src="../../assets/img/boring/img2.png" alt="" class="img">
        <div class="content">
          <span class="fs026">{{title}}</span>
          <span>这个页面有问题</span>
        </div>
      </div>
      <div class="ml01">
        <span>票种选择</span>
      </div>
      <div class="row-ticket">
        <div class="row-ticket-item"><img src="../../assets/img/boring/icon-tick.png" alt="" class="img-tick">
          <span>普通票|￥{{ordinaryTicket}}</span>
        </div>
        <div class="row-ticket-item">
          <span>VIP|￥{{vipTicket}}</span>
        </div>
      </div>
      <div class="ml01">
        <span>数量</span>
      </div>
      <div class="number">
        <div class="number-item">
          <div class="box">-</div>
          <div class="box width05">1</div>
          <div class="box">+</div>
        </div>
      </div>
      <div class="placeholder"></div>
      <div class="footer">
        <div class="footer-item">
          <div class="footer-money">￥{{total}}</div>
          <div class="footer-next">下一步</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      ordinaryTicket: '10',
      vipTicket: '15',
      title: '2017中国东盟(国际)|青年文化创意博览会|',
      total: '10'
    }
  }
}
</script>


<style lang="less" scoped>
@import '../../assets/css/mycss.css';
.boringBuyTicket {
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

.img {
  width: 1.6rem;
  height: 1.2rem;
  background-size: 100%;
}

.img-tick {
  width: .6rem;
  height: .6rem;
  z-index: 1;
  position: relative;
  top: .39rem;
  left: 2.5rem;
}

.row {
  background: white;
  position: relative;
  top: 0;
  left: 0;
  height: 1.5rem;
  padding: .2rem;
  border-bottom: 1px dashed black;
}

.row-ticket {
  background: white;
  position: relative;
  top: 0;
  left: 0;
  padding: .2rem;
  border-bottom: 1px dashed black;
}

.row-ticket-item {
  width: 4rem;
  height: 1rem;
  text-align: center;
  line-height: 1rem;
  border: 1px solid #384275;
  margin-bottom: .2rem;
  font-size: .3rem;
  border-radius: 5px;
}

.content {
  position: relative;
  top: -1.2rem;
  left: 1.9rem;
  width: 4rem;
}

.ml01 {
  margin: 0.1rem 0.2rem;
}

.number {
  position: relative;
  top: 0rem;
  left: 0rem;
  background: white;
  padding: 0.2rem;
}

.box {
  width: 0.4rem;
  height: 0.4rem;
  text-align: center;
  line-height: 0.4rem;
  border: 1px solid #384275;
  border-radius: 5px;
  display: inline-block;
}

.width05 {
  width: 0.6rem;
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

.footer-money {
  flex-grow: 1;
  padding-left: 0.2rem;
  height: 0.8rem;
}

.footer-next {
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

