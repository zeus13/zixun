<template>
  <div class="boringIndex">
    <div class="mask"></div>
    <div class="header">
      <div class="header-search">
        <input type="text" class="input-search">
        <div class="div-search">
          <img src="../../assets/img/boring/icon-search2.png" alt="" class="img-search">
          <span>search</span>
        </div>
        <div class="cb"></div>
      </div>
    </div>
    <div class="line"></div>
    <div class="navi-bar">
      <span>精选</span>
      <span>展览</span>
      <span>周边&户外</span>
      <span>演出&赛事</span>
      <span>我的</span>
    </div>
    <div class="list">
      <div class="list-item">
        <div class="item item-left">
          <img src="../../assets/img/boring/img1.png" alt="" class="img-item-left">
        </div>
        <div class="item-right">
          <div class="title">{{ title }}</div>
          <div class="map">
            <img src="../../assets/img/boring/icon-map.png" alt="" class="img-map">
            <div class="map-item">
              南宁国际会展中心D区12号展厅7月7日~9日 10:30~22:30
            </div>
          </div>
          <div class="ticket">
            <img src="../../assets/img/boring/icon-ticket-gray.png" alt="" class="img-ticket">
            <div class="ticket-item">
              0RMB
            </div>
            <img src="../../assets/img/boring/icon-free.png" alt="" class="img-free">
          </div>
        </div>
      </div>
    </div>

    <div class="list">
      <div class="list-item">
        <div class="item item-left">
          <img src="../../assets/img/boring/img2.png" alt="" class="img-item-left">
        </div>
        <div class="item-right">
          <div class="title">{{ title }}</div>
          <div class="map">
            <img src="../../assets/img/boring/icon-map.png" alt="" class="img-map">
            <div class="map-item">
              南宁国际会展中心D区12号展厅7月7日~9日 10:30~22:30
            </div>
          </div>
          <div class="ticket">
            <img src="../../assets/img/boring/icon-ticket-gray.png" alt="" class="img-ticket">
            <div class="ticket-item">
              0RMB
            </div>
            <img src="../../assets/img/boring/icon-free.png" alt="" class="img-free">
          </div>
        </div>
      </div>
    </div>

    <div class="list">
      <div class="list-item">
        <div class="item item-left">
          <img src="../../assets/img/boring/img3.png" alt="" class="img-item-left">
        </div>
        <div class="item-right">
          <div class="title">{{ title }}</div>
          <div class="map">
            <img src="../../assets/img/boring/icon-map.png" alt="" class="img-map">
            <div class="map-item">
              南宁国际会展中心D区12号展厅7月7日~9日 10:30~22:30
            </div>
          </div>
          <div class="ticket">
            <img src="../../assets/img/boring/icon-ticket-gray.png" alt="" class="img-ticket">
            <div class="ticket-item">
              0RMB
            </div>
            <img src="../../assets/img/boring/icon-free.png" alt="" class="img-free">
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  data () {
    return {
      title: '2017中国东盟(国际)|青年文化创意博览会|'
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
.mask {
  width:100%;
  height: 100%;
  background: #CACFD2;
  z-index: -1;
  position: absolute;
  top: 0;
  left: 0;
}
.boringIndex {
  width: 6.4rem;
  height: 100%;
  background: #CACFD2;
}

.cb {
  clear: both;
}

.line {
  border: 0.5px solid #D7DBDD;
}

.title {
  width: 3rem;
  word-wrap: break-word;
  font-size: .3rem;
  position: relative;
  top: 0;
  left: .3rem;
}

.img {
  width: .2rem;
  height: .2rem;
  background-size: 100%;
}

.map {
  position: relative;
  top: 0;
  left: 0;
  font-size: .2rem;
}

.map-item {
  width: 3.2rem;
  position: relative;
  top: -.3rem;
  left: .3rem;
}

.input-search {
  float: left;
  width: 3.8rem;
  height: .3rem;
  outline: none;
  border: none;
  padding: .1rem;
  border-radius: 5px;
}

.header {
  padding: .2rem;
  background: white;
}

.header-search {
  border: 1px solid #311B92;
  border-radius: 5px;
}

.div-search {
  float: right;
  width: 1.5rem;
  text-align: center;
  color: white;
  background: #311B92;
  padding: .1rem;
  font-size: .2rem;
}

.img-search {
  width: .3rem;
  height: .3rem;
  vertical-align: middle;
}

.navi-bar {
  display: flex;
  padding: .1rem .3rem;
  background: white;
}

.navi-bar span {
  flex-grow: 1;
}

.list-item {
  margin: .1rem .1rem;
  background: white;
  height: 2rem;
  position: relative;
  top: 0;
  left: 0;
}

.item {
  float: left;
}

.item-right {
  position: absolute;
  top: 0;
  left: 2.6rem;
}

.img-item-left {
  background-size: 100%;
  width: 2.5rem;
  height: 2rem;
  vertical-align: middle;
}

.img-map {
    width: .2rem;
    height: .2rem;
    vertical-align: middle;
    background-size: 100%;

}

.ticket {
  position: relative;
  top: -.2rem;
  left: 0;
  font-size: .2rem;
}

.ticket-item {
  position: relative;
  top: -.3rem;
  left: .3rem;
}
.img-ticket {
  width: .2rem;
  height: .2rem;
  vertical-align: middle;
  background-size: 100%;
  position: relative;
  top: 0;
  left: 0;
}
.img-free {
  width: 1rem;
  height: .25rem;
  background-size: 100%;
  position: relative;
  top: -0.6rem;
  right: -2.4rem
}

</style>
