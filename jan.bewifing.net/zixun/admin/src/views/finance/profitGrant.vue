<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">

    <div style="padding: 24px;">


    <el-form :inline="true" class="demo-form-inline" >
      <el-date-picker
        v-model="time"
        type="daterange"
        placeholder="选择日期范围">
      </el-date-picker>
      <el-form-item>
        <el-button type="primary" @click="initData">查询</el-button>
      </el-form-item>
    </el-form>

      <el-table
        :data="incomeList"
        border
        @sort-change = "sortChangeFun"
        @filter-change = "filterMethodFun">

        <el-table-column
          label="会员ID"
          width="120"
          align="center"
          sortable
          prop="member_id">
          <template scope="scope">
            <div>{{ scope.row.member_id }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="会员姓名"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.member_name }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="发放金额"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.money / 100 }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="备注"
          width="260"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.remark }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="创建时间"
          width="180"
          align="center">
          <template scope="scope">
            <span>{{ getStamp(scope.row.created_at, 'ymdhms') }}</span>
          </template>
        </el-table-column>

        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.id),showCheck=true">发放</el-button>
            <el-button
              size="small"
              type="danger"
              @click="edit(scope.$index, scope.row.id),showRefuse=true">拒绝</el-button>
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

    <el-dialog title="核销" v-model="showCheck">
      <el-form ref="form"  label-width="40px" >
        <div>确定要发放？一经发放，不可恢复。</div>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showCheck = false">取 消</el-button>
        <el-button type="primary" @click="editCheck()">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="拒绝" v-model="showRefuse">
      <el-form ref="form"  label-width="40px" >
        <div>确定要拒绝？一经拒绝，不可恢复。</div>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showRefuse = false">取 消</el-button>
        <el-button type="primary" @click="editRefuse()">确 定</el-button>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import { getAdminIncomeList, getAdminIncomeDetail } from '../../api/getData';
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
    incomeList: [], // 收益列表
    index: -1, // 下标
    income_id: 0, // 提现记录id
    bankList: [], // 银行列表
    showCheck: false, // 弹出核销界面
    showRefuse: false, // 弹出拒接界面
    remark: ''
   }
  },
  created() {
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
    handleCurrentChange (val) { // 分页
      this.page = val
      this.initData()
    },
    sortChangeFun (val) { // 排序
      if (isEmpty(val.prop) || isEmpty(val.order)) {
        return
      }
      this.orderBy.key = val.prop
      this.orderBy.value = val.order === 'descending' ? 'desc' : 'asc'
      this.initData()
    },
    filterMethodFun (value, row) { // 过滤
      console.log(value)
      if (typeof value['debit_card_bank'] !== 'undefined') {
        if (!isEmpty(value['debit_card_bank'])) {
          this.whereIn[0] = {
            key: 'debit_card_bank',
            value: value['debit_card_bank']
          }
        } else {
          this.whereIn[0] = {}
        }
      }
      this.initData()
    },
    edit (index, val) { // 编辑
      var self = this
      self.index = index
      self.income_id = val
    },
    editCheck () { // 发放
      var self = this
      self.showCheck = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      getAdminIncomeDetail('check', self.income_id).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.incomeList.splice(self.index, 1)
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    },
    editRefuse () { // 拒绝
      var self = this
      self.showRefuse = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      getAdminIncomeDetail('refuse', self.income_id).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.incomeList.splice(self.index, 1)
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    },
    initData () {
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      var temp = {
        key: 'status',
        sign: '=',
        value: 1,
      }
      self.where.push(temp)
      getAdminIncomeList(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.total = data.total
          self.incomeList = data.incomeList
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


