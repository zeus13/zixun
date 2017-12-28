 <template>
    <div class="col" v-show="parseInt(shopId) === 2">
      <p v-for="(item,index) in cartGoodsList"><span class="name">{{item.goods_name}}</span> <span class="num">x{{item.num}}</span> <span class="price">￥{{item.actual_price * item.num}}</span></p>
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

