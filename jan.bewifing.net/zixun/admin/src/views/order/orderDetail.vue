<template>
  <div  v-loading="showLoading" :element-loading-text="showLoadingText">
    <el-form ref="form" :model="order" label-width="100px" style="padding:1.5rem;">
      <div class="title"><span>订单信息</span></div>
      <el-row>
        <el-col :span="24" >订单编号：<span>{{order.ordersn}}</span></el-col>
        <el-col :span="24" >订单状态：<span>{{getOrderStatus(order)}}</span></el-col>
        <el-col :span="24" >付款方式：<span>石斛花</span></el-col>
        <el-col :span="24" >订单总价：<span>{{order.total_price / 100}}</span></el-col>
        <el-col :span="24" >配送方式：<span>{{order.is_lifting === 1 ? '自提' : '快递'}}</span></el-col>
        <el-col :span="24" v-show="order.is_lifting === 0">快递方式：<span>{{order.ordersn}}</span></el-col>
        <el-col :span="24" >买家信息：<span>{{order.member_name}}</span></el-col>
        <el-col :span="24" >收件人/手机号码/收货地址：<span>{{order.dispatch_name}}&nbsp;&nbsp;{{order.dispatch_tel}}&nbsp;&nbsp;{{order.dispatch_province}}&nbsp;&nbsp;{{order.dispatch_city}}&nbsp;&nbsp;{{order.dispatch_area}}&nbsp;&nbsp;{{order.dispatch_address}}</span></el-col>
        <el-col :span="24" >买家留言<span>{{order.remark}}</span></el-col>
      </el-row>
      <div class="title"><span>订单信息</span></div>
      <el-row>
        <el-col :span="24" >商品分类：<span>{{order.cat_name}}</span></el-col>
        <el-col :span="24" >商品名称：<span>{{order.goods_name}}</span></el-col>
        <el-col :span="24" >购买数量：<span>{{order.goods_amount}}</span></el-col>
        <el-col :span="24" >商品总价：<span>{{order.goods_price / 100}}</span></el-col>
        <el-col :span="24" >快递总价：<span>{{order.dispatch_price / 100}}</span></el-col>
      </el-row>

      <div style="margin:20px;">
        <el-button @click="back">返回</el-button>
      </div>
    </el-form> 
  </div>
</template>

<script>
import { getAdminOrderDetail } from '../../api/getData'
import { getStamp, isEmpty } from '@/utils/utils'
import { prefixUrl, prefixApi } from '@/utils/env.js'
export default {
 data() {
   return {
    showLoading: true, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
    type: '', // 提交的类型
    isSubmit: true, // 防止多次提交
    order: {},
    ordersn: ''
  }
 },
  created() {
    if (!isEmpty(this.$route.query.ordersn)) {
      this.ordersn = this.$route.query.ordersn
    } else {
      this.$router.go(-1)
    }
  },
  mounted () {
    this.fetchData()
  },
  computed: {
  },
  methods: {
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    getStamp (val, type) { // 时间戳转日期
      return getStamp(val, type)
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
    back () { // 返回
      this.$router.go(-1)
    },
    fetchData() {
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showLoading = true
      getAdminOrderDetail(self.type, self.ordersn).then(response => {
        if (response.code === 200) {
          var data = response.obj
          if (self.type === '') { // 初始化
            if (!isEmpty(data.order)) { // 活动信息
              self.order = data.order
            }
          }
          if (self.type === 'update') {
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
};
</script>

<style lang="less" scoped>
  .title{
    width: 100%;
    height: 30px;
    background-color:#324157;
    line-height: 30px;
    color: #fff;
    padding-left: 10px;
  }
  .el-col {
    margin: 15px 0;
    padding-left: 20px;
    span {
      margin-left: 15px;
    }
  }
</style>


