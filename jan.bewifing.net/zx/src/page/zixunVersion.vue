<template>
<section class="zixunVersion">
  <div v-if="!showXLoading">
  <button class="div1"><span>新增</span></button>
  <ul>
    <li v-for="(item, index) in versionLogList">
      <span class="span1">{{'V' + item.major + '.' + item.minor}}</span>
      <span class="span2">编辑</span>
      <span class="span3">删除</span>
    </li>
  </ul>

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
      type: '',
      versionLogList: []
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
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunAboutMe', params: {type: this.type}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200) {
          if (this.type === '') {
            this.versionLogList = result.obj.versionLogList
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
  @import '../assets/less/base.less';
  ul{
    font-size: .35rem;
    padding: .2rem;
  }
  li{
    list-style: none;
    text-align: justify;
    margin: .1rem;
  }
  .div1{
    padding: 11px 19px;
    font-size: 16px;
    border-radius: 4px;
    color: black;
    background-color: #20a0ff;
    border-color: #20a0ff;
    display: inline-block;
    line-height: 1;
    white-space: nowrap;
    cursor: pointer;
    background: #fff;
    border: 1px solid #c4c4c4;
    margin: .3rem 0 0 .3rem;
    box-sizing: border-box;
  }
  .span1{
    display: block;
    width: 1rem;
    float: left;
  }
  .span2{
    color: #517395;
    margin-left: .2rem;
  }
  .span3{
    color: #fd2121;
    margin-left: .2rem;
  }
</style>
