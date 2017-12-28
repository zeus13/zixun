<template>
  <div class="address">

    <div class="head">
      <div class="address-empty"></div>
    </div>
    <div class="btn-add" @click="addAddress">
      <span>手动添加</span>
    </div>
    <div class="masklayer" v-show="isMaskLayer">
      <div class="popup-address">
        <div class="address-box">
          <div class="address-box-title">添加新收货地址</div>
          <div class="address-receiver">
            <div class="address-receiver-item" style="border-right: 1px solid rgba(119, 119, 119, 0.2);"><input type="text" placeholder="名字"></div>
            <div class="address-receiver-item"><input type="text" name="" id="" placeholder="电话"></div>
          </div>
          <div class="input-address">
            <textarea name="" id="" placeholder="详细地址（可填写街道、小区、大厦）"></textarea>
          </div>
          <div class="btn-save">保存</div>
          <div class="close" @click="close"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      isMaskLayer: false
    }
  },
  methods: {
    addAddress () {
      this.isMaskLayer = true
      this.isPopup = true
    },
    close () {
      this.isMaskLayer = false
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/pinduoduo.css';
.close{
  width: .5rem;
  height: .5rem;
  background: url('../../assets/img/pinduoduo/address.png') no-repeat;
  background-size: 3.5rem;
  background-position: -2.67rem 0rem;
  position: relative;
  top: -4.8rem;
  left: 5.3rem;
}
.btn-save {
  text-align: center;
  margin: .2rem;
  padding: .2rem;
  background: rgba(119, 119, 119, 0.2);
  border-radius: 5px;
  color: white;
  font-size: .3rem;
}

.input-address {
  padding: .4rem .2rem .2rem .2rem;
  border-bottom: 1px solid rgba(119, 119, 119, 0.2);
}

.input-address textarea {
  width: 100%;
  font-size: .25rem;
  border: none;
  outline: none;
  resize: none;
  height: 1rem;
  overflow-x: scroll;
}

.address-receiver {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  border-bottom: 1px solid rgba(119, 119, 119, 0.2);
}

.address-receiver-item {
  flex-grow: 1;
  padding: .2rem;
  font-size: .25rem;
}

.address-receiver-item input {
  width: 80%; // padding: .2rem 0 .2rem .2rem;
  border: none;
  outline: none;
  background: white;
  color: #d2d2d2;
}

.address-box-title {
  text-align: center;
  padding: .2rem;
  border: 1px solid rgba(119, 119, 119, 0.2);
}

.address-box {
  margin: .4rem;
  background: white;
  padding-bottom: .1rem;
  position: relative;
  top: .1rem;
  left: 0;
  border-radius: 5px;
}

.masklayer {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.79);
  z-index: 5;
}

.head {
  width: 100%;
  height: 1.5rem;
  background: white;
}

.address-empty {
  width: 1.1rem;
  height: 1.1rem;
  background: url('../../assets/img/pinduoduo/address.png') no-repeat;
  background-size: 2.5rem;
  background-position: .05rem 0;
  position: relative;
  top: .2rem;
  left: 50%;
  margin-left: -.65rem;
}

.btn-add {
  margin: .2rem;
  padding: .2rem;
  text-align: center;
  background: #e02e24;
  color: white;
  border-radius: 5px;
}

.btn-add span::before {
  content: '✚';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  color: #e02e24;
  background: white;
  font-weight: bold;
  border-radius: 3px;
  margin-right: .1rem;
  position: relative;
  top: .03rem;
}

a,
button,
input,
optgroup,
select,
textarea {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
</style>
