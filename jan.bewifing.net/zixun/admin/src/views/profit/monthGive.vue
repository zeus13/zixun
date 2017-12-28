<template>
  <div  v-loading="showLoading" :element-loading-text="showLoadingText">
    <el-form ref="form" label-width="140px" style="padding:1.5rem;">
      <el-form-item label="名称">
        <el-input v-model="name"></el-input>
      </el-form-item>
      <el-form-item label="店长收益">
        <el-input v-model="store_income"></el-input>
      </el-form-item>
      <el-form-item label="区县级代理收益">
        <el-input v-model="area_income"></el-input>
      </el-form-item>
      <el-form-item label="市级代理收益">
        <el-input v-model="city_income"></el-input>
      </el-form-item>
      <el-form-item label="往上查找">
        <el-radio-group v-model="is_back">
          <el-radio :label="0">否</el-radio>
          <el-radio :label="1">是</el-radio>
        </el-radio-group>
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
import { setMonthGive } from '../../api/getData'
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
    store_income: 0, // 店长收益
    area_income: 0, // 区县级代理收益
    city_income: 0, // 市级代理收益
    is_back: 0 // 一直往上找
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
        store_income: parseInt(self.store_income) * 100,
        area_income: parseInt(self.area_income) * 100,
        city_income: parseInt(self.city_income) * 100,
        is_back: parseInt(self.is_back)
      }
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
      setMonthGive(self.type, self.val, self.name).then(response => {
        if (response.code === 200) {
          var data = response.obj
          if (self.type === '') { // 初始化
            self.name = data.configuration.name
            self.store_income = data.configuration.val.store_income / 100
            self.area_income = data.configuration.val.area_income / 100
            self.city_income = data.configuration.val.city_income / 100
            self.is_back = data.configuration.val.is_back
          }
          if (self.type === 'update') {
            console.log('保存成功');
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


