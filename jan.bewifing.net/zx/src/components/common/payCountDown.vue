 <template>
  <section class="payCountDown">
    <div class="btn-details"  v-if="time > 0 && order.pay_status === 0" @click="pay()"><img src="../../assets/img/icon-find.png" class="icons">{{timeValue}}</div>
    <div class="btn-details-gray" v-else @click="pay()"><img src="../../assets/img/icon-img1.png" class="icons">{{timeValue}}</div>
  </section>
</template>

<script>
import { getStamp } from '@/components/common/utils'
export default {
  data () {
    return {
      setIntervalId: null,
      flag: false,
      time: 0,
      timeValue: '查看订单详情'
    }
  },
  props: ['order'],
  mounted () {
    let nowTime = parseInt((new Date().getTime()) / 1000)
    this.time = parseInt(this.order.created_at) + 900 - nowTime
    if (this.time > 0 && this.order.status === 0) {
      let setIntervalId = setInterval(() => {
        if (this.flag === true) {
          clearInterval(setIntervalId)
        }
        this.timeDown()
      }, 1000)
    }
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    timeDown () { // 倒计时
      if (this.time <= 0) {
        this.flag = true
      }
      this.time = this.time - 1
      console.log('~')
    },
    pay () { // 付款/查看详情
      console.log(this.order.ordersn)
      this.$router.push({name: 'orderInfo', query: {ordersn: this.order.ordersn}})
    }
  },
  watch: {
    time: function (value) {
      if (this.time > 0 && this.order.pay_status === 0) {
        this.timeValue = '去支付(还剩' + getStamp(this.time, 'ms') + ')'
      }
    }
  },
  beforeDestroy () {
    clearInterval(this.clearIntervalId)
  }
}
</script>

<style lang="less" scoped>
.icons{
  width: .3rem;
  vertical-align: middle;
}
.btn-details{
  background: #fac287;
  width: 3rem;
  float: right;
  margin-right: .2rem;
  margin-bottom: .2rem;
  text-align: center;
  line-height: .5rem;
  border-radius: .1rem;
}
.btn-details-gray{
  width: 3rem;
  border: 1px solid #fac287;
  float: right;
  margin-right: .2rem;
  margin-bottom: .2rem;
  text-align: center;
  line-height: .5rem;
  border-radius: .1rem;
}
</style>

