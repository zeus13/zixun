 <template>
  <section class="spec">
    <div class="vux-selector weui-cell weui-cell_select weui-cell_select-after ">
      <div class="weui-cell__hd">
        <label for="vux-selector-ppx1s" class="weui-label"><img src="../../assets/img/aimaspa/icon27.png" class="icon2">{{spec.name}}</label>
      </div> 
      <div class="weui-cell__bd">
        <select id="vux-selector-ppx1s" ddd="" class="weui-select" v-model="spec_id">
          <option v-for="(i,j) in spec.goods_specs" :key="j" :value="i.id">{{i.name + '(' + i.price / 100 + ')'}}</option> 
        </select>
      </div>
    </div>
  </section>
</template>

<script>
import { isEmpty, getStamp } from '../../utils/utils'
import { Selector } from 'vux'
export default {
  components: {
    Selector
  },
  data () {
    return {
      spec_id: 0,
      totalPriceTemp: 0
    }
  },
  props: ['spec', 'totalPrice', 'index'],
  mounted () {
    console.log(this.totalPrice)
    this.totalPriceTemp = this.totalPrice
  },
  computed: {
  },
  methods: {
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    }
  },
  watch: {
    spec_id: function (value, value1) {
      var price = 0
      var price1 = 0
      for (var i = this.spec.goods_specs.length - 1; i >= 0; i--) {
        if (this.spec.goods_specs[i].id === value) {
          price = this.spec.goods_specs[i].price
        }
        if (this.spec.goods_specs[i].id === value1) {
          price1 = this.spec.goods_specs[i].price
        }
      }
      this.totalPriceTemp = this.totalPriceTemp + price - price1
      this.$emit('showSpec', this.totalPriceTemp, this.index, this.spec_id)
    },
    totalPrice: function (value) {
      this.totalPriceTemp = value
      console.log('totalPriceTemp')
      console.log(this.totalPriceTemp)
    }
  },
  beforeDestroy () {
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
.number {
  display: inline-block;
  padding: .2rem;
}
.textara-row {
  display: inline;
}
.message {
  width: 1.8rem;
  line-height: .5rem;
  display: inline;
}
.message::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../../assets/img/aimaspa/icon9.png');
  background-size: 100%;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
  margin-right: .1rem;
}
.textara-box {
  margin: .2rem;
  border: 1px solid #d2bf97;
  border-radius: 5px;
  background: white;
}
.icon {
  width: .4rem;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
}
.icon2 {
  width: .3rem;
  height: .3rem;
  vertical-align: middle;
  position: relative;
  top: -.05rem;
  margin-right: .1rem;
}
.list {
  margin-top: .2rem;
  background: white;
}
.list-item {
  padding: .2rem;
  line-height: .5rem;
  border-bottom: 1px solid #d2bf97;
  color: #9a8d70;
}
.list-item-input {
  padding: .2rem;
  line-height: .5rem;
  border-bottom: 1px solid #d2bf97;
  color: #9a8d70;
  position: relative;
}
.input-left {
  position: absolute;
  top: .2rem;
}
.input {
  width: 100%;
  padding-left: 1.5rem;
  outline: none;
  border: none;
}
.list-item::after {
  content: '';
  display: inline-block;
  width: .2rem;
  height: .2rem;
  border-right: 1px solid #d2bf97;
  border-bottom: 1px solid #d2bf97;
  transform: rotate(-45deg);
  margin-right: .1rem;
  margin-top: .15rem;
  float: right;
}
.list-item-right {
  display: inline-block;
  width: 2rem;
  text-align: right;
  margin-left: 2.2rem;
}
.row-left {
  width: 1.2rem;
  height: 1.2rem;
}

.row {
  padding: .3rem .2rem;
  position: relative;
  background: white;
}
.row-content {
  position: absolute;
  top: .2rem;
  left: 1.6rem;
  line-height: .5rem;
}
.row-right {
  position: absolute;
  top: 1rem;
  left: 4.8rem;
}
.head {
  width: 100%;
  padding: .2rem;
  background: #948d87;
  color: white;
  line-height: .5rem;
  position: relative;
}
.head::after {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  border-right: 1px solid white;
  border-bottom: 1px solid white;
  transform: rotate(-45deg);
  position: absolute;
  top: .8rem;
  right: .4rem;
}
.address {
  width: 5.4rem;
  padding-left: .3rem;
}
.address-box::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../../assets/img/aimaspa/icon23.png');
  background-size: 100%;
  vertical-align: middle;
  position: absolute;
  top: .8rem;
  margin-right: .1rem;
}
.foot {
  position: fixed;
  bottom: 0;
  width: 100%;
  display: flex;
  flex-direction: row;
  line-height: .5rem;
  font-size: .28rem;
}
.foot-item-left {
  flex-grow: 2;
  background: #d2bf97;
  padding: .2rem;
}
.foot-item-right {
  flex-grow: 1;
  text-align: center;
  background: black;
  color: #d2bf97;
  padding: .2rem;
}
.title {
  width: 4.5rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-weight: bolder;
}
.ml-03 {margin-left: .3rem;}
.fs-028 {font-size:.28rem;}
.fw {font-weight: bolder;}

</style>
<style lang="less">
.spec .weui-cell__hd{
  color: #9a8d70 !important;
}
.spec .weui-cell:before{
  border-top:2px solid #d2bf97 !important;

}
.spec .weui-cells:before{
  border-top:2px solid #d2bf97 !important;
}
.spec .weui-cells:after{
  border-top:2px solid #d2bf97 !important;
}
.spec .vux-selector.weui-cell_select-after{
  // padding: 10px 0 10px 15px !important;
}
.spec .weui-cell_select .weui-cell__bd:after{
    height: 12px;
    width: 12px;
    border-color: #d2bf97;
    // content: '';
    // display: inline-block;
    // width: .2rem;
    // height: .2rem;
    // border-right: 1px solid #d2bf97;
    // border-bottom: 1px solid #d2bf97;
    // -webkit-transform: rotate(-45deg);
    // transform: rotate(-45deg);
    // margin-right: .1rem;
    // margin-top: .15rem;
    // float: right;
}
.spec .vux-x-input{
  // padding: 20px 15px;
}
.spec .weui-select{
  color: #9a8d70 !important;
}
.spec .weui-cell_select-after .weui-select {
  padding-left: 2rem;
}
</style>

