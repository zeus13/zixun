<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">

    <div style="padding: 24px;">



    <el-form :inline="true" class="demo-form-inline" >
      <el-form :inline="true" class="demo-form-inline">
        <el-form-item label="订单编号">
          <el-input v-model="condition" placeholder="订单编号"></el-input>
        </el-form-item>
        <el-form-item label="收货人">
          <el-input v-model="condition1" placeholder="收货人"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="fetchData">查询</el-button>
        </el-form-item>
      </el-form>
    </el-form>

      <el-table
        :data="orderList"
        border
        @sort-change = "sortChangeFun"
        @filter-change = "filterMethodFun">     

        <el-table-column
          label="订单编号"
          width="240"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.ordersn }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="创建时间"
          width="110"
          align="center">
          <template scope="scope">
            <span>{{ getStamp(scope.row.created_at, 'ymdhms') }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="订单总价"
          width="120"
          align="center"
          >
          <template scope="scope">
            <div>{{ scope.row.total_price / 100 }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="收货人"
          width="120"
          align="center"
          >
          <template scope="scope">
            <div>{{ scope.row.dispatch_name }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="配送方式"
          width="120"
          align="center"
          >
          <template scope="scope">
            <div>{{ scope.row.is_lifting == 1 ? '自提' : '快递' }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="状态"
          width="160"
          align="center"
          >
          <template scope="scope">
            <div>{{ getOrderStatus(scope.row) }}</div>
          </template>
        </el-table-column>


        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              type="primary"
              @click="goToPage(scope.$index, scope.row.ordersn)">查看详情</el-button>
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.ordersn),showSend=true" v-show="scope.row.pay_status === 1 && scope.row.send_status ===0 && scope.row.complete_status === 0 && scope.row.is_lifting === 0">标记发货</el-button>
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.ordersn),showEditSend=true" v-show="scope.row.pay_status === 1 && scope.row.send_status ===1 && scope.row.complete_status === 0 && scope.row.is_lifting === 0">修改发货</el-button>
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.ordersn),showEditAddr=true" v-show="scope.row.pay_status === 1 && scope.row.complete_status === 0 && scope.row.is_lifting === 0">修改地址</el-button>
              <el-button
              size="small"
              type="primary"
              @click="checkWuLiu(scope.$index, scope.row.dispatch_type_code)" v-show="scope.row.pay_status === 1 && scope.row.send_status === 1 && scope.row.is_lifting === 0">查看物流</el-button>
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.ordersn),showTakeOver=true" v-show="scope.row.pay_status === 1 && scope.row.send_status === 1 && scope.row.complete_status === 0 && scope.row.is_lifting === 0">确认收货</el-button>
            <el-button
              size="small"
              type="primary"
              @click="edit(scope.$index, scope.row.ordersn),showTakeOver=true" v-show="scope.row.pay_status === 1 && scope.row.complete_status === 0 && scope.row.is_lifting === 1">确认收货</el-button>
<!--             <el-button
              size="small"
              type="danger"
              @click="edit(scope.$index, scope.row.ordersn)">删除订单</el-button> -->
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

    <el-dialog title="标记发货" v-model="showSend">
      <el-form ref="form"  label-width="100px" >
        <el-form-item label="收货地址">
          {{order.dispatch_province + order.dispatch_city + order.dispatch_area + order.dispatch_address}}
        </el-form-item>
        <el-form-item label="收货人">
          {{order.dispatch_name}}
        </el-form-item>
        <el-form-item label="联系方式">
          {{order.dispatch_tel}}
        </el-form-item>
        <el-form-item label="快递公司">
          <el-select v-model="order.dispatch_type_name" placeholder="请选择">
            <el-option
              v-for="(item,index) in dispatchTypeList"
              :label="item.name"
              :value="item.name"
              :key="index">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="快递单号">
          <el-input v-model="order.dispatch_type_code"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showSend = false">取 消</el-button>
        <el-button type="primary" @click="markSend()">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="修改发货" v-model="showEditSend">
      <el-form ref="form"  label-width="100px" >
        <el-form-item label="收货地址">
          {{order.dispatch_province + order.dispatch_city + order.dispatch_area + order.dispatch_address}}
        </el-form-item>
        <el-form-item label="收货人">
          {{order.dispatch_name}}
        </el-form-item>
        <el-form-item label="联系方式">
          {{order.dispatch_tel}}
        </el-form-item>
        <el-form-item label="快递公司">
          <el-select v-model="order.dispatch_type_name" placeholder="请选择">
            <el-option
              v-for="(item,index) in dispatchTypeList"
              :label="item.name"
              :value="item.name"
              :key="index">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="快递单号">
          <el-input v-model="order.dispatch_type_code"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showEditSend = false">取 消</el-button>
        <el-button type="primary" @click="editSend()">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="修改地址" v-model="showEditAddr">
      <el-form ref="form"  label-width="100px" >
        <el-form-item label="收货人">
          <el-input v-model="order.dispatch_name"></el-input>
        </el-form-item>
        <el-form-item label="联系电话">
          <el-input v-model="order.dispatch_tel"></el-input>
        </el-form-item>
        <el-form-item label="省份">
          <el-select v-model="order.dispatch_province" disabled>
            <el-option
              v-for="(item,index) in provinceList" :key="index"
              :label="item.name"
              :value="item.name">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="市">
          <el-select v-model="order.dispatch_city" @change="selectStoreAddr">
            <el-option
              v-for="(item,index) in cityList" :key="index"
              :label="item.name"
              :value="item.name">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="区/县">
          <el-select v-model="order.dispatch_area">
            <el-option
              v-for="(item,index) in areaList" :key="index"
              :label="item"
              :value="item">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="详细地址">
          <el-input v-model="order.dispatch_address"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showEditAddr = false">取 消</el-button>
        <el-button type="primary" @click="editAddr()">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="确认收货" v-model="showTakeOver">
      <div>一经确认，收益将发放。确定收货？</div>
      <div slot="footer" class="dialog-footer">
        <el-button @click="showTakeOver = false">取 消</el-button>
        <el-button type="primary" @click="takeOver()">确 定</el-button>
      </div>
    </el-dialog>

  </div>
</template>

<script>
import { getAdminOrderList, getAdminOrderDetail, getAdminDispatchTypeList } from '../../api/getData';
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
    orderList: [], // 商品列表
    order: {}, // 订单信息
    ordersn: '', // 订单编号
    index: -1, // 下标
    showSend: false, // 弹出标记发货界面
    showEditSend: false, // 弹出修改发货界面
    showEditAddr: false, // 弹出修改地址界面
    provinceList: [], // 省份列表
    cityList: [], // 市列表
    areaList: [], // 区域列表
    dispatchTypeList: [], // 快递公司列表
    showTakeOver: false, // 弹出收货界面
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
      if (self.provinceList[i].name === '广西区') {
        self.cityList = self.provinceList[i].cityList
        break
      }
    }
    this.getAdminDispatchTypeList()
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
    getOrderStatus (val) { // 获取订单状态
      if (val.refund_status === 1) {
        return '已退款'
      }
      if (val.close_status === 1) {
        return '已取消(支付超时)'
      }
      if (val.pay_status === 0) {
        return '待付款'
      }
      if (val.send_status === 0 && val.is_lifting === 0) {
        return '等待商家发货'
      }
      if (val.send_status === 0 && val.is_lifting === 1) {
        return '等待用户自提'
      }
      if (val.complete_status === 0) {
        return '商家已发货'
      }
      if (val.complete_status === 1) {
        return '交易完成'
      }
    },
    checkWuLiu (index, val) { // 查看物流信息
      window.location.href = 'http://m.kuaidi100.com/index_all.html?type=kdby&postid=' + val
    },
    edit (index, val) { // 编辑
      var self = this
      self.index = index
      self.ordersn = val
      self.order = self.orderList[self.index]
    },
    goToPage (index, val) { // 查看详情
      this.$router.push({path: prefixUrl + '/order/orderDetail', query: {ordersn: val}})
    },
    selectStoreAddr (val) { // 选择地址
      var self = this
      for (var i = self.cityList.length - 1; i >= 0; i--) {
        if (self.cityList[i].name === val) {
          self.areaList = self.cityList[i].areaList
        }
      }
    },
    getAdminDispatchTypeList () { // 获取快递公司列表
      var self = this
      getAdminDispatchTypeList().then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.dispatchTypeList = data.dispatchTypeList
        }
      })
    },
    markSend () { // 标记发货
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showSend = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      var object = {
        dispatch_type_name: self.order.dispatch_type_name,
        dispatch_type_code: self.order.dispatch_type_code
      }
      getAdminOrderDetail('markSend', self.ordersn, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.order.send_status = 1
          self.orderList.splice(self.index, 1, self.order)
          self.order = {}
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    },
    editSend () { // 修改发货
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showEditSend = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      var object = {
        dispatch_type_name: self.order.dispatch_type_name,
        dispatch_type_code: self.order.dispatch_type_code
      }
      getAdminOrderDetail('editSend', self.ordersn, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.orderList.splice(self.index, 1, self.order)
          self.order = {}
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    },
    editAddr () { // 修改地址
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showEditAddr = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      var object = {
        dispatch_name: self.order.dispatch_name,
        dispatch_tel: self.order.dispatch_tel,
        dispatch_province: self.order.dispatch_province,
        dispatch_city: self.order.dispatch_city,
        dispatch_area: self.order.dispatch_area,
        dispatch_address: self.order.dispatch_address,
      }
      getAdminOrderDetail('editAddr', self.ordersn, object).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.orderList.splice(self.index, 1, self.order)
          self.order = {}
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    },
    takeOver () { // 确定收货
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showTakeOver = false
      self.showLoadingText = '提交中'
      self.showLoading = true
      getAdminOrderDetail('takeOver', self.ordersn).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.order.send_status = 1
          self.order.complete_status = 1
          self.orderList.splice(self.index, 1, self.order)
          self.order = {}
        } else {
          this.$alert(response.msg, '', {
            confirmButtonText: '确定',
          })
        }
        self.isSubmit = true
        self.showLoading = false
      })
    },
    fetchData () {
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showLoading = true
      self.where = []
      var temp = {}
      if (!isEmpty(self.condition)) {
        temp = {
          key: 'ordersn',
          sign: '=',
          value: self.condition
        }
        self.where.push(temp)
      }
      if (!isEmpty(self.condition1)) {
        temp = {
          key: 'dispatch_name',
          sign: '=',
          value: self.condition1
        }
        self.where.push(temp)
      }
      getAdminOrderList(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
        if (response.code === 200) {
          var data = response.obj
          self.total = data.total
          self.orderList = data.orderList
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


