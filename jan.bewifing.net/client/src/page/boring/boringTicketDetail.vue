<template>
  <div class="boringTicketDetail">
    <div class="header">
      <div class="header-left"></div>
      <div class="header-right">2017中国东盟(国际)|青年文化创意博览会</div>
      <div class="cb"></div>
      <div class="line"></div>
    </div>
    <div class="body">
      <div class="rows">{{time}}</div>
      <div class="rows">{{ticket}}</div>
      <img src="../../assets/img/boring/icon-map.png" alt="" class="map-img">
      <div class="rows">{{address}}</div>
    </div>
    <div class="body">
      <div class="divider divider-end">
        <divider>
          <img src="../../assets/img/boring/icon-tickets.png" alt="" class="divider-img">
          <span class="divider-txt">电子门票</span>
        </divider>
      </div>
      <div class="ticket-title">·请出示门票给工作人员核销，才能进场</div>
    </div>

  </div>
</template>

<script>
import { Divider } from 'vux'
export default {
  data () {
    return {
      time: '7月7日~7月9日  10:30~22:30',
      ticket: '普通票-1张',
      address: '南宁国际会展中心D区12号展厅'
    }
  },
  components: {
    Divider
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/mycss.css';
.cb {clear: both}
.header {
  margin: .2rem;
  background: white;
}
.header-left {
  width: 1rem;
  height: 1rem;
  background: url('../../assets/img/boring/img3.png') no-repeat;
  background-size: cover;
  background-position: 50%;
  float: left;
  margin:.2rem;
}
.header-right {
  float: left;
  margin: .4rem 0 0 0;
  width: 4.5rem;
} 
.body {
  background: white;
  margin: .5rem .2rem 0 .2rem;
  font-size: .25rem;
}
.rows {
  line-height: .8rem;
  padding: 0 .4rem;
  border-bottom: 1px solid #f7f7f7;
}
.map-img {
  width: .2rem;
  padding: .3rem .1rem;
  float: left;
  vertical-align: middle;
}
.divider-img {
  width: .25rem;
  vertical-align: middle;
  margin-right: .1rem;
}
.divider-end {
  position: relative;
  top: 0;
}
.divider-txt {
  font-size: .2rem;
  color: #4d5784;
}
.ticket-title {
  font-size: .2rem;
  color: #4d5784;
}
.fz02 {font-size: .2rem}
</style>
