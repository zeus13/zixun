<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">

    <div style="padding: 24px;">

    <el-form :inline="true" class="demo-form-inline" >
      <el-form-item>
        <el-button type="primary" @click="showStore=true">新增微商</el-button>
      </el-form-item>
    </el-form>

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
        <el-form-item label="昵称">
          <el-input v-model="condition3" placeholder="昵称"></el-input>
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
          label="昵称"
          width="140"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.nickname }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="剩余金币"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.gold }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="可提现金额"
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ (scope.row.balance) / 100 }}</div>
          </template>
        </el-table-column>

        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.id),showMoney=true">提现核销</el-button>
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

    <el-dialog title="提现核销" v-model="showMoney">
      <el-form ref="form" :model="member" label-width="120px" >
        <el-form-item label="会员姓名">
          {{member.name}}
        </el-form-item>
        <el-form-item label="手机号码">
          {{member.account}}
        </el-form-item>
        <el-form-item label="昵称">
          {{member.nickname}}
        </el-form-item>
        <el-form-item label="当前可提现金额">
          {{(member.balance) / 100}}
        </el-form-item>
        <el-form-item label="金额">
          <el-input v-model="money"></el-input>
        </el-form-item>
        <el-form-item label="备注">
          <el-input v-model="remark" type="textarea" :rows="2"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showMoney = false">取 消</el-button>
        <el-button type="primary" @click="checkMoney()">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="新增微商" v-model="showStore">
      <el-form :inline="true" label-width="" v-show="showSelect">
        <el-form-item label="    ">
          <el-input v-model="selectCondition" placeholder="请输入手机号码\姓名\昵称"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="searchMember">查询</el-button>
        </el-form-item>
      </el-form>
      <el-form label-width="10px" v-show="showSelect" style="color:red;">
        <el-form-item label="">
          {{showMsg}}
        </el-form-item>
      </el-form>
      <el-table v-show="!showSelect"
        ref="singleTable"
        :data="selectMemberList"
        highlight-current-row
        @current-change="changeMember"
        style="width: 100%">
        <el-table-column
          type="index"
          width="50">
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
          label="姓名"
          width="140"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.name }}</div>
          </template>
        </el-table-column>
        <el-table-column
          label="昵称"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.nickname }}</div>
          </template>
        </el-table-column>
      </el-table>
      </el-form>
      <div slot="footer" class="dialog-footer" v-show="!showSelect">
        <el-button @click="showStore = false,showSelect = true">取 消</el-button>
        <el-button type="primary" @click="addBusiness()">确 定</el-button>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import { getAdminBusinessList, getAdminMemberDetail } from '../../api/getData';
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
    showStore: false, // 设置店长
    is_store: 0, // 是否店长
    provinceList: [], // 省份列表
    cityList: [], // 市列表
    areaList: [], // 区域列表
    province: '广西区', // 省份
    city: '', // 市
    area: '', // 区或县
    tel: '', // 搜索手机号码
    selectCondition: '', // 单项搜索条件
    selectMemberList: [],
    selectMember: {},
    showSelect: true, // true显示搜索框
    showMsg: '', // 搜索后返回的信息
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
    searchMember () { // 搜索会员
      var self = this
      var object = {
        selectCondition: self.selectCondition
      }
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      getAdminMemberDetail('selectMember', 0, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.selectMemberList = data.selectMemberList
          self.showSelect = false
          console.log(data)
        } else {
          self.showMsg = response.msg
        }
        self.isSubmit = true
      })
    },
    changeMember(val) { // 选择要新增的微商
      this.selectMember = val
      console.log('handleCurrentChange')
      console.log(val)
    },

    addBusiness () { // 新增微商
      var self = this
      if (isEmpty(self.selectMember)) {
        this.$alert('请选择升级为微商的会员', '', {
          confirmButtonText: '确定',
        })
        return
      }
      self.member_id = self.selectMember.id
      self.showStore = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      getAdminMemberDetail('addBusiness', self.member_id).then(response => {
        if (response.code === 200) {
          var data = response.obj
          var temp = self.selectMember
          temp.is_member = 1
          self.memberList.push(temp)
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.member_id = 0
        self.selectMember = {}
        self.isSubmit = true
        self.showLoading = false
        self.showSelect = true
      })
    },
    checkMoney () { // 提现核销
      var self = this
      // if (parseInt(self.money) < 100) {
      //   this.$alert('每次提现最少100元', '', {
      //     confirmButtonText: '确定',
      //   })
      //   return
      // }
      if (parseInt(self.money) * 100 > self.member.balance) {
        this.$alert('可提现金额不足', '', {
          confirmButtonText: '确定',
        })
        return
      }
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
      
      getAdminMemberDetail('checkMoney', self.member_id, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          var temp = self.member
          temp.balance = parseInt(temp.balance) - parseInt(self.money) * 100
          self.memberList.splice(self.index, 1, temp)
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.money = ''
        self.remark = ''
        self.member_id = 0
        self.member = {}
        self.isSubmit = true
        self.showLoading = false
      })
    },
    selectStoreAddr (val) { // 选择店长地理位置
      var self = this
      self.area = ''
      for (var i = self.cityList.length - 1; i >= 0; i--) {
        if (self.cityList[i].name === val) {
          self.areaList = self.cityList[i].areaList
        }
      }
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
            sign: 'like',
            value: '%' + self.condition1 + '%'
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
            key: 'nickname',
            sign: 'like',
            value: '%' + self.condition3 + '%'
          }
          self.where.push(temp)
        }
        getAdminBusinessList(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
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


