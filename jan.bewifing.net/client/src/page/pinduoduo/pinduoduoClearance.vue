<template>
  <div class="pinduoduoClearance">
    <div class="navi-bar">
      <div class="chosen-swiper">
        <router-link to="pinindex">首页</router-link>
        <a href="">家纺疯抢</a>
        <a href="">女装</a>
        <a href="">男装</a>
        <a href="">食品</a>
        <a href="">家纺</a>
        <a href="">电器</a>
        <a href="">家居</a>
        <a href="">美妆</a>
        <a href="">母婴</a>
      </div>
    </div>
    <div class="content">
      <div class="content-head"><img src="../../assets/img/pinduoduo/flash-p.png" alt="" class="icon">
        <span class="mt-01">每日疯抢</span>
      </div>
      <div class="goods-row">
        <div class="goods-row-item-title">
          <span>1</span>
          <span>2</span>
          <span>3</span>
          <span>4</span>
          <span>5</span>
          <span>6</span>
          <span>7</span>
          <span>8</span>
        </div>
        <div class="goods-row-item">
          <div>1</div>
          <div>2</div>
          <div>3</div>
          <div>4</div>
          <div>5</div>
          <div>6</div>
          <div>7</div>
          <div>8</div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  data () {
    return {
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.content-head {
  text-align: center;
  background: white;
  padding: .2rem;
  color: #e02e24;
  font-size: .28rem;
  border-bottom: 1px solid #f0f0f0;
}
.content {
  margin-top:.8rem;
  margin-bottom: 1rem;
}
.icon {
  width: .4rem;
  vertical-align: middle;
  margin-top: -.1rem;
  margin-right:.1rem;
}
.goods-row-item-title {
  width: 100%;;
  height: .5rem;
  border: 1px solid red;
  position: fixed;
}
.goods-row-item div {
  width: 1rem;
  height: 5rem;
}

</style>
