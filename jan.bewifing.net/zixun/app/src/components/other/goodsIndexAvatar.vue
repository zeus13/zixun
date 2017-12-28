<template>
    <div class="div-inline buyer">
      <img :src="item" alt="" class="icon-2" v-for="(item,index) in avatarList">
    </div>
</template>
<script>
export default {
  props: ['avatars'],
  data () {
    return {
      avatarList: ['http://qiniu.bewifing.com/cys20170816.png', 'http://qiniu.bewifing.com/cys20170816.png', 'http://qiniu.bewifing.com/cys20170816.png', 'http://qiniu.bewifing.com/cys20170816.png', 'http://qiniu.bewifing.com/cys20170816.png']
    }
  },
  created () {
    for (var i = 0; i < this.avatars.length; i++) {
      this.avatarList[i] = this.avatars[i].member_avatar
    }
  },
  mounted () {
  },
  computed: {
  },
  methods: {
  },
  watch: {
  }
}
</script>

<style lang="less" scoped>
.div-inline {
  display: inline-block;
}
.buyer {
  width: 2rem;
  margin-right: -.4rem;
}
.icon-2 {
  height: .4rem;
  vertical-align: middle;
  margin-left: -.12rem;
  border-radius: 50%;
}
</style>
