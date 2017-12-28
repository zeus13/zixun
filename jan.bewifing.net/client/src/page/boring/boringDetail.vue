<template>
  <div class="boringDetail">
    <div class="mask"></div>
    <div class="div-box">
      <img src="../../assets/img/boring/img3.png" alt="" class="img-header">
      <div class="txt fs026">
        <span class="title">{{title}}</span>
        <div class="img-right"></div>
      </div>
      <div class="box fs02">
        <img src="../../assets/img/boring/icon-map.png" alt="img-map" class="img-map">
        <div class="map-item">南宁国际会展中心D区12号展厅 7月7日~9日 10:30~22:30</div>
      </div>
       <div class="ticket">
         <div class="ticket-item">
          <img src="../../assets/img/boring/icon-free.png" alt="free" class="img-free">
          <img src="../../assets/img/boring/icon-ticket-gray.png" alt="" class="img-ticket">
          <span>{{price}}RMB</span>
        </div>
      </div> 
    </div>
    <div class="div-box marginUp">
      <div class="join">
        <div class="fl">
          <img src="../../assets/img/boring/icon-user-blue.png" alt="" class="img-user">
          <img src="../../assets/img/boring/icon-user-blue.png" alt="" class="img-user">
          <img src="../../assets/img/boring/icon-user-blue.png" alt="" class="img-user">
        </div>
        <span class="fs026 fl">他们都参加了</span>
        <div class="cb"></div>
      </div>
    </div>

     <div class="div-box">
      <div class="row"><span class="ml02">活动详情</span></div>
      <div class="line"></div>
      <div>1111111111111 </div>
    </div> 

  </div>
</template>
<style lang="less" scoped>
@import '../../assets/css/mycss.css';
.mask {
  width: 100%;
  height: 100%;
  background: #CACFD2;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}

.cb {
  clear: both;
}

.div-box {
  // margin: .2rem;
  position: relative;
  top: 0;
  left: 0;
  background: white;
}

// div.header {
//   width: 100%;
//   background: white;
// }

.img-header {
  width: 100%;
  height: 3rem;
  background-size: 100%;
}

.txt {
  width: 100%;
  height: .4rem;
  position: relative;
  top: 0;
  left: 0;
}

.title {
  margin: 0 .4rem;
  width: 3rem;
  font-weight: bold;
}

.img-right {
  background: url(../../assets/img/boring/goRight.png) no-repeat;
  width: .3rem;
  height: .3rem;
  background-size: 100%;
  vertical-align: middle;
  position: relative;
  top: -.35rem;
  left: 5.58rem;
}
.box {
  height: .7rem;
  position: relative;
  top: 0;
  left: 0;
}
.map-item {
  width: 5rem;
  position: relative;
  top: -.35rem;
  left: .4rem;
}
.img-map {
  width: .2rem;
  height: .2rem;
  margin-left: .1rem;
}
.ticket {
  position: relative;
  top: 0;
  left: 0;
  height: .4rem;
}
.ticket-item {
  float: right;
  margin-right: .2rem;
}
.img-free {
  width: .6rem;
  height: .2rem;
  margin-left: .1rem;
}

.img-ticket {
  width: .2rem;
  height: .2rem;
  margin-left: .1rem;
}

.join {
  padding: .2rem;
}

.img-user {
  width: .25rem;
  height: .25rem;
  vertical-align: middle;
}
.line {
  border: 0.5px solid rgba(215, 219, 221, 0.2);
}
.ml02 {
	margin-left: 0.2rem;
}
.marginUp {
  margin: 0.2rem 0;
}
</style>

<script>
export default {
  data () {
    return {
      title: '2017中国东盟(国际)|青年文化创意博览会|',
      price: '1000000'
    }
  }
}
</script>
