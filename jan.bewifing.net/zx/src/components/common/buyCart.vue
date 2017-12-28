 <template>
  <section class="buyCart">
    <section class="add_icon cart_button">
      <transition name="showReduce">
        <span @touchstart="removeOutCart()" v-if="goodsNum">-</span>
      </transition>
      <transition name="fade">
        <span class="cart_num" v-show="goodsNum">
          <p v-if="goods.is_over_sold === 1 || (goods.goods_stock - goodsNum) >= 0">{{goodsNum}}</p><!-- 库存充足 -->
          <p v-else style="color: red;">{{goodsNum}}</p><!-- 库存不足红色 -->
        </span>
      </transition>
      <div class="add_icon" @touchstart="addToCart()">+</div>
    </section>
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
  props: ['goods', 'shopId'],
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
      return {...this.cartList[this.shopId]} // Object.assign({}, this.cartList[this.shopId]) // TODO
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
      'ADD_CART', 'REDUCE_CART'
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
        this.ADD_CART({shop_id: this.shopId, goods: this.goods})
        // let elLeft = event.target.getBoundingClientRect().left
        // let elBottom = event.target.getBoundingClientRect().bottom
        // this.showMoveDot.push(true)
        this.$emit('showMoveDot')
        console.log(this.shopCart)
      }
    },
    // 移出购物车
    removeOutCart () {
      if (this.goodsNum > 0) {
        this.REDUCE_CART({shop_id: this.shopId, goods: this.goods})
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

<style lang="less">
.buyCart{
  .add_icon{
      position: relative;
      z-index: 999;
      font-size: 50px;
  }
  .cart_button{
      display: flex;
      align-items: center;
  }
  svg{
      @include wh(.9rem, .9rem);
      fill: #3190e8;
  }
  .specs_reduce_icon{
      fill: #999;
  }
  .cart_num{
      @include sc(.65rem, #666);
      min-width: 1rem;
      text-align: center;
      font-family: Helvetica Neue,Tahoma;
  }


  .showReduce-enter-active, .showReduce-leave-active {
    transition: all .3s ease-out;
  }
  .showReduce-enter, .showReduce-leave-active {
    opacity: 0;
    transform: translateX(1rem);
  }
  .fade-enter-active, .fade-leave-active {
    transition: all .3s;
  }
  .fade-enter, .fade-leave-active {
    opacity: 0;
  }
  .fadeBounce-enter-active, .fadeBounce-leave-active {
    transition: all .3s;
  }
  .fadeBounce-enter, .fadeBounce-leave-active {
    opacity: 0;
    transform: scale(.7);
  }
}
</style>

