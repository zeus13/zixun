<template>
<section class="zixunUserEdit">
  <div v-if="!showXLoading">
    <div class="top-headimg">
      <label>我的头像</label>
      <img class="headimg" :src="member.avatar">
    </div>
    <div class="line-cell mt5">
      <h3 class="line-label">昵称</h3>
      <div class="line-cell-bd"><input type="text" class="line-input" name="name" placeholder="这里输入昵称" v-model="member.name"></div>
    </div>
    <div class="line-cell thin ">
      <h3 class="line-label">性别</h3>
      <div class="line-cell-bd tag-tick">
        <select v-model="member.gender" class="line-select" dir="rtl">
          <option v-for="option in options" v-bind:value="option.value">
            {{ option.text }}
          </option>
        </select>
      </div>
    </div>
    <div class="line-cell">
      <h3 class="line-label">绑定手机</h3>
      <div class="line-cell-bd"><input type="text" class="line-input" name="name" placeholder="这里输入联系人" v-model="member.tel"></div>
    </div>
    <div class="btn-save" @click="clickSave()">保存</div>
  </div>
  <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import popup from '@/components/common/popup'
import { isEmpty, getStamp } from '@/components/common/utils'
export default {
  components: {
    XLoading,
    popup
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      options: [ // 区域列表
        { text: '未选择', value: 2 },
        { text: '男', value: 1 },
        { text: '女', value: 0 }
      ],
      member: {} // 个人信息
    }
  },
  created () {
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    openPopupFun (type, msg, icon) { // 开启弹窗
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗
      this.showPopup = false
      if (this.popupMsg === '保存成功') {
        this.$router.go(-1)
      }
    },
    clickSave () { // 保存
      if (isEmpty(this.member.tel) || this.member.tel.replace(/(^\s*)|(\s*$)/g, '') === '') {
        this.openPopupFun('alert', '电话不能为空', 2)
        return
      }
      if (!/^(86)?1[0-9]\d{9}$/.test(this.member.tel)) {
        this.openPopupFun('alert', '电话格式不正确', 2)
        return
      }
      this.openPopupFun('load', '正在提交', 0)
      this.$http({url: 'ajaxZixunUserEdit', params: {member: this.member}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200) {
          this.openPopupFun('alert', result.msg, 1)
        } else {
          this.openPopupFun('alert', result.msg, 2)
        }
      }, function (response) {
        this.openPopupFun('alert', 'error', 2)
        console.log(response)
      })
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunUserHome', params: {}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          if (!isEmpty(result.obj.member)) {
            this.member = result.obj.member
          }
        }
      }, function (response) {
        console.log(response)
      })
      this.showXLoading = false
    }
  },
  watch: {
  }
}
</script>
<style lang="less" scoped>
.zixunUserEdit{

}
.mt5{
  margin-top: .5rem;
}
.top-headimg{
  line-height: 1.2rem;
  height: 1.2rem;
  position: relative;
  background: #fff;
  border-bottom: 1px dotted #9e9ed4;
  color: #384275;
  padding-left: .2rem;
}
// .top-headimg:before{
//   content: '';
//   display: inline-block;
//   height: 8px;
//   width: 8px;
//   border-width: 1px 1px 0 0;
//   border-color: #384275;
//   border-style: solid;
//   -webkit-transform: matrix(.71,.71,-.71,.71,0,0);
//   transform: matrix(.71,.71,-.71,.71,0,0);
//   position: absolute;
//   top: 50%;
//   margin-top: -4px;
//   right: 10px;
// }
.headimg{
  width: .8rem;
  height: .8rem;
  border-radius: 50%;
  border: 1px solid #9e9ed4;
  position: absolute;
  top: .2rem;
  right: .4rem;
}
.btn-save{
  width: 100%;
  height: .8rem;
  line-height: .8rem;
  text-align: center;
  background: #384275;
  color: #fff;
  position: fixed;
  left: 0;
  bottom: 0;
}
.line-cell {
  padding: .2rem .3rem;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  align-items: center;
  background: #fff;
  border-bottom: 1px dotted #e8e8e8;
}
.line-label {
    display: block;
    width: 1rem;
    margin-right: .2rem;
    word-wrap: break-word;
    word-break: break-all;
}
.line-input {
    width: 100%;
    border: 0;
    outline: 0;
    -webkit-appearance: none;
    background-color: transparent;
    font-size: inherit;
    color: inherit;
    height: 1.41176471em;
    line-height: 1.41176471;
    color: #7d7d7d;
    text-align: right;
}
.line-select{
  -webkit-appearance: none;
  border: 0;
  outline: 0;
  background-color: transparent;
  width: 100%;
  font-size: .24rem;
  position: relative;
  z-index: 1;
  color: #7d7d7d;
  font-family: "PingFangSC-Light";
}
.line-cell-bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
}
</style>
