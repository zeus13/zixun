 <template>
    <div class="delivery thin">
      <div class="delivery-item"><span class="tips">满88元免配送费</span><span class="name"><img class="icons" src="../../assets/img/icon-money.png"> 配送费</span> <span class="num">￥0.00</span></div>
      <div class="delivery-item"><span><img class="icons" src="../../assets/img/icon-ring-gray.png" > 到店自提</span> <span class="num">￥0.00</span></div>
    </div>
</template>

<script>
import { getStamp } from '@/components/common/utils'
export default {
  data () {
    return {
    }
  },
  props: ['cartGoodsList', 'shopId'],
  mounted () {
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    }
  },
  watch: {
  }
}
</script>

<style lang="less" scoped>
.col{
  padding-left: .3rem;
  padding-right: .2rem;
  line-height: .5rem;
  padding-top: .1rem;
  padding-bottom: .1rem;
}
.col p {
  display: inline-flex;
}
.col .name{
  width: 3.8rem;
  display: inline-block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.col .num{
  width: .7rem;
  display: inline-block;
}
.col .price{
  display: inline-block;
  width: 1.4rem;
  text-align: right;
}
</style>

