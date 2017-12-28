<template>
  <div class="oppoAppealSuccess">
    <div class="div-b">
      <div class="txt">
        <img src="../../assets/img/nike.png" class="img-nike" alt="">
        <div class="f-15" style="font-weight:bold; color: white;">申诉成功</div>
        <div class="f-14" style=" color: white; margin-top: .1rem;">请耐心等待申诉结果…</div>
      </div>
      <div class="btn" @click="close">
        <span>放心的离开</span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {

    }
  },
  methods: {
    close () {
      this.$router.go(-2)
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
.oppoAppealSuccess {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/bg3.png) no-repeat;
  background-size: cover;
  position: absolute;
  z-index: -1;
  text-align: center;
}
.div-b {
  width: 4rem;
  height: 7rem;
  position: absolute;
  left: 50%;
  top: 50%;
  margin: -3rem 0 0 -2rem;
  background: url(../../assets/img/redbag4.png) no-repeat;
  background-size: 100%;
}
div.txt {
  margin-top: 2.4rem;
}

div.btn {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 5rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  color: white;
  padding-top: .1rem;
}

img.img-nike {
  width: .5rem;
  height: .5rem;
}

.f-10 {
  font-size: .1rem;
}
.f-12{
  font-size: .2rem;
}
.f-14 {
  font-size: .3rem;
}
.f-15 {
  font-size: .4rem;
}
</style>
