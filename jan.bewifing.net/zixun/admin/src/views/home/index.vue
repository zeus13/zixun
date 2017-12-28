<template>
  <section>
  <div class="components-container" v-loading="showLoading" :element-loading-text="showLoadingText">
    大家好
  </div>

  </section>
</template>

<script>
import { isEmpty, getStamp } from '@/utils/utils'
import { prefixUrl } from '@/utils/env.js'
export default {
  data() {
   return {
    showLoading: false, // 页面加载
    showLoadingText: '拼命加载中', // 页面加载内容
   }
  },
  created() {
  },
  mounted () {
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
    initData () {
    }
  }
};
</script>

<style lang="less" scoped>
  #echarts-data{
    width: 100%;
    height: 400px;
  }
  .elRow{
    margin-left: -15px;
    margin-right: -15px;
  }
  .components-container {
      margin: 30px 50px;
      position: relative;
  }
  .grid-content{
    text-align: center;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 14px;
  }
  .grid-content h3{
    font-weight: 400;
    font-size: 15px;
    margin: 0 0 8px 0;
  }
  .grid-content p{
    font-size: 38px;
    font-weight: 700;
    margin: 0;
    white-space: nowrap;
    padding: 0;
  }

  .bg-purple{
    color: #fff;
    background: #333;
  }
  .bg-blue{
    color: #fff;
    background: #00c0ef;
    margin: 0 15px; 
  }
  .bg-success{
    color: #fff;
    background: #f39c12;
    margin: 0 15px; 
  }
  .bg-warning{
    color: #fff;
    background: #F7BA2A;
    margin: 0 15px; 
  }
  .bg-danger{
    color: #fff;
    background: #00a65a;
    margin: 0 15px; 
  }
  .echarts-box{
    border-top: 3px solid #00c0ef;  
    border-left: 1px solid #eee;
    margin-top: 30px;
    border-radius: 3px;
    box-shadow: 3px 3px 3px rgba(0,0,0,0.1);
  }
  .echarts-title{  
    color: #444;
    padding: 10px;
    font-size: 18px;
  }
</style>
