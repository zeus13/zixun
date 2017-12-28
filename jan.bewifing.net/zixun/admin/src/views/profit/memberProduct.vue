<template>
  <div  v-loading="showLoading" :element-loading-text="showLoadingText">
    <el-form ref="form" label-width="140px" style="padding:1.5rem;">
      <el-form-item label="名称">
        <el-input v-model="name"></el-input>
      </el-form-item>
      <el-form-item label="一级VIP会员收益">
        <el-input v-model="one_consume"></el-input>
      </el-form-item>
      <el-form-item label="二级VIP会员收益">
        <el-input v-model="two_consume"></el-input>
      </el-form-item>
      <el-form-item label="一级堂主收益">
        <el-input v-model="one_store"></el-input>
      </el-form-item>
      <el-form-item label="二级堂主收益">
        <el-input v-model="two_store"></el-input>
      </el-form-item>
      <el-form-item label="差旅费">
        <el-input v-model="travel_fee"></el-input>
      </el-form-item>

      <div style="margin:2rem 0 0 0">
        <el-form-item >
          <el-button type="primary" size="large" @click="update()">保存</el-button>
          <el-button type="" size="large" @click="back()">返回</el-button>
        </el-form-item>
      </div>

    </el-form>
  </div>
</template>

<script>
import { setMemberConsume } from '../../api/getData'
import { getStamp, isEmpty } from '@/utils/utils'
import { prefixUrl, prefixApi } from '@/utils/env.js'
export default {
 data() {
   return {
    showLoading: true, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
    type: '', // 提交的类型
    isSubmit: true, // 防止多次提交
    val: {}, // 配置信息
    name: '', // 名称
    one_consume: 0, // 一级VIP会员收益
    two_consume: 0, // 二级VIP会员收益
    one_store: 0, // 一级堂主收益
    two_store: 0, // 二级堂主收益
    travel_fee: 0 // 差旅费
  }
 },
  created() {
  },
  mounted () {
    this.fetchData()
  },
  computed: {
  },
  methods: {
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    back () { // 返回
      this.$router.go(-1)
    },
    update () { // 提交
      var self = this
      self.val = {
        one_consume: parseInt(self.one_consume) * 100,
        two_consume: parseInt(self.two_consume) * 100,
        one_store: parseInt(self.one_store) * 100,
        two_store: parseInt(self.two_store) * 100,
        travel_fee: parseInt(self.travel_fee) * 100
      }
      console.log(self.val)
      self.showLoadingText = '提交中'
      self.type = 'update'
      self.fetchData()
    },
    fetchData() {
      var self = this
      self.showRestStore = false
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      setMemberConsume(self.type, self.val, self.name).then(response => {
        if (response.code === 200) {
          var data = response.obj
          if (self.type === '') { // 初始化
            self.name = data.configuration.name
            self.one_consume = data.configuration.val.one_consume / 100
            self.two_consume = data.configuration.val.two_consume / 100
            self.one_store = data.configuration.val.one_store / 100
            self.two_store = data.configuration.val.two_store / 100
            self.travel_fee = data.configuration.val.travel_fee / 100
          }
          if (self.type === 'update') {
            this.$alert('保存成功', '', {
              confirmButtonText: '确定',
            })
          }
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    }
  }
};
</script>

<style lang="less" scoped>
</style>


