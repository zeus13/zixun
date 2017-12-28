<template>
  <div class="boringUserEdit">
    <div class="header">
      <div class="myheader">我的头像</div>
      <div class="img"><img src="../../assets/img/404.jpg" alt="" class="header-img"></div>
      <div class="cb"></div>
    </div>
    <div class="line"></div>
    <div class="body">
      <div class="rows">
        <span class="rows-left">昵称</span>
        <input type="text" class="input" placeholder="请填写昵称" >
      </div>
      <div class="rows"></div>
      <div class="rows"></div>
    </div>
  </div>
</template>·

<script>
export default {
  data () {
    return {
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/mycss.css';
.header {
  width: 100%;
  padding: .2rem;
  background: white;
  line-height: .6rem;
  color: #4d5784;
}
.myheader {
  float: left;
}
.header-img {
  width: .6rem;
  height: .6rem;
  border-radius: 50%;
  float: right;
  margin-right: .4rem;
}
.header::after {
  content: '';
  width: .2rem;
  height: .2rem;
  border-right: 1px solid #4d5784;
  border-bottom: 1px solid #4d5784;
  transform: rotate(-45deg);
  float: right;
  margin-top: -.35rem;
  margin-right: .1rem;
}
.line {
  width: 100%;
  height: .1rem;
  background: url('../../assets/img/boring/line1.png') no-repeat;
  background-size: 100%;
}
.body {
  background: white;
  margin: .5rem 0 0 0;
  font-size: .25rem;
  position: relative;
}
.rows {
  line-height: .8rem;
  padding: 0 .4rem;
  border-bottom: 1px solid #f7f7f7;
}
.rows-left {
  position: absolute;
  top: 0;
  z-index: 2;
}
.input {
  text-align: right;
  width: 100%;
  height: .8rem;
  outline: none;
  border: none;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 3;
  padding-right: .2rem; 
}
.cb{clear: both}

</style>

