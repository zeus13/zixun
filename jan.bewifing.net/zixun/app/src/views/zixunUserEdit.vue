<template>
  <section class="zixunUserEdit">
    <div class="header clearfix">
      <span>我的头像</span>
      <img :src="member.avatar" class="header-img">
    </div>
    <div class="info">
      <div class="info-row">
        <span>昵称</span>
        <input type="text" placeholder="填写你的昵称" v-model="member.name" >
      </div>
      <div class="info-row">
        <span>性别</span>
        <select v-model="member.gender">
          <option>未选择</option>
          <option value="1">男</option>
          <option value="2">女</option>
        </select>
      </div>
      <div class="info-row">
        <span>绑定手机</span>
        <input type="tel" placeholder="填写你的电话号码" v-model="member.tel" maxlength="11">
      </div>
    </div>

    <div class="btn-save" @click="save">保存</div>
    
    
    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import { Loading } from 'vux'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { prefixUrl } from '@/utils/env'
import { ajaxZixunUserHome, ajaxZixunUserEdit } from '../api/getData'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: true, // 是否显示加载动画
      showLoading: false, // 是否显示数据加载中弹窗
      showLoadingText: '', // 加载中弹窗文字
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      member: {},
      tel: '', // 电话
      nickname: '' // 昵称
    }
  },
  created () {
    this.fetchData()
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
    openPopupFun (type, msg, icon, back) { // 打开弹窗
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗
      this.showPopup = false
    },
    goToPage (val) { // 跳转页面
      console.log(val)
      this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: val}})
    },
    save () { // 更新数据
      var self = this
      if (isEmpty(this.member.tel) || this.member.tel.replace(/(^\s*)|(\s*$)/g, '') === '') {
        self.openPopupFun('alert', '电话号码不能为空', 2)
        return
      }
      if (!/^(86)?1[0-9]\d{9}$/.test(this.member.tel)) {
        this.openPopupFun('alert', '电话格式不正确', 2)
        return
      }
      self.showLoadingText = '提交中'
      self.showLoading = true
      ajaxZixunUserEdit(self.member).then(response => {
        var data = response.data
        if (data.code === 200) {
          self.openPopupFun('alert', data.msg, 1)
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showLoading = false
      })
    },
    fetchData () { // 初始化数据
      var self = this
      ajaxZixunUserHome().then(response => {
        var data = response.data
        if (data.code === 200) {
          if (!isEmpty(data.obj.member)) {
            self.member = data.obj.member
            console.log(this.member)
          }
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
.header {
  padding: .2rem;
  background: white;
  color: #384275;
  border-bottom: 1px dashed #384275;
}
.header span {
  display: inline-block;
  margin-top: .25rem;
  font-size: .22rem;
}
.header-img {
  float: right;
  width: .9rem;
  height: .9rem;
  margin-right: .1rem;
  border-radius: 50%;
  border: 1px solid #e4e4e4;
  vertical-align: middle;
}
.info {
  margin-top: 1rem;
  background: white;
}
.info-row {
  padding: .15rem;
  border-bottom: 1px solid #e4e4e4;
}
.info-row input {
  float: right;
  margin-right: .1rem;
  padding: .1rem;
  outline: none;
  border: none;
  background: white;
  text-align: right;
  font-size: .24rem;
}
.info-row select {
  float: right;
  width: 1rem;
  padding: .02rem .1rem;
  background: white;
  appearance: none;
  text-align: center;
  border: none;
  font-size: .24rem;
}
.btn-save {
  margin: 1rem 2rem;
  padding: .15rem;
  text-align: center;
  background: #384275;
  color: white;
  border-radius: 5px;
}
a,button,input,optgroup,select,textarea
{
-webkit-tap-highlight-color:rgba(0,0,0,0);
}
</style>

