<template>
  <div class="test">
    <p style="font-size: .5rem">距离暗黑3第十一赛季开赛：{{time}}</p>
  </div>
</template>
<script>
export default {
  data () {
    return {
      time: '',
      endTime: '2017/7/20 17:00:00'
    }
  },
  mounted () {
    let self = this
    let time = setInterval(() => {
      if (self.flag) {
        self.time = '0:0:0'
        console.log('1===>' + self.time)
        clearInterval(time)
        return false
      }
      self.timeDown()
    }, 1000)
  },
  methods: {
    timeDown () {
      const endTime = new Date(this.endTime).getTime()
      const nowTime = new Date().getTime()
      let leftTime = parseInt((endTime - nowTime) / 1000)
      let h = this.formate(parseInt(leftTime / (60 * 60) % 24))
      let m = this.formate(parseInt(leftTime / 60 % 60))
      let s = this.formate(parseInt(leftTime % 60))
      if (leftTime <= 0) {
        this.flag = true
        // this.$emit('time-end')
        alert('暗黑3第11赛季开始啦')
        return false
      }
      this.time = h + ':' + m + ':' + s
      // this.time = `${d}天${h}小时${m}分${s}秒`
      console.log('2====>' + this.time)
    },
    formate (time) {
      if (time >= 10) {
        return time
      } else {
        return '0' + time
      }
    }
  }
}
</script>

<style lang="less">

</style>
