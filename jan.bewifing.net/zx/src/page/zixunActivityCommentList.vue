<template>
<section class="commentList">
  <div v-if="!showXLoading">

    <div class="comment-head">
      <div class="thumbnail" v-bind:style="{ 'background': 'url(http://cmcccdn.bewifing.net/zixun/ticket/act1-simg.jpg) no-repeat','background-size':'cover','background-position':'50%'}"></div>
      <p>广西青年创意市集丨一元公益丨图书捐赠丨免费参与手绘艺术彩蛋</p>
      <span class="ch-left" @click="goToZixunActivityInfo()">查看活动详情</span><span class="ch-right"></span>
    </div>
    <div class="comments">
      <div class="title">活动评价 ( {{activityCommentList.length}} )</div>
      <div class="cont">
        <div class="cont-item" v-for="(item, index) in activityCommentList">
          <div class="cl-headimg">
            <img :src="item.mem_avatar">
          </div>
          <div class="cl-top">
            <p class="cl-name">{{item.mem_name}}</p>
            <p class="cl-thumb"><span>{{item.fans}}</span><svg t="1500019117038" class="icon-thumb" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1002" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M212.075 476.95c13.338 0 24.2-10.85 24.2-24.2 0-13.338-10.85-24.2-24.2-24.2-0.225 0-0.45 0.113-0.675 0.113l-57.775 0.175c-1.363-0.225-2.713-0.288-4.075-0.288-18.2 0-32.963 14.925-32.963 33.413L116.25 862.7c0 18.55 14.813 33.013 33.013 33.013 1.75 0 3.5 0.225 5.2 0H212.011v-0.225c12.388-0.45 22.388-10.513 22.388-22.95 0-12.613-9.95-22.613-22.388-23.175v-0.338h-47.1l1.363-372.075h45.8z m681.05-34.662c-17.813-29.113-43.763-40.825-75.2-42.125-1.587-0.175-3.275-0.338-4.975-0.338l-190.025-0.675c12.5-36.125 21.038-79.15 21.038-119.637 0-26.238-3-51.788-8.363-76.388l-0.512 0.063c-9.775-43.025-47.825-75.2-93.338-75.2-52.975 0-88.313 44.55-88.313 98.15 0 3.05-0.225 5.937 0 8.875-2.775 100.237-84.412 180.862-181.537 191.95v50.775l-0.738 205.575v212.462h9.9l462.525 0.225 8.088-0.225c17.862 0.113 27.925-4.412 44.15-14.925 15.437-9.95 27.087-23.525 34.712-38.95 2.088-3.112 3.675-6.5 4.688-10.4l71.287-318.475c0.963-3.737 1.25-7.575 0.963-11.313 1.475-20.125-3.038-40.937-14.35-59.424z m-30.25 48.912L786.15 831.325h-0.113c-2.375 5.65-6.337 10.688-11.875 14.25-3.85 2.55-8.137 3.962-12.437 4.638-1.413-0.225-2.825 0-4.237 0l-441.275-0.563-0.163-376.775c82.662-37.263 143.262-73.725 174.475-160.625 0.063 0 0.113 0.063 0.175 0.063 2.775-8.475 5.875-19.163 8.025-30.7 5.15-27.025 4.862-53.763 4.862-53.763-4.575-35.112 24.025-48.962 41.05-48.962 23.463 0.85 46.525 31.1 46.525 48.4 0 0 5.2 25.5 5.263 52.925 0.063 34.55-4.3 52.575-4.3 52.575h-0.512c-5.426 28.55-14.988 55.637-28.213 80.4l0.338 0.337c-2.15 4.463-3.45 9.438-3.45 14.7 0 18.487 17.7 20.125 35.9 20.125l220.837 0.225 13.512 0.45v0.063c11.2-0.626 22.388 4.75 28.838 15.212 5.087 8.312 5.937 18.087 3.225 26.8l0.275 0.1zM281.112 895.837h0.288c0.225 0 0.338-0.112-0.287-0.112-0.563 0-0.45 0.113-0.226 0.113h0.226z" p-id="1003"></path></svg></p>
          </div>
          <div class="cl-time">{{getBeautyTime(item.updated_at)}}</div>
          <div class="cl-description">{{item.content}}</div>
<!--           <div class="cl-photos clearfix">
            <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
            <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
            <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
            <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
            <div class="cl-photos-item" style="background-image:url(https://og00pefz8.qnssl.com/data/public/review/2017/07/03_16/14990608051824836.png!w3)"></div>
          </div> -->
        </div>

<!--         <div class="cont-item">
          <div class="cl-headimg">
            <img src="https://o3t7xuqlj.qnssl.com/m/images/userIcon-54efa0fc53.png">
          </div>
          <div class="cl-top">
            <p class="cl-name">boring_002</p>
            <p class="cl-thumb">前天</p>
          </div>
          <div class="cl-time">{{getBeautyTime(item.updated_at)}}</div>
          <div class="cl-description">超级棒的一次行程，给领队满分。</div>
          <div class="cl-photos clearfix"></div>
        </div> -->
      </div>
      <div class="more-comment">查看更多评价</div>
    </div>
  </div>
  <x-loading v-show="showXLoading"></x-loading>

</section>
  
</template>

<script>
import XLoading from '@/components/common/xLoading'
import { isEmpty, getBeautyTime } from '@/components/common/utils'
export default {
  components: {
    XLoading
  },
  data () {
    return {
      showXLoading: true, // 显示加载动画
      act_id: 0,
      activityCommentList: {} // 评论列表
    }
  },
  created () {
    if (!isEmpty(this.$route.query.act_id)) {
      this.act_id = this.$route.query.act_id
    } else {
      this.$router.go(-1)
    }
    this.initData()
  },
  mounted () {
  },
  computed: {
  },
  methods: {
    getBeautyTime (val) { // 个性化时间
      return getBeautyTime(val)
    },
    goToZixunActivityInfo () { // 跳转链接
      this.$router.push({name: 'zixunActivityInfo', query: {act_id: this.act_id}})
    },
    isEmpty (val) { // 判断是否为空
      return isEmpty(val)
    },
    // 初始化时获取基本数据
    async initData () {
      await this.$http({url: 'ajaxZixunActivityCommentList', params: {act_id: this.act_id}, method: 'POST'}).then(function (response) {
        let result = response.data
        if (result.code === 200 && !isEmpty(result.obj)) {
          var activityCommentList = result.obj.activityCommentList
          console.log(activityCommentList)
          this.activityCommentList = activityCommentList
        }
      }, function (response) {
        console.log(response)
      })
      this.showXLoading = false
    }
  },
  watch: {
  }
}
</script>
<style lang="less" scoped>
.commentList{
  color: #4d4d4d;
}
.comments .thumb-active span{
  font-size: .28rem;
  color: #fd8181;
}
.comments .thumb-active .icon-thumb{
  fill: #fd8181;
}
.icon-thumb{
  width: .4rem;
  height: .4rem;
  fill: #bfbfbf;    
  float: right;
  margin-top: .04rem;
  margin-left: .1rem;
}
.comment-head{
  min-height: 1.4rem;
  position: relative;
  border-bottom: 1px dotted #e8e8e8;
  padding-top: 1px;
}
.thumbnail{
  width: 1rem;
  height: 1rem;
  position: absolute;
  top: .2rem;
  left: .2rem;
}
.comment-head p{
  margin-top: .2rem;
  margin-left: 1.4rem;
  margin-bottom: .1rem;
  height: .62rem;
  display: block;
}
.comment-head .ch-left{
  margin-left: 1.4rem;    
  color: #517395;
  cursor: pointer;
  font-size: .2rem;
}
.comment-head .ch-right {
    display: inline-block;
    width: 6px;
    margin-left: 5px;
    margin-bottom: 0;
    border-right: 1px solid #517395;
    border-top: 1px solid #517395;
    transform: rotate(45deg);
    height: 6px;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
}
.comments{
  background: #fff;
}
.comments .title{
  line-height: .6rem;
  text-indent: .2rem;
  border-bottom: 1px solid #e8e8e8;
}
.comments .cont{
}
.comments .cont-item{
  padding: .3rem .2rem .3rem 0;
  margin-left: .2rem;
  position: relative;
  border-bottom: 1px solid #e8e8e8;
}
.comments .cl-headimg{
  width: .8rem;
  height: .8rem;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
}
.comments .cl-headimg img{
  width: 100%;
}
.comments .cl-top{
  margin-left: .9rem;
  position: relative;
}
.comments .cl-name{
  margin-bottom: 0;
  margin-right: 1.2rem;
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
  color: #b1b0b0;
}
.comments .cl-thumb{
  position: absolute;
  top: 0;
  right: 0;    
  height: .6rem;
  line-height: .6rem;
  color: #bfbfbf;
}
.comments .cl-time{
  margin-left: .9rem;
  color: #b1b0b0;
  font-size: .2rem;
}
.comments .cl-description{
  margin-left: .9rem;    
  margin-bottom: .1rem;
  margin-top: 3px;
}
.comments .cl-photos{
  margin-left: .9rem;
}
.comments .cl-photos-item{
  width: 1.1rem;
  height: 1.1rem;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  float: left;
  margin: 0 .1rem .1rem 0;
}
.more-comment{
  padding: .2rem;
  text-align: center;
  text-decoration: underline;
}
</style>
