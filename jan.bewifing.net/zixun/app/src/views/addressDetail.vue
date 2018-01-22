<template>
  <section>

    <div class="address-detail">
      <div class="content">
        <div class="rows">
          <div class="rows-left">联系人</div>
          <input type="text" placeholder="姓名" class="input" v-model="dispatch.dispatch_name">
        </div>
        <div class="rows">
          <div class="rows-left">电话</div>
          <input type="tel" maxlength="11" placeholder="收货人电话" class="input" v-model="dispatch.dispatch_tel">
        </div>
        <div class="rows">
           <div class="rows-address-left">地址</div> 
           <select class="selected" :class="{'gray-c': dispatch.dispatch_province === ''}" v-model="dispatch.dispatch_province" @change="selectSfun(dispatch.dispatch_province)">
              <option disabled  selected="selected" value="">请选择省份</option>
              <option v-for="(item,index) in provinceList" :key="index" >{{item.name}}</option>
           </select>
           <div class="rows-rightarrow"></div>
          <div class="cb"></div>
        </div>
        <div class="rows" style="padding-left: 1.2rem">
           <select class="selected" :class="{'gray-c': dispatch.dispatch_city === ''}" v-model="dispatch.dispatch_city" @change="selectStoreAddr(dispatch.dispatch_city)">
              <option disabled  selected="selected" value="">请选择市</option>
              <option v-for="(item,index) in cityList" :key="index">{{item.name}}</option>
           </select>
           <div class="rows-rightarrow"></div>
          <div class="cb"></div>
        </div>
        <div class="rows" style="padding-left: 1.2rem">
           <select class="selected" :class="{'gray-c': dispatch.dispatch_area === ''}" v-model="dispatch.dispatch_area">
              <option disabled  selected="selected" value="">请选择区/县</option>
              <option v-for="(item,index) in areaList" :key="index">{{item}}</option>
           </select>
           <div class="rows-rightarrow"></div>
          <div class="cb"></div>
        </div>
        <div class="rows" style="padding: .1rem .2rem;">
          <textarea placeholder="详细地址" class="textarea" v-model="dispatch.dispatch_address"></textarea>
        </div>
      </div>
      <div class="line-cell">
        <h3 class="line-label2">默认收货地址</h3>
        <input type="checkbox" class="ui_switch switch-pos" v-model="isdefault">
      </div>

      <div class="btn-save" @click="getAddressDetail">保存</div>
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
import { getAddressDetail } from '../api/getData'
import { Loading, Selector } from 'vux'
import { areainfo } from '@/utils/areaobj.js'

export default {
  components: {
    XLoading,
    Loading,
    Popup,
    Selector
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
      dispatch_id: 0,
      dispatch: {
        dispatch_province: '',
        dispatch_city: '',
        dispatch_area: ''
      },
      addredDetail: {
        name: '',
        tel: '',
        address: ''
      },
      provinceList: [], // 省份列表
      cityList: [], // 市列表
      areaList: [], // 区域列表
      isdefault: true,
      isSuccess: false // 是否提交成功
    }
  },
  created () {
    if (!isEmpty(this.$route.query.dispatch_id)) {
      this.dispatch_id = this.$route.query.dispatch_id
    }
  },
  mounted () {
    var self = this
    self.provinceList = self.areainfo()
    // for (var i = self.provinceList.length - 1; i >= 0; i--) {
    //   if (self.provinceList[i].name === self.dispatch.dispatch_province) {
    //     self.cityList = self.provinceList[i].cityList
    //     self.areaList = self.cityList[0].areaList
    //     break
    //   }
    // }
    self.fetchData()
  },
  computed: {
  },
  methods: {
    test () {
      this.$router.push({path: prefixUrl + '/login', query: {}})
    },
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    },
    areainfo () {
      return areainfo()
    },
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
      if (this.isSuccess) {
        this.$router.go(-1)
      }
    },
    closeLoginFun () { // 关闭绑定弹窗
      this.showLogin = false
    },
    selectSfun (val) {
      var self = this
      for (var i = self.provinceList.length - 1; i >= 0; i--) {
        if (self.provinceList[i].name === val) {
          self.cityList = self.provinceList[i].cityList
          self.dispatch.dispatch_city = ''
          self.dispatch.dispatch_area = ''
          self.areaList = []
          break
        }
      }
    },
    selectStoreAddr (val) { // 选择店长地理位置
      var self = this
      self.area = ''
      for (var i = self.cityList.length - 1; i >= 0; i--) {
        if (self.cityList[i].name === val) {
          self.areaList = self.cityList[i].areaList
          self.dispatch.dispatch_area = ''
          break
        }
      }
    },
    getAddressDetail () { // 保存
      var self = this
      if (isEmpty(self.dispatch.dispatch_name)) {
        self.openPopupFun('alert', '请填写联系人', 2)
        return
      }
      if (isEmpty(self.dispatch.dispatch_tel)) {
        self.openPopupFun('alert', '请填写电话', 2)
        return
      }
      if (!/^(86)?1[0-9]\d{9}$/.test(self.dispatch.dispatch_tel)) {
        this.openPopupFun('alert', '手机号码格式不正确', 2)
        return
      }
      if (isEmpty(self.dispatch.dispatch_province)) {
        self.openPopupFun('alert', '请选择省份', 2)
        return
      }
      if (isEmpty(self.dispatch.dispatch_city)) {
        self.openPopupFun('alert', '请选择市', 2)
        return
      }
      if (isEmpty(self.dispatch.dispatch_area)) {
        self.openPopupFun('alert', '请选择区/县', 2)
        return
      }
      if (isEmpty(self.dispatch.dispatch_address)) {
        self.openPopupFun('alert', '请填写详细地址', 2)
        return
      }
      if (self.isdefault) {
        self.dispatch.isdefault = 1
      } else {
        self.dispatch.isdefault = 0
      }
      self.type = 'update'
      self.showLoadingText = '提交中'
      self.showLoading = true
      getAddressDetail(self.type, self.dispatch_id, self.dispatch).then(response => {
        var data = response.data
        if (data.code === 200) {
          self.openPopupFun('alert', '提交成功', 2)
          self.isSuccess = true
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.type = ''
        self.showLoading = false
      })
    },
    fetchData () {
      var self = this
      var object = {}
      getAddressDetail(self.type, self.dispatch_id, object).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.dispatch)) {
            var dispatchTemp = data.obj.dispatch
            for (var i = self.cityList.length - 1; i >= 0; i--) {
              if (self.cityList[i].name === dispatchTemp.dispatch_city) {
                self.areaList = self.cityList[i].areaList
                break
              }
            }
            self.selectSfun(dispatchTemp.dispatch_province)
            self.selectStoreAddr(dispatchTemp.dispatch_city)
            self.dispatch = dispatchTemp
            if (data.obj.dispatch.isdefault === 1) {
              self.isdefault = true
            } else {
              self.isdefault = false
            }
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
.address-detail {
  background: #f8f7f2;
}

.rows {
  padding: .15rem .2rem;
  position: relative;
  line-height: .5rem;
  background: white;
  border-bottom: 1px solid #e3e3e3;
}
.rows-left {
  position: absolute;
}
.rows-address-left {
  width: 1rem;
  float: left;
}
.input {
  width: 100%;
  padding-left: 1rem;
  outline: none;
  border: none;
  background: white;
}
.selected {
  width: 4.6rem;
  height: .5rem;
  border: none;
  outline: none;
  background: white;
  float: left;
  font-size: .28rem;
  appearance:none;
  -moz-appearance:none;
  -webkit-appearance:none;
}
.rows-rightarrow {
  width: .2rem;
  height: .2rem;
  border-right: 1px solid #D9D9D9;
  border-bottom: 1px solid #D9D9D9;
  transform: rotate(-45deg);
  float: right;
  margin-top: .2rem;
  margin-right: .2rem;
}
.textarea {
  width: 4.6rem;
  height: 1rem;
  border:none;
  outline: none;
  resize:none;
  margin-left: 1rem;
  overflow: hidden;
}
.tag {
  padding: .02rem .2rem;
  border: 1px solid #D9D9D9;
  border-radius: 5px;
  margin: 0 .1rem;
}
.line-cell {
  padding: .2rem;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  align-items: center;
  background: white;
}
.thin:before {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  height: 1px;
  border-top: 1px solid #D9D9D9;
  color: #D9D9D9;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
  left: .3rem;
}
.line-label2 {
  display: block;
  width: 2rem;
  margin-right: .2rem;
  word-wrap: break-word;
  word-break: break-all;
}
.switch-pos{
  position: absolute;
  top: .1rem;
  right: .3rem;
}
.btn-save {
  margin: .4rem;
  padding: .15rem;
  background: #d3a543;
  text-align: center;
  border-radius: 5px;
  color: #fff;
  font-size: .28rem;
}
.gray-c {
  color: #999;
}
.cb {clear: both;}
a,button,input,optgroup,select,textarea {-webkit-tap-highlight-color:rgba(0,0,0,0);}
</style>
