<template>
  <section class="xLoading">
    <div class="black-mask">
      <div class="xLoading-box">
        <img src="../../assets/img/loading.svg">
        <p>加载中...</p>
      </div>
    </div>
  </section>
</template>

<script>
export default {
}
</script>
<style lang="less" scoped>
.xLoading{
  width: 100%;
  height: 100%;
  background: #fff;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 19940303;
}
.black-mask {
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, .5);
  position: absolute;
  top: 0; 
  left: 0;
  display:table;
}
.xLoading-box {
  display:table-cell;
  vertical-align:middle;
  text-align:center;
  color: #fff;
  font-size: 12px;
}
.xLoading-box img {
  width: 50px;
  vertical-align: middle;
}
</style>
