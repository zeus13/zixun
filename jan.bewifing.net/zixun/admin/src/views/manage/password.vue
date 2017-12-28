<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">
    <el-form ref="form" :model="user" label-width="100px" style="padding:30px 50px 30px 0;">
      <el-form-item label="用户名" >
        <el-input v-model="user.account" :disabled="true"></el-input>
      </el-form-item>
      <el-form-item label="密码" >
        <el-input v-model="user.password" type="password"></el-input>
      </el-form-item>
      <el-form-item label="确认密码" >
        <el-input v-model="confirmPassword" type="password"></el-input>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="updatePassword">修改</el-button>
      </el-form-item>
    </el-form>

    <el-dialog title="提示" v-model="dialogVisible" size="tiny">
      <span>{{dialogText}}</span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
      </span>
    </el-dialog>

  </div>
</template>

<script>
import { updatePassword, getUserDetail } from '../../api/getData';
import { isEmpty, getStamp } from '@/utils/utils'
import { prefixUrl } from '@/utils/env.js'
export default {
  data() {
   return {
    showLoading: true, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
    dialogVisible: false,
    dialogText: '',
    user_id: 0,
    user: {},
    confirmPassword: '' // 确认密码
   }
  },
  created() {
    if (!isEmpty(this.$route.query.user_id)) {
      this.user_id = this.$route.query.user_id
    } else {
      this.$router.go(-1)
    }
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  watch: {
  },
  methods: {
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    updatePassword () { // 更新权限
      var self = this
      if (isEmpty(self.user.password) || self.user.password.replace(/(^\s*)|(\s*$)/g, '') === '') {
        self.dialogText = '密码不能为空'
        self.dialogVisible = true
        return
      }
      if (self.user.password.replace(/(^\s*)|(\s*$)/g, '').length < 6) {
        self.dialogText = '密码不能少于6位'
        self.dialogVisible = true
        return
      }
      if (isEmpty(self.confirmPassword) || self.confirmPassword.replace(/(^\s*)|(\s*$)/g, '') === '') {
        self.dialogText = '确认密码不能为空'
        self.dialogVisible = true
        return
      }
      if (self.confirmPassword !== self.user.password) {
        self.dialogText = '密码和确认密码不一致'
        self.dialogVisible = true
        return
      }
      updatePassword(self.user).then(response => {
        this.$router.replace({path: prefixUrl + '/manage/userList', query: {}})
      })
    },
    initData () {
      var self = this
      getUserDetail(self.user_id).then(response => {
        var data = response.obj
        if (!isEmpty(data)) {
          self.user = data
          self.user.password = ''
        }
        self.showLoading = false
      })
    }
  }
};
</script>

<style lang="less" scoped>

</style>


