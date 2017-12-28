<template>
<section class="zixunOrderInfo">
  <div v-if="!showXLoading">
    <h3>Hello</h3>
  </div>
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
      showXLoading: true // 显示加载动画
    }
  },
  created () { // 从本地缓存拿值

  },
  mounted () {
    this.showXLoading = false
    // this.initData()
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
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxActivityIndex', params: {addr_id: 0}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {

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
.zixunOrderInfo{

}
</style>
