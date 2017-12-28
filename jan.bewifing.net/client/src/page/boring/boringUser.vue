<template>
  <div class="boringUser">
    <div class="header">
      <div class="header-content">
        <img src="../../assets/img/boring/headimg.jpg" alt="" class="headerimg">
        <div class="name">{{username}}</div>
        <div class="btn-edit">编辑资料</div>
      </div>
    </div>
    <div class="navi">
      <div class="navi-item">
        <img src="../../assets/img/boring/icon-book1.png" alt="" class="navi-img">
        <div>待付款</div>
      </div>
      <div class="navi-item">
        <img src="../../assets/img/boring/icon-book2.png" alt="" class="navi-img">
        <div>待参加</div>
      </div>
      <div class="navi-item">
        <img src="../../assets/img/boring/icon-edit.png" alt="" class="navi-img">
        <div>待评价</div>
      </div>
      <div class="navi-item">
        <img src="../../assets/img/boring/icon-book3.png" alt="" class="navi-img">
        <div>全部订单</div>
      </div>
    </div>
    <div class="line"></div>
    <div class="order-list">
      <div class="order-list-item">
        <img src="../../assets/img/boring/img3.png" alt="" class="order-img">
        <div class="order-title">{{title}}</div>
        <div>
          <img src="../../assets/img/boring/icon-map.png" alt="" class="map-img">
          <div class="order-address">{{address}}</div>
          <div class="cb"></div>
        </div>
      </div>
      <div class="order-list-item">
        <img src="../../assets/img/boring/img3.png" alt="" class="order-img">
        <div class="order-title">{{title}}</div>
        <div>
          <img src="../../assets/img/boring/icon-map.png" alt="" class="map-img">
          <div class="order-address">{{address}}</div>
          <div class="cb"></div>
        </div>
      </div>
      <div class="order-list-item">
        <img src="../../assets/img/boring/img3.png" alt="" class="order-img">
        <div class="order-title">{{title}}</div>
        <div>
          <img src="../../assets/img/boring/icon-map.png" alt="" class="map-img">
          <div class="order-address">{{address}}</div>
          <div class="cb"></div>
        </div>
      </div>
    </div>
    <!-- <div class="divider divider-end">
      <divider>
        <img src="../../assets/img/boring/icon-close1.png" alt="" class="divider-img">
        <span class="divider-txt">END</span>
      </divider>
    </div> -->
  </div>
</template>

<style lang="less" scoped>
@import '../../assets/css/mycss.css';
.header {
  width: 100%;
  height: 3rem;
  background: url('../../assets/img/boring/user-bg.png') no-repeat;
  background-size: 100%;
}
.headerimg {
  width: 1rem;
  border-radius: 50%;
  border: 1px solid white;
  vertical-align: middle;
  margin-top: .5rem;
  margin-left: 2.7rem;
}
.name {
  text-align: center;
  width: 2rem;
  overflow: hidden;
  text-overflow: ellipsis;
  color: white;
  margin-left: 2.2rem; 
  max-width: 2rem;
  white-space: nowrap; 
  padding: .1rem;
}
.btn-edit {
  margin: 0 2.5rem;
  border: 1px solid white;
  color: white;
  font-size: .2rem;
  text-align: center;
  padding: .03rem 0;
  border-radius: 3px;
}
.navi {
  width: 100%;
  display: flex;
  flex-direction: row;
}
.navi-item {
  flex-grow: 1;
  text-align: center;
  line-height: .2rem;
  color: #3b4577;
}
.navi-img {
  width: .5rem;
}
.line {
  width: 100%;
  height: .1rem;
  background: url('../../assets/img/boring/line1.png') no-repeat;
  background-size: 100%;
  margin-top: .1rem; 
}
.order-img {
  width: 100%;

}
.order-list-item {
  margin: .2rem;
  background: white;
}
.order-title {
  font-size: .25rem;
  margin: .1rem .4rem;
}
.order-address {
  font-size: .2rem;
  width: 4rem;
  float: left;
}
.map-img {
  width: .2rem;
  padding: .1rem;
  float: left;
  vertical-align: middle;
}
.divider {
  position: relative;
  bottom: 1rem;
}
.divider-txt {
  font-size: .2rem;
  color: #4d5784;
}
.divider-img {
  width: .15rem;
  vertical-align: middle;
}
.divider-end {
  position: relative;
  top: 0;
}
.cb {clear: both}
.fz02 {font-size: .2rem}
.ml02 {margin-left: .2rem}
</style>


<script>
export default {
  data () {
    return {
      username: '祖嵩松树zusongzues',
      title: '2017中国东盟(国际)|青,年文化创意博览会',
      address: '南宁国际会展中心D区12号展厅 7月7日~9日 10:30~22:30'
    }
  }
}
</script>

