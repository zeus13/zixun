<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">
    <el-form ref="form" :model="user" label-width="100px" style="padding:30px 50px 30px 0;">
      <el-form-item label="用户名" >
        <el-input v-model="user.account"></el-input>
      </el-form-item>
      <el-form-item label="密码" >
        <el-input v-model="user.password" type="password"></el-input>
      </el-form-item>
      <el-form-item label="确认密码" >
        <el-input v-model="confirmPassword" type="password"></el-input>
      </el-form-item>
      <el-form-item label="权限" >
        <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange">全选</el-checkbox>
        <div style="margin: 15px 0;"></div>
        <el-checkbox-group v-model="checkedPermissions" @change="handleCheckedCitiesChange" v-if="!isEmpty(permissions)">
          <el-checkbox v-for="(item, index) in permissions" :label="item" :key="item">{{item}}</el-checkbox>
        </el-checkbox-group>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addUser">新增</el-button>
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
import { getPermissionList, addUser, getUserDetail } from '../../api/getData';
import { isEmpty, getStamp } from '@/utils/utils'
import { prefixUrl } from '@/utils/env.js'
export default {
  data() {
   return {
    showLoading: true, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
    dialogVisible: false,
    dialogText: '',
    user: {},
    object: ['John', 'Doe', 'Jan'],
    confirmPassword: '', // 确认密码
    permissionList: [],
    checkAll: true, // 全选
    checkedPermissions: [], // 选中
    permissions: [], // 全部
    isIndeterminate: true // 减号标志
   }
  },
  created() {
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
    handleCheckAllChange(event) { // 全选
      this.checkedPermissions = event.target.checked ? this.permissions : [];
      this.isIndeterminate = false;
    },
    handleCheckedCitiesChange(value) {
      let checkedCount = value.length;
      this.checkAll = checkedCount === this.permissions.length;
      this.isIndeterminate = checkedCount > 0 && checkedCount < this.permissions.length;
    },
    addUser () { // 新增用户
      var self = this
      if (isEmpty(self.user.account) || self.user.account.replace(/(^\s*)|(\s*$)/g, '') === '') {
        self.dialogText = '用户名不能为空'
        self.dialogVisible = true
        return
      }
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
      var role = []
      if (!isEmpty(self.checkedPermissions)) {
        for (var i = 0; i < self.checkedPermissions.length; i++) {
          for (var j = 0; j < self.permissionList.length; j++) {
            if (self.checkedPermissions[i] === self.permissionList[j].name) {
              role.push(self.permissionList[j].ename)
              break
            }
          }
        }
      }
      self.user.role = role
      addUser(self.user).then(response => {
        this.$router.replace({path: prefixUrl + '/manage/userList', query: {}})
      })
    },
    initData () {
      var self = this
      getPermissionList().then(response => {
        var data = response.obj
        self.permissionList = data
        for (var i = 0; i < data.length; i++) {
          self.permissions.push(data[i].name)
          console.log(self.permissions)
        }
        self.fetchData()
      })
    },
    fetchData () {
      var self = this
      getUserDetail(self.user_id).then(response => {
        var data = response.obj
        if (!isEmpty(data)) {
          self.user = data
          self.confirmPassword = data.password
          for (var i = 0; i < self.user.role.length; i++) {
            for (var j = 0; j < self.permissionList.length; j++) {
              if (self.user.role[i] === self.permissionList[j].ename) {
                self.checkedPermissions.push(self.permissionList[j].name)
                break
              }
            }
          }
        }
        self.showLoading = false
      })
    }
  }
};
</script>

<style lang="less" scoped>

</style>


