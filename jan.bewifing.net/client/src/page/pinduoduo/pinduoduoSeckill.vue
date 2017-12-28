<template>
  <div class="Seckill">
    <div class="time-line pt02">
      <div class="time-icon-current"></div>
      <div class="time_axis time_axis-current"><span class="time_axis-current-txt">11:00正在进行中</span></div>
    </div>
    <div class="goodsList">
      <div class="goodsList-item">
        <img src="http://omsproductionimg.yangkeduo.com/images/2017-07-24/bfc2d625dc2fb4f445d53a7391b04d8e.jpeg" alt="" class="goodsList-item-img">
        <div class="goodsList-item-right">
          <div class="goodsList-item-right-title">新款特价npc03男韩版黑色百搭休闲时尚潮流工作鞋灰色学生鞋网鞋飞织一脚蹬潮鞋夏季鞋子超透气男士板鞋运动鞋男鞋</div>
          <div class="row">
            <div class="progressbar">进度条</div>
            <span class="progressbar-txt">已抢409件</span>
          </div>
          <div class="goodsList-item-right-bottom">
            <div class="price"><span>￥13.9</span><span>￥69</span></div>
            <div class="btn btn-current"></div>
          </div>
        </div>
      </div>
      <div class="goodsList-item">
        <img src="http://omsproductionimg.yangkeduo.com/images/2017-07-24/bfc2d625dc2fb4f445d53a7391b04d8e.jpeg" alt="" class="goodsList-item-img">
        <div class="goodsList-item-right">
          <div class="goodsList-item-right-title">新款特价npc03男韩版黑色百搭休闲时尚潮流工作鞋灰色学生鞋网鞋飞织一脚蹬潮鞋夏季鞋子超透气男士板鞋运动鞋男鞋</div>
          <div class="row">
            <div class="progressbar">进度条</div>
            <span class="progressbar-txt">已抢409件</span>
          </div>
          <div class="goodsList-item-right-bottom">
            <div class="price"><span>￥13.9</span><span>￥69</span></div>
            <div class="btn btn-current"></div>
          </div>
        </div>
      </div>
      <div class="goodsList-item">
        <img src="http://omsproductionimg.yangkeduo.com/images/2017-07-24/bfc2d625dc2fb4f445d53a7391b04d8e.jpeg" alt="" class="goodsList-item-img">
        <div class="goodsList-item-right">
          <div class="goodsList-item-right-title">新款特价npc03男韩版黑色百搭休闲时尚潮流工作鞋灰色学生鞋网鞋飞织一脚蹬潮鞋夏季鞋子超透气男士板鞋运动鞋男鞋</div>
          <div class="row">
            <div class="progressbar">进度条</div>
            <span class="progressbar-txt">已抢409件</span>
          </div>
          <div class="goodsList-item-right-bottom">
            <div class="price"><span>￥13.9</span><span>￥69</span></div>
            <div class="btn btn-current"></div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="isNext">
    <div class="time-line">
      <div class="time-icon-next"></div>
      <div class="time_axis time_axis-next" style="height: .4rem;"><span class="time_axis-current-txt">11:00正在进行中</span></div>
    </div>
    <div class="goodsList goodsList-next">
      <div class="goodsList-item">
        <img src="http://omsproductionimg.yangkeduo.com/images/2017-09-15/87a7b4d01a3f60da04e46e8b1367e3af.jpeg" alt="" class="goodsList-item-img">
        <div class="goodsList-item-right">
          <div class="goodsList-item-right-title">【五件套】不锈钢盆 加厚味斗菜盆漏盆洗菜盆淘米盆和面盆米筛盆</div>
          <div class="row">
            <div class="progressbar">进度条</div>
            <span class="progressbar-txt">已抢409件</span>
          </div>
          <div class="goodsList-item-right-bottom">
            <div class="price"><span>￥13.9</span><span>￥69</span></div>
            <div class="btn btn-current"></div>
          </div>
        </div>
      </div>
      <div class="goodsList-item">
        <img src="http://omsproductionimg.yangkeduo.com/images/2017-09-07/17a634dc997fbcd5095cb87bfb4dcf5a.jpeg" alt="" class="goodsList-item-img">
        <div class="goodsList-item-right">
          <div class="goodsList-item-right-title">赤道鸟冬季电动车挡风衣加大加厚保暖电摩护膝冬季摩托车护腿挡风衣</div>
          <div class="row">
            <div class="progressbar">进度条</div>
            <span class="progressbar-txt">已抢409件</span>
          </div>
          <div class="goodsList-item-right-bottom">
            <div class="price"><span>￥13.9</span><span>￥69</span></div>
            <div class="btn btn-current"></div>
          </div>
        </div>
      </div>
      <div class="goodsList-item">
        <img src="http://omsproductionimg.yangkeduo.com/images/2017-09-15/4efd36002360accb400d7903bb689793.jpeg" alt="" class="goodsList-item-img">
        <div class="goodsList-item-right">
          <div class="goodsList-item-right-title">一片式无痕内衣文胸无钢圈聚拢胸罩性感小胸少女</div>
          <div class="row">
            <div class="progressbar">进度条</div>
            <span class="progressbar-txt">已抢409件</span>
          </div>
          <div class="goodsList-item-right-bottom">
            <div class="price"><span>￥13.9</span><span>￥69</span></div>
            <div class="btn btn-current"></div>
          </div>
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
      isNext: true
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.Seckill {
  width: 100%;
  height: auto;
  position: absolute;
  top: 0;
  left: 0;
  background: white;
}
.tag {
  width: 100px;
  height: 100px;
  border-top-left-radius: 70%;
  border-bottom-left-radius: 70%;
  border: 1px solid red;
}
.time-line {
  width: 100%;
  position: relative;
}
.time-icon-current {
  background: url('../../assets/img/pinduoduo/flash-r.png');
  width: .38rem;
  height: .38rem;
  background-size: 100%;
  position: absolute;
  top: .25rem;
  left: .05rem; 
}
.time-icon-next {
  background: url('../../assets/img/pinduoduo/flash-y.png');
  width: .38rem;
  height: .38rem;
  background-size: 100%;
  position: absolute;
  top: .05rem;
  left: .05rem;
}

.time_axis {
  background: url('../../assets/img/pinduoduo/spike_button_label.png');
  width: 2.5rem;
  height: .5rem;
  background-size: 100%;
  margin-left: .55rem;
  text-align: center;
  font-size: .23rem;
  line-height: .55rem;
}
.time_axis-current {
  background-position: 100% -.45rem;
}
.time_axis-next {
  background-position: 100% 0;
  line-height: .45rem;
}
.time_axis-current-txt {
  margin-left: -.3rem;
}
.goodsList {
  margin-left: .2rem;
  border-left: 1px solid red;
  padding-bottom: .2rem;
  z-index: 5;
}
.goodsList-next {
  z-index: 4;
  border-left: 1px solid #fcdd8c;
}
.goodsList-item {
  margin: .1rem .2rem;
  padding: .1rem .1rem .2rem .1rem;
  position: relative;
  border-bottom: 1px solid rgba(119, 119, 119, 0.2);
  font-size: .23rem;
}
.goodsList-item-img {
  width: 2rem;
}
.goodsList-item-right {
  position: absolute;
  top: 0;
  left: 2.3rem;
  width: 3.6rem;
}
.goodsList-item-right-title {
  width: 3.5rem;
  height: .7rem;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-top: .15rem;
}
.row {
  margin-top: .2rem;
}
.progressbar {
  display: inline;
}
.progressbar-txt {
  margin-left: 1rem;
  width: 1rem;
  max-width: 1rem;
  overflow: hidden;
}
.goodsList-item-right-bottom {
  position: relative;
  bottom: .1rem;
}
.btn {
  background: url('../../assets/img/pinduoduo/spike_button_label.png');
  width: 1.2rem;
  height: .6rem;
  background-size: 200%;
  /* margin-left: .5rem; */
  text-align: center;
  font-size: .23rem;
  line-height: .55rem;

}
.price {
  position: relative;
  top: .4rem;
  left: 0;
}
.btn-current {
  background-position: 0rem -1.45rem;
  position: relative;
  top: -.1rem;
  left: 2.2rem;
}
.pt02 {
  padding-top: .2rem;
}
</style>
