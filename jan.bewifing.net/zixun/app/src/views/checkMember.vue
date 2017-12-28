<template>
  <div class="checkMember">
    <div class="checkMember-wrap">
      <div v-if="!isEmpty(sub_member)">
        <div class="head"><img :src="sub_member.headimgurl" class="head-img"></div>
        <div class="text">
          <div class="text-row">{{sub_member.name}}</div>
          <div class="text-row">{{sub_member.account}}</div>
          <div class="text-row sty1">是否让该用户成为微商？</div>
        </div>
        <div class="btn-box clearfix">
          <div class="btn-pass fl" @click="submitFun('yes')">通过</div>
          <div class="btn-pass fr" @click="submitFun('no')">不通过</div>
        </div>
      </div>
      <div v-else class="nodata">找不到该用户</div>
    </div>

    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </div>
</template>
<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp, wxshare } from '../utils/utils'
import { getJssdk, getCheckMember } from '../api/getData'
import { Loading } from 'vux'
import { prefixUrl } from '@/utils/env'
import wx from 'weixin-js-sdk'

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
      type: '', // 提交类型
      wx: [], // 微信sdk
      sub_member: [], // 会员
      is_close: false, // 是否关闭当前页面
      member_id: 0 // 会员id
    }
  },
  created () {
    if (!isEmpty(this.$route.query.member_id)) {
      this.member_id = parseInt(this.$route.query.member_id)
    }
    this.getJssdkFun()
    this.getCheckMember()
  },
  mounted () {
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
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
      if (this.is_close) {
        wx.closeWindow()
      }
    },
    submitFun (val) {
      var self = this
      if (val === 'yes') {
        self.type = 'check'
        self.getCheckMember()
      } else {
        self.is_close = true
        self.openPopupFun('alert', '取消成功', 2)
      }
    },
    getJssdkFun () {
      getJssdk().then(response => {
        let result = response.data
        if (result.code === 200) {
          wx.config(result.obj.jssdk)
          wxshare(wx)
        }
      })
    },
    getCheckMember () {
      var self = this
      self.showLoadingText = '加载中...'
      self.showLoading = true
      var object = {
        member_id: self.member_id
      }
      getCheckMember(self.type, object).then(response => {
        var data = response.data
        if (data.code === 200) {
          if (self.type === 'check') {
            self.is_close = true
            self.openPopupFun('alert', '提交成功！', 2)
          }
          if (self.type !== 'check' && !isEmpty(data.obj.sub_member)) {
            self.sub_member = data.obj.sub_member
            console.log(self.sub_member)
          }
        } else if (data.code === 600) { // 跳往登录界面
          this.$router.replace({path: prefixUrl + '/login', query: {}})
        } else {
          self.is_close = true
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
        self.showLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
.checkMember {
  background: url(../assets/img/bg1.jpg) no-repeat;
  background-size: cover;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
.checkMember-wrap {
  background: #fff;
  width: 5.4rem;
  margin: 1rem auto;
  padding: .2rem 0;
  border-radius: .1rem;
}
.head {
  width: 1.5rem;
  height: 1.5rem;
  margin: .3rem auto .1rem;
}
.head-img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 1px solid #eee;
}
.text {
  text-align: center;
}
.text-row {
  text-align: center;
}
.btn-box {
  margin: .4rem;
}
.btn-pass {
  width: 2rem;
  line-height: .6rem;
  background: #d2bf97;
  text-align: center;
  border-radius: 5px;
}
.sty1 {
  color: #e78c07;
  margin-top: .2rem;
}
.fl {
  float: left;
}
.fr {
  float: right;
}
.nodata {
  padding: 0 .2rem;
}
</style>
