<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">

    <div style="padding: 24px;">


    <el-form :inline="true" class="demo-form-inline" >
      <el-form :inline="true" class="demo-form-inline">
        <el-form-item label="ID">
          <el-input v-model="condition" placeholder="ID"></el-input>
        </el-form-item>
        <el-form-item label="姓名">
          <el-input v-model="condition1" placeholder="姓名"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="initData">查询</el-button>
        </el-form-item>
      </el-form>
    </el-form>
      <el-table
        :data="cashoutList"
        border
        @sort-change = "sortChangeFun"
        @filter-change = "filterMethodFun">

        <el-table-column
          label="ID"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.id }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="姓名"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.name }}</div>
          </template>
        </el-table-column>


        <el-table-column
          label="提现金额"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.money / 100 }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="名称"
          width="140"
          align="center"
          column-key="bank_name"
          prop="bank_name"
          :filters="bankList"
          >
          <template scope="scope">
            <span>{{ scope.row.bank_name }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="地址"
          width="100"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.bank_addr }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="姓名"
          width="120"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.name }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="账号"
          width="180"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.account }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="创建时间"
          min-width="100"
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
              @click="edit(scope.$index, scope.row.id),showCheck=true">核销</el-button>
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
        <div>确定要核销？一经核销，不可恢复。</div>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showCheck = false">取 消</el-button>
        <el-button type="primary" @click="editCheck()">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="拒绝" v-model="showRefuse">
      <el-form ref="form"  label-width="80px" >
        <el-form-item label="拒绝理由">
          <el-input v-model="remark" type="textarea" :rows="2"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showRefuse = false">取 消</el-button>
        <el-button type="primary" @click="editRefuse()">确 定</el-button>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import { getAdminCashoutList, getAdminBankList, getAdminCashoutDetail } from '../../api/getData';
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
    cashoutList: [], // 提现列表
    index: -1, // 下标
    cashout_id: 0, // 提现记录id
    bankList: [], // 银行列表
    showCheck: false, // 弹出核销界面
    showRefuse: false, // 弹出拒接界面
    remark: '',
    condition: '', // 查询条件1
    condition1: '', // 查询条件2
    condition2: '', // 查询条件3
    condition3: '' // 查询条件4
   }
  },
  created() {
    this.getAdminBankList()
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
      if (typeof value['bank_name'] !== 'undefined') {
        if (!isEmpty(value['bank_name'])) {
          this.whereIn[0] = {
            key: 'bank_name',
            value: value['bank_name']
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
      self.cashout_id = val
    },
    getAdminBankList () { // 获取银行列表
      var self = this
      getAdminBankList().then(response => {
        if (response.code === 200) {
          var data = response.obj
          if (!isEmpty(data.bankList)) {
            for (var i = 0; i < data.bankList.length; i++) {
              self.bankList.push({ text: data.bankList[i], value: data.bankList[i] })
            }
          }
        }
      })
    },
    editCheck () { // 核销
      var self = this
      self.showCheck = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      getAdminCashoutDetail('check', self.cashout_id).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.cashoutList.splice(self.index, 1)
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
      var object = {
        remark: self.remark
      }
      self.showRefuse = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      getAdminCashoutDetail('refuse', self.cashout_id, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.cashoutList.splice(self.index, 1)
          self.remark = ''
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
      self.where = []
      var temp = {
        key: 'status',
        sign: '=',
        value: 1,
      }
      self.where.push(temp)
      if (!isEmpty(self.condition)) {
        temp = {
          key: 'id',
          sign: '=',
          value: self.condition
        }
        self.where.push(temp)
      }
      if (!isEmpty(self.condition1)) {
        temp = {
          key: 'name',
          sign: '=',
          value: self.condition1
        }
        self.where.push(temp)
      }
      if (!isEmpty(self.condition2)) {
        temp = {
          key: 'account',
          sign: '=',
          value: self.condition2
        }
        self.where.push(temp)
      }
      if (!isEmpty(self.condition3)) {
        temp = {
          key: 'qrcode',
          sign: '=',
          value: self.condition3
        }
        self.where.push(temp)
      }
      getAdminCashoutList(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.total = data.total
          self.cashoutList = data.cashoutList
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


