<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">

    <div style="padding: 24px;">


    <el-form :inline="true" class="demo-form-inline" >
      <el-form :inline="true" class="demo-form-inline">
<!--         <el-form-item label="时间">
          <el-input v-model="condition" placeholder="时间"></el-input>
        </el-form-item> -->
        <el-form-item label="日期">
          <el-date-picker
            v-model="time"
            type="daterange"
            placeholder="选择日期范围">
          </el-date-picker>
        </el-form-item>
        <el-form-item label="姓名">
          <el-input v-model="condition1" placeholder="姓名"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="fetchData">查询</el-button>
        </el-form-item>
      </el-form>
    </el-form>

      <el-table
        :data="goodsList"
        border
        @sort-change = "sortChangeFun"
        @filter-change = "filterMethodFun">     

        <el-table-column
          label="ID"
          width="100"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.id }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="姓名"
          width="200"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.member_name }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="操作类型"
          width="150"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.remark }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="石斛花"
          width="100"
          align="center"
          >
          <template scope="scope">
            <span>{{ scope.row.amount / 100 }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="备注"
          width="600"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.description }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="创建时间"
          min-width="100"
          align="center"
          sortable
          prop="created_at">
          <template scope="scope">
            <span>{{ getStamp(scope.row.created_at, 'ymdhms') }}</span>
          </template>
        </el-table-column>

      </el-table>
    </div>

    <div class="pagination">
      <el-pagination
        @current-change="handleCurrentChange"
        layout="prev, pager, next"
        :total="total"
        :page-size="pageSize">
      </el-pagination>
    </div>
  </div>
</template>

<script>
import { getAdminCashLog } from '../../api/getData';
import { isEmpty, getStamp } from '@/utils/utils'
import { prefixUrl, prefixApi } from '@/utils/env.js'
export default {
  data() {
   return {
    showLoading: true, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
    type: '', // 提交类型
    where: [], // 查询条件and：格式[{key: 'status',sign: '=',value: 1}]
    whereIn: [], // 查询条件or：格式[{key: 'status', value: 1}]
    orderBy: {key: 'created_at', value: 'desc'}, // 排序
    time: '', // 时间范围
    page: 1, // 当前页
    pageSize: 20, // 每页条数
    total: 0, // 总条数
    isSubmit: true, // 防止多次提交
    goodsList: [], // 商品列表
    categoryList: [], // 分类列表
    condition: '', // 查询条件1
    condition1: '', // 查询条件2
    condition2: '', // 查询条件3
    condition3: '' // 查询条件4
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
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    handleCurrentChange (val) { // 分页
      console.log(val)
      this.page = val
      this.fetchData()
    },
    sortChangeFun (val) {
      if (isEmpty(val.prop) || isEmpty(val.order)) {
        return
      }
      this.orderBy.key = val.prop
      this.orderBy.value = val.order === 'descending' ? 'desc' : 'asc'
      this.fetchData()
    },
    filterMethodFun (value, row) {
      console.log(value)
      if (typeof value['cat_name'] !== 'undefined') {
        if (!isEmpty(value['cat_name'])) {
          this.whereIn[0] = {
            key: 'cat_name',
            value: value['cat_name']
          }
        } else {
          this.whereIn[0] = {}
        }
      }
      this.fetchData()
    },
    fetchData () {
      var self = this
      if (!self.isSubmit) {
        return
      }
      console.log(self.condition)
      self.isSubmit = false
      self.showLoading = true
      self.where = []
      var temp = {}
      // if (!isEmpty(self.condition)) {
      //   temp = {
      //     key: 'id',
      //     sign: '=',
      //     value: self.condition
      //   }
      //   self.where.push(temp)
      // }
      if (!isEmpty(self.condition1)) {
        temp = {
          key: 'member_name',
          sign: 'like',
          value: '%' + self.condition1 + '%'
        }
        self.where.push(temp)
      }
      getAdminCashLog(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.total = data.total
          self.goodsList = data.goodsList
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
.pagination {
  text-align: center;
}
</style>


