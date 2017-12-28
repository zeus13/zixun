<template>
  <div v-loading="showLoading" :element-loading-text="showLoadingText">

    <div style="padding: 24px;">


    <el-form :inline="true" class="demo-form-inline" >
      <el-form :inline="true" class="demo-form-inline">
        <el-form-item label="ID">
          <el-input v-model="condition" placeholder="ID"></el-input>
        </el-form-item>
        <el-form-item label="商品名称">
          <el-input v-model="condition1" placeholder="商品名称"></el-input>
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
          width="120"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.id }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="商品名称"
          width="240"
          align="center">
          <template scope="scope">
            <div>{{ scope.row.name }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="分类"
          width="120"
          align="center"
          column-key="cat_name"
          prop="cat_name"
          :filters="categoryList"
          >
          <template scope="scope">
            <div>{{ scope.row.cat_name }}</div>
          </template>
        </el-table-column>

        <el-table-column
          label="价格"
          width="100"
          align="center"
          sortable
          prop="sale_price"
          >
          <template scope="scope">
            <span>{{ scope.row.sale_price / 100 }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="基础销量"
          width="100"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.base_sales_nums }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="实际销量"
          width="100"
          align="center">
          <template scope="scope">
            <span>{{ scope.row.sell_amount }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="库存"
          width="100"
          align="center"
          sortable
          prop="stock"
          >
          <template scope="scope">
            <span>{{ scope.row.stock }}</span>
          </template>
        </el-table-column>

        <el-table-column
          label="流量（PV）"
          width="140"
          align="center"
          sortable
          prop="pv"
          >
          <template scope="scope">
            <span>{{ scope.row.pv }}</span>
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
              @click="edit(scope.$index, scope.row.id)">编辑</el-button>
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
import { getAdminGoodsList, getAdminCategoryList } from '../../api/getData';
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
    this.getAdminCategoryList()
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
    getAdminCategoryList () { // 获取分类列表
      var self = this
      getAdminCategoryList().then(response => {
        if (response.code === 200) {
          var data = response.obj
          if (!isEmpty(data.categoryList)) {
            for (var i = 0; i < data.categoryList.length; i++) {
              self.categoryList.push({ text: data.categoryList[i].name, value: data.categoryList[i].name })
            }
          }
        }
      })
    },
    edit (index, val) { // 编辑
      console.log(val)
      this.$router.push({path: prefixUrl + '/goods/goodsDetail', query: {goods_id: val}})
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
      getAdminGoodsList(self.where, self.whereIn, self.orderBy, self.pageSize, self.page, self.time).then(response => {
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


