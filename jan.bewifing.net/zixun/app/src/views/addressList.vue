<template>
  <section>
    <div class="addresslist">
      <div class="bg-tag" v-show="isEmpty(dispatchList)">你还没有添加收货地址</div>
      
      <div class="address-item" v-for="(item, index) in dispatchList">
        <div class="address-item-hd">
          <span>{{substrFun(item.dispatch_name)}}</span>
          <span class="fr">{{item.dispatch_tel}}</span>
          <p class="mt10">{{item.dispatch_province + item.dispatch_city + item.dispatch_area + item.dispatch_address }}</p>
        </div>
        <div class="address-item-bd">
          <div class="select-options color-3" v-if="item.id === orderNum" @click="setIsdefaultFun(item.id)"> <img class="radio-sty2" src="../assets/img/tick.svg"> 默认地址</div>
          <div class="select-options" v-else @click="setIsdefaultFun(item.id)"> <div class="radio-sty1"></div> 设为默认</div>        
          <div class="edit-btn" @click="goToPage(item.id)">编辑</div>
         <!--  <div class="edit" @click="goToPage(item.id)">删除</div> -->
        </div>
      </div>
      <div class="add-address" @click="goToPage(0)">添加新地址</div>
    </div>

    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>

    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { getAddressList, getAddressDetail } from '../api/getData'
import { Loading } from 'vux'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      showLogin: false, // 是否显示绑定弹窗
      type: '', // 提交类型
      dispatchList: [], // 地址列表
      orderNum: 0 // 是否显示默认地址
    }
  },
  created () {
  },
  mounted () {
    this.fetchData()
    console.log(document.path)
  },
  computed: {
  },
  methods: {
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    },
    substrFun (str) { // 截取前15个字符串
      return str.substr(0, 15)
    },
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    closeLoginFun () { // 关闭绑定弹窗
      this.showLogin = false
    },
    goToPage (val) { // 跳转页面
      this.$router.push({path: prefixUrl + '/addressDetail', query: {dispatch_id: val}})
    },
    setIsdefaultFun (val) { // 设置默认账户
      var self = this
      self.showLoadingText = '提交中'
      self.showLoading = true
      getAddressDetail('default', val).then(response => {
        var data = response.data
        console.log(data)
        if (data.code === 200) {
          if (document.path === '/app/placeOrder') {
            this.$router.go(-1)
          }
          self.openPopupFun('alert', '设置成功', 1)
          self.orderNum = val
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    },
    fetchData () {
      var self = this
      getAddressList().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.dispatchList)) {
            self.dispatchList = data.obj.dispatchList
            self.orderNum = self.dispatchList[0].id
          }
        } else if (data.code === 600) { // 跳往关注界面
          self.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.add-address {
  position: fixed;
  bottom: 0;
  width: 100%;
  background: #d3a543;
  padding: .2rem;
  text-align: center;
  color: white;
}
// .add-address::before {
//   content: '';
//   display: inline-block;
//   width: .23rem;
//   height: .23rem;
//   background: url('../assets/img/plus3.png');
//   background-size: 100%;
//   color: white;
//   margin-right: .1rem;
//   position: relative;
//   top: .01rem;
// }
.bg-tag {
  text-align: center;
  color: #9a9a98;
  margin-top: 1rem;
}
.bg-tag::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background:url('../assets/img/sigh.png');
  background-size: 100%;
  // vertical-align: middle;
  position: relative;
  top: .04rem;
  margin-right: .05rem;

}
/* 新样式 */
.address-item {
  background: white;
  position: relative;
  margin-bottom: .15rem;
}
.address-item-hd {
  padding: .2rem;
  border-bottom: 1px solid #eeeeee;
}
.address-item-bd {
  padding: .1rem .2rem;
  text-align: right;
  position: relative;
  font-size: .2rem;
}
.fr { 
  float: right;
}
.select-options {
  position: absolute;
  left: .2rem;
}
.radio-sty1 {
  width: .28rem;
  height: .28rem;
  border: 1px solid #999;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  overflow: hidden;
  top: .07rem;
}
.radio-sty2 {
  width: .3rem;
  height: .3rem;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  overflow: hidden;
  top: .07rem;
}
.edit-btn {
  display: inline-block;
  width: .9rem;
  border-radius: 5px;
  text-align: center;
  line-height: .45rem;
  background: #d3a543;
  color: #fff;
  margin-left: .2rem;
}
.mt10 {
  margin-top: .1rem;
}
.color-3 {
  color: #d3a543;
}
</style>
