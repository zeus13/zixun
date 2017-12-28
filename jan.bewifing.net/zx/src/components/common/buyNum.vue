 <template>
  <section class="buyNum">
<!--     <section class="add_icon cart_button">
      <transition name="showReduce">
        <span @click="removeOutCart()" v-if="goodsNum">-</span>
      </transition>
      <transition name="fade">
        <span class="cart_num" v-show="goodsNum">
          <p v-if="goods.is_over_sold === 1 || (goods.goods_stock - goodsNum) >= 0">{{goodsNum}}</p>
          <p v-else style="color: red;">{{goodsNum}}</p>
        </span>
      </transition>
      <div class="add_icon" @click="addToCart()">+</div>
    </section> -->
      <transition name="showReduce">
        <div class="minus" @touchstart="removeOutCart()" v-if="goodsNum"></div> 
      </transition>
        <p v-if="goods.is_over_sold === 1 || (goods.goods_stock - goodsNum) >= 0">{{goodsNum}}</p> 
        <p class="red" v-else="">{{goodsNum}}</p>
      <div class="plus" @touchstart="addToCart()"></div>
  </section>
</template>

<script>
import {mapState, mapMutations} from 'vuex'
export default {
  data () {
    return {
      showMoveDot: [] // 控制下落的小圆点显示隐藏
    }
  },
  props: ['goods'],
  mounted () {
  },
  computed: {
    ...mapState([
      'cartList'
    ]),
    /**
     * 监听cartList变化，更新当前商铺的购物车信息shopCart，同时返回一个新的对象
     */
    shopCart: function () {
      return {...this.cartList} // Object.assign({}, this.cartList[this.shopId]) // TODO
    },
    // shopCart变化的时候重新计算当前商品的数量
    goodsNum: function () {
      let catId = this.goods.cat_id
      let goodsId = this.goods.id
      if (this.shopCart && this.shopCart[catId] && this.shopCart[catId][goodsId]) {
        return this.shopCart[catId][goodsId].num
      } else {
        return 0
      }
    }
  },
  methods: {
    ...mapMutations([
      'RECORD_TIME', 'ADD_BUYCART', 'REDUCE_BUYCART'
    ]),
    // 加入购物车，计算按钮位置。
    addToCart () {
      var isCommit = false
      if (this.goods.is_over_sold === 1) { // 允许超卖
        isCommit = true
      } else { // 不允许超卖
        if (this.goodsNum + 1 <= this.goods.goods_stock) {
          isCommit = true
        }
      }
      if (isCommit) {
        this.ADD_BUYCART({goods: this.goods})
        this.RECORD_TIME()
        // let elLeft = event.target.getBoundingClientRect().left
        // let elBottom = event.target.getBoundingClientRect().bottom
        // this.showMoveDot.push(true)
        this.$emit('showMoveDot')
      }
    },
    // 移出购物车
    removeOutCart () {
      if (this.goodsNum > 0) {
        this.REDUCE_BUYCART({goods: this.goods})
        this.RECORD_TIME()
        console.log(this.shopCart)
      }
    },
    // 显示规格列表
    showChooseList (foodScroll) {
      // this.$emit('showChooseList', foodScroll)
    },
    // 点击多规格商品的减按钮，弹出提示
    showReduceTip () {
      // this.$emit('showReduceTip')
    }
  }
}
</script>

<style lang="less" scoped>
.showReduce-enter-active, .showReduce-leave-active {
  transition: all .3s ease-out;
}
.showReduce-enter, .showReduce-leave-active {
  opacity: 0;
  transform: translateX(1rem);
}
.buyNum{
  width: 1.5rem;
  position: absolute;
  right: .15rem;
  top: .1rem;
  text-align: center;
  font-size: .3rem;
  line-height: .4rem;
}
.minus{
  width: .4rem;
  height: .4rem;
  background: url(../../assets/img/minus.png) no-repeat;
  background-size: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
.plus{
  width: .4rem;
  height: .4rem;
  background: url(../../assets/img/plus.png) no-repeat;
  background-size: 100%;
  position: absolute;
  top: 0;
  right: 0;
}
.red{
  color: red;
}
</style>

