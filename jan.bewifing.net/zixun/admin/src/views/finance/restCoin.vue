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
        <el-form-item label="手机号码">
          <el-input v-model="condition2" placeholder="手机号码"></el-input>
        </el-form-item>
        <el-form-item label="推荐码">
          <el-input v-model="condition3" placeholder="推荐码"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="initData">查询</el-button>
        </el-form-item>
      </el-form>
    </el-form>

      <el-table
        :data="memberList"
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
          label="手机号码"
          width="140"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.account }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="推荐码"
          width="140"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.qrcode }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="省份"
          width="140"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.province }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="市"
          width="80"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.city }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="县/区"
          width="80"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.area }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="余额"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ (scope.row.balance - scope.row.incashout) / 100 }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="消费商"
          width="80"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.is_member == 1 ? '是' : '否' }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="店长"
          width="80"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.is_store == 1 ? '是' : '否' }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="区代"
          width="80"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.is_area == 1 ? '是' : '否' }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="市代"
          width="80"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.is_city == 1 ? '是' : '否' }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="已直推堂主数量"
          width="100"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.rec_store }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="剩余直推堂主名额"
          width="100"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.rest_store }}</span>
          </template>
        </el-table-column>


        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.id),showMoney=true">余额</el-button>
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

    <el-dialog title="设置余额" v-model="showMoney">
      <el-form ref="form" :model="member" label-width="120px" >
        <el-form-item label="会员姓名">
          {{member.name}}
        </el-form-item>
        <el-form-item label="当前余额">
          {{(member.balance - member.incashout) / 100}}
        </el-form-item>
        <el-form-item label="增加或减少余额">
          <el-input v-model="money"></el-input>
        </el-form-item>
        <el-form-item label="备注">
          <el-input v-model="remark" type="textarea" :rows="2"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showMoney = false">取 消</el-button>
        <el-button type="primary" @click="editMoney()">确 定</el-button>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import { getAdminMemberList, getAdminMemberDetail } from '../../api/getData';
import { isEmpty, getStamp } from '@/utils/utils'
import { prefixUrl, prefixApi } from '@/utils/env.js'
import { areainfo } from '@/utils/areaobj.js'
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
    memberList: [],
    index: -1, // 下标
    member_id: 0, // 会员id
    member: {}, // 会员信息
    showMoney: false, // 设置余额
    money: '', // 余额-增减金额
    remark: '', // 余额-备注
    provinceList: [], // 省份列表
    cityList: [], // 市列表
    areaList: [], // 区域列表
    province: '广西区', // 省份
    city: '', // 市
    area: '', // 区或县
    amount: 0, // 增减店长数量
    condition: '', // 查询条件1
    condition1: '', // 查询条件2
    condition2: '', // 查询条件3
    condition3: '' // 查询条件4
   }
  },
  created() {
  },
  mounted () {
    var self = this
    self.provinceList = areainfo()
    for (var i = self.provinceList.length - 1; i >= 0; i--) {
      if (self.provinceList[i].name === self.province) {
        self.cityList = self.provinceList[i].cityList
        break
      }
    }
    this.initData()
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
      this.initData()
    },
    sortChangeFun (val) {
      console.log(val)
      console.log('排序回调')
      if (isEmpty(val.prop) || isEmpty(val.order)) {
        return
      }
      this.orderBy.key = val.prop
      this.orderBy.value = val.order === 'descending' ? 'desc' : 'asc'
      this.initData()
    },
    filterMethodFun (value, row) {
      if (typeof value['goods'] !== 'undefined') {
        if (!isEmpty(value['goods'])) {
          this.whereIn[0] = {
            key: 'goods_name',
            value: value['goods']
          }
        } else {
          this.whereIn[0] = {}
        }
      }
      if (typeof value['status'] !== 'undefined') {
        if (!isEmpty(value['status'])) {
          this.whereIn[1] = {
            key: 'status',
            value: value['status']
          }
        } else {
          this.whereIn[1] = {}
        }
      }
      console.log(this.whereIn)
      this.initData()
    },
    edit (index, val) { // 编辑
      var self = this
      self.index = index
      self.member_id = val
      self.member = self.memberList[index]
    },
    editMoney () { // 编辑余额
      var self = this
      var object = {
        money: self.money * 100,
        remark: self.remark
      }
      self.showMoney = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      getAdminMemberDetail('setMoney', self.member_id, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          var temp = self.member
          temp.balance = parseInt(temp.balance) + parseInt(self.money) * 100
          self.memberList.splice(self.index, 1, temp)
          self.money = ''
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
      if (self.isSubmit) {
        self.isSubmit = false
        self.where = []
        var temp = {}
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
        getAdminMemberList(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
          if (response.code === 200) {
            var data = response.obj
            self.total = data.total
            if (!isEmpty(data.memberList)) {
              self.memberList = data.memberList
            } else {
              self.memberList = []
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
  }
};
</script>

<style lang="less" scoped>
.pagination {
  text-align: center;
}
</style>


