<template class="store">
  <div class="bg">
    <div class="address-box">
      <div class="row-code clearfix">
        <img src="../assets/img/aimaspa/code1.jpg" class="code">
        <div class="row-code-right">
          <div class="text">一店：古城路33号地震局商住楼1单元13楼,古城路33号地震局商住楼1单元13楼,古城路33号地震局商住楼1单元13楼</div>
          <div>电话：<a class="tel" v-bind:href="'tel:'+ '18376648488'">18376648488</a></div>
        </div>
      </div>
      <div class="row-code clearfix">
        <img src="../assets/img/aimaspa/code2.jpg" class="code">
        <div class="row-code-right">
          <div class="text">二店：越秀路倚林家园7栋2单元101室</div>
          <div>电话：<a class="tel" v-bind:href="'tel:'+ '18577089949'">18577089949</a></div>
        </div>
      </div>
      <div class="row-code clearfix">
        <img src="../assets/img/aimaspa/code3.jpg" class="code">
        <div class="row-code-right">
          <div class="text">三店：长湖路龙光君御华府6栋 1903室</div>
          <div>电话：<a class="tel" v-bind:href="'tel:'+ '18577095844'">18577095844</a></div>
        </div>
      </div>
      <div class="row-code clearfix">
        <img src="../assets/img/aimaspa/code4.jpg" class="code">
        <div class="row-code-right">
          <div class="text">度妍美学培训</div>
          <div>电话：<a class="tel" v-bind:href="'tel:'+ '15078822247'">15078822247</a></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
</script>

<style>
@improt '../assets/css/base.css';
.bg {
  width: 100%;
  height: 100%;
  background: url('../assets/img/aimaspa/bg-stroe.png');
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  color: #d2bf97;
  font-size: .24rem;
}
.address-box {
  margin-top: .8rem;
}
.row-code {
  padding: .25rem 0rem.25rem.4rem;
  margin: 0 .2rem;
  border-bottom: 1px dashed #d2bf97;
}
.code {
  width: 1.2rem;
  height: 1.2rem;
  float: left;
}
.row-code-right {
  float: left;
  width: 3.8rem;
  margin-left: .4rem;
}
.text {
  min-height: .8rem;
  max-height: 1.1rem;
  overflow: hidden;
  text-overflow: ellipsis;
}
.tel {
  color: #d2bf97;
}
</style>
