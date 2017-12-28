<template>
  <div  v-loading="showLoading" :element-loading-text="showLoadingText">
    <el-form ref="form" :model="goods" label-width="100px" style="padding:1.5rem;">
      <el-form-item label="分类(*)">
        <el-radio-group v-model="cat_name">
          <el-radio v-for="(item, index) in categoryList" :label="item.name" :key="index">{{item.name}}</el-radio>
        </el-radio-group>
      </el-form-item>
      <el-form-item label="商品名称(*)">
        <el-input v-model="goods.name"></el-input>
      </el-form-item>
      <el-form-item label="描述">
        <el-input type="textarea" v-model="goods.description"></el-input>
      </el-form-item>
      <el-form-item label="销售价格(*)">
        <el-input v-model="sale_price"></el-input>
      </el-form-item>
      <el-form-item label="市场价格">
        <el-input v-model="market_price"></el-input>
      </el-form-item>
      <el-form-item label="快递费">
        <el-input v-model="dispatch_price"></el-input>
      </el-form-item>
      <el-form-item label="基础销量">
        <el-input v-model="goods.base_sales_nums"></el-input>
      </el-form-item>
      <el-form-item label="库存(*)">
        <el-input v-model="goods.stock"></el-input>
      </el-form-item>
      <el-form-item label="超卖">
        <el-radio-group v-model="is_over_sold">
          <el-radio :label="0">否</el-radio>
          <el-radio :label="1">是</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="商品主图">
        <el-upload
          action="http://up.qiniu.com"
          list-type="picture-card"
          :on-success="handleSuccess1"
          :on-preview="handlePictureCardPreview1"
          :on-remove="handleRemove1"
          :data="qiniu"
          :file-list="picture1"
          >
          <i class="el-icon-plus"></i>
        </el-upload>
        <el-dialog v-model="dialogVisible1" size="tiny">
          <img width="100%" :src="dialogImageUrl1" alt="">
        </el-dialog>
      </el-form-item>

      <el-form-item label="商品图片">
        <el-upload
          action="http://up.qiniu.com"
          list-type="picture-card"
          :on-success="handleSuccess2"
          :on-preview="handlePictureCardPreview2"
          :on-remove="handleRemove2"
          :data="qiniu"
          :file-list="picture2"
          >
          <i class="el-icon-plus"></i>
        </el-upload>
        <el-dialog v-model="dialogVisible2" size="tiny">
          <img width="100%" :src="dialogImageUrl2" alt="">
        </el-dialog>
      </el-form-item>

      <el-form-item label="是否快递">
        <el-radio-group v-model="is_express">
          <el-radio :label="0">否</el-radio>
          <el-radio :label="1">是</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="上门服务">
        <el-radio-group v-model="is_go_door">
          <el-radio :label="0">否</el-radio>
          <el-radio :label="1">是</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="是否特价">
        <el-radio-group v-model="is_special">
          <el-radio :label="0">否</el-radio>
          <el-radio :label="1">是</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="金币上限">
        <el-input v-model="goods.gold_limit"></el-input>
      </el-form-item>

      <el-form-item label="上架">
        <el-radio-group v-model="is_on_sale">
          <el-radio :label="0">否</el-radio>
          <el-radio :label="1">是</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="排序（逆序）">
        <el-input v-model="goods.sort_order"></el-input>
      </el-form-item>

      <div style="margin:2rem 0 0 0">
        <el-form-item >
          <el-button type="primary" size="large" @click="update()">保存</el-button>
          <el-button type="" size="large" @click="back()">返回</el-button>
        </el-form-item>
      </div>

    </el-form>
  </div>
</template>

<script>
import { getQiNiuToken, getAdminGoodsDetail } from '../../api/getData'
import { getStamp, isEmpty } from '@/utils/utils'
import { prefixUrl, prefixApi } from '@/utils/env.js'
export default {
 data() {
   return {
    showLoading: true, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
    type: '', // 提交的类型
    isSubmit: true, // 防止多次提交
    qiniu: {}, // 七牛信息
    categoryList: [], // 分类列表
    goods: {}, // 商品信息
    goods_id: 0,
    cat_name: '', // 分类名称
    market_price: '', // 市场价格
    sale_price: '', // 销售价格
    dispatch_price: '', //邮费
    is_over_sold: 0, // 是否超卖
    is_express: 0, // 是否快递
    is_go_door: 0, // 是否上门
    is_special: 0, // 是否特价
    is_on_sale: 0, // 是否上线
    dialogImageUrl1: '', // 主视图-放大图片地址
    dialogVisible1: false, // 主视图-放大开关
    picture1: [], // 主视图列表-临时
    dialogImageUrl2: '', // 缩略图-放大图片地址
    dialogVisible2: false, // 缩略图-放大开关
    picture2: [], // 缩略图列表-临时
   }
 },
  created() {
    if (!isEmpty(this.$route.query.goods_id)) {
      this.goods_id = this.$route.query.goods_id
    }
    this.getQiNiuToken()
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
    handleSuccess1 (response, file, fileList) { // 主视图-上传成功
      var self = this
      var temp = 
      {
        name: '',
        url: self.qiniu.pre + response.key
      }
      self.picture1 = [temp]
    },
    handleRemove1 (file, fileList) { // 主视图-移除图片
      var self = this
      self.picture1 = fileList
    },
    handlePictureCardPreview1 (file) { // 主视图-放大图片
      var self = this
      self.dialogImageUrl1 = file.url
      self.dialogVisible1 = true
    },
    handleSuccess2 (response, file, fileList) { // 缩略图-上传成功
      var self = this
      var temp = 
      {
        name: '',
        url: self.qiniu.pre + response.key
      }
      self.picture2.push(temp)
    },
    handleRemove2 (file, fileList) { // 缩略图-移除图片
      var self = this
      self.picture2 = fileList
    },
    handlePictureCardPreview2 (file) { // 缩略图-放大图片
      var self = this
      self.dialogImageUrl2 = file.url
      self.dialogVisible2 = true
    },
    beautifyImageArr (val) { // 优化图片的数组
      var arr = []
      if (!isEmpty(val)) {
        for (var i = 0; i < val.length; i++) {
          var temp = {
            name: '',
            url: val[i]
          }
          arr.push(temp)
        }
      }
      return arr
    },
    saveImageArr (val) { // 保存数组
      var arr = []
      for (var i = 0; i < val.length; i++) {
        arr.push(val[i].url)
      }
      return arr
    },
    getCategoryId () { // 获取分类id
      var self = this
      for (var i = 0; i < self.categoryList.length; i++) {
        if (self.categoryList[i].name === self.cat_name) {
          return self.categoryList[i].id
        }
      }
    },
    back () { // 返回
      this.$router.go(-1)
    },
    update () { // 提交
      var self = this
      if (isEmpty(self.cat_name) || self.cat_name.replace(/(^\s*)|(\s*$)/g, '') === '') {
        this.$alert('分类不能为空', '', {
          confirmButtonText: '确定',
        })
        return
      }
      if (isEmpty(self.goods.name) || self.goods.name.replace(/(^\s*)|(\s*$)/g, '') === '') {
        this.$alert('商品名称不能为空', '', {
          confirmButtonText: '确定',
        })
        return
      }
      if (isEmpty(self.sale_price)) {
        this.$alert('销售价格不能为空', '', {
          confirmButtonText: '确定',
        })
        return
      }
      if (isEmpty(self.sale_price)) {
        this.$alert('销售价格不能为空', '', {
          confirmButtonText: '确定',
        })
        return
      }
      if (!/^\d+.?\d{0,2}$/.test(self.sale_price)) {
        this.$alert('销售价格格式不对', '', {
          confirmButtonText: '确定',
        })
        return
      }
      if (isEmpty(self.goods.stock)) {
        this.$alert('库存不能为空', '', {
          confirmButtonText: '确定',
        })
        return
      }
      if (!/^\d*$/.test(self.goods.stock)) {
        this.$alert('库存格式不对', '', {
          confirmButtonText: '确定',
        })
        return
      }
      self.goods.cat_id = self.getCategoryId()
      self.goods.cat_name = self.cat_name
      self.goods.market_price = self.market_price * 100
      self.goods.sale_price = self.sale_price * 100
      self.goods.dispatch_price = self.dispatch_price * 100
      self.goods.is_over_sold = self.is_over_sold
      self.goods.is_express = self.is_express
      self.goods.is_go_door = self.is_go_door
      self.goods.is_special = self.is_special
      self.goods.is_on_sale = self.is_on_sale
      if (!isEmpty(self.saveImageArr(self.picture1))) {
        var temp = self.saveImageArr(self.picture1)
        self.goods.main_img = temp[0]
      }
      if (!isEmpty(self.saveImageArr(self.picture2))) {
        var temp1 = self.saveImageArr(self.picture2)
        self.goods.goods_img_arr = temp1
      }
      self.type = 'update'
      self.showLoadingText = '提交中'
      self.fetchData()
    },
    getQiNiuToken () {
      var self = this
      getQiNiuToken().then(response => { // 获取七牛token
        self.qiniu = response.obj
      })
    },
    fetchData() {
      var self = this
      if (!self.isSubmit) {
        return
      }
      self.isSubmit = false
      self.showLoading = true
      getAdminGoodsDetail(self.type, self.goods_id, self.goods).then(response => {
        if (response.code === 200) {
          var data = response.obj
          if (self.type === '') { // 初始化
            self.categoryList = data.categoryList
            if (!isEmpty(data.goods)) { // 活动信息
              self.goods = data.goods
              self.market_price = self.goods.market_price / 100
              self.sale_price = self.goods.sale_price / 100
              self.dispatch_price = self.goods.dispatch_price / 100
              self.cat_name = self.goods.cat_name
              self.is_over_sold = self.goods.is_over_sold
              self.is_express = self.goods.is_express
              self.is_go_door = self.goods.is_go_door
              self.is_special = self.goods.is_special
              self.is_on_sale = self.goods.is_on_sale
              if (!isEmpty(self.goods.main_img)) {
                self.picture1 = self.beautifyImageArr([self.goods.main_img])
              }
              if (!isEmpty(self.goods.goods_text) && !isEmpty(self.goods.goods_text.goods_img_arr)) {
                self.picture2 = self.beautifyImageArr(self.goods.goods_text.goods_img_arr)
              }
            }
          }
          if (self.type === 'update') {
            self.goods_id = data['id']
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
</style>


