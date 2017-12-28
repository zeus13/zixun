<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">
    <div style="padding: 24px;">
      <el-table
        :data="userList"
        border
        style="width: 100%;">     


        <el-table-column
          label="序列"
          width="70"
          align="center">
          <template scope="scope">
            <span>{{ scope.$index + 1 }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="用户名"
          width="160"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.account }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="创建时间"
          width="160"
          align="center">
          <template scope="scope">
            <span>{{ getStamp(scope.row.created_at, 'ymd') }}</span>
          </template>
        </el-table-column>

        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              type="primary"
              @click="goToPage('/manage/permission', scope.row.id)">设置权限</el-button>
            <el-button
              size="small"
              type="primary"
              @click="goToPage('/manage/password', scope.row.id)">修改密码</el-button>
            <el-button
              size="small"
              type="danger"
              @click="del(scope.row, scope.$index)">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <el-dialog title="提示" v-model="dialogVisible" size="tiny">
      <span>一经删除，不可恢复，确定要删除？</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="delUser">确 定</el-button>
      </span>
    </el-dialog>

  </div>
</template>

<script>
import { getUserList, delUser } from '../../api/getData';
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
    index: -1,
    userList: []
   }
  },
  created() {
    if (!isEmpty(this.$route.query.user_id)) {
      this.user_id = this.$route.query.user_id
    }
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
    goToPage (url, val) {
      this.$router.push({path: prefixUrl + url, query: {user_id: val}})
    },
    del (val, index) {
      var self = this
      self.user = val
      self.index = index
      self.dialogVisible = true
    },
    delUser () {
      var self = this
      delUser(self.user).then(response => {
        self.userList.splice(self.index, 1)
        self.dialogVisible = false
      })
    },
    initData () {
      var self = this
      getUserList().then(response => {
        var data = response.obj
        if (!isEmpty(data)) {
          self.userList = data
        }
        this.showLoading = false
      })
    }
  }
};
</script>

<style lang="less" scoped>

</style>


