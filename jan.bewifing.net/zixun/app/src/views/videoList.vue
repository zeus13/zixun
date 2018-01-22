<template>
  <section class="wrapper">
    <div class="videoList clearfix">
      <div class="videoItem" v-for="(item, index) in videoList" @click="playVideoFun(item)">
        <div class="videoImg" :style="{'background': 'url('+ item.avatarPath +') 50% center / cover no-repeat'}"></div>
        <p>{{item.title}}</p>
      </div>
    </div>
    <div class="videoMask" v-if="isVideo && !isEmpty(videoConfig)">
      <img src="../assets/img/close-empty.svg" class="close-btn" @click="closeVideoFun">
      <video id="myPlayer" :poster="videoConfig.avatarPath" controls playsInline webkit-playsinline autoplay>
        <source v-if="!isEmpty(videoConfig.rtmpUrl)" :src="videoConfig.rtmpUrl" type="rtmp/flv" />
        <source :src="videoConfig.hlsUrl" type="application/x-mpegURL" />
      </video>
    </div>
    <div class="support"> / 技术支持 / 南宁好无聊</div>
    <transition name="loading">
      <x-loading v-show="showXLoading"></x-loading>
    </transition>
    <popup :type="popupType" :msg="popupMsg" :icon="popupIcon" @closePopupFun="closePopupFun" v-show="showPopup"></popup>
    <loading :show="showLoading" :text="showLoadingText"></loading>
  </section>
</template>

<script>
import XLoading from '@/components/common/xLoading'
import Popup from '@/components/common/popup'
import { isEmpty, getStamp } from '../utils/utils'
import { getVideoList } from '../api/getData'
import { Loading } from 'vux'
import EZUIPlayer from 'EZUIPlayer'
import { prefixUrl } from '@/utils/env'

export default {
  components: {
    XLoading,
    Loading,
    Popup
  },
  data () {
    return {
      showXLoading: false, // 显示加载动画
      showLoading: false,
      showLoadingText: '',
      showPopup: false, // 是否显示弹窗
      popupType: '', // 是否显示弹窗
      popupMsg: '', // 弹窗提示语
      popupIcon: 0, // 弹窗icon仅支持0,1,2
      type: '', // 提交类型
      isVideo: false, // 是否显示视频
      videoConfig: [], // 视频信息
      videoList: [{ // 视频列表
        id: 1,
        rtmpUrl: 'rtmp://rtmp.open.ys7.com/openlive/54d9faca4f8f4c39b09a7cbc37e52710',
        hlsUrl: 'http://hls.open.ys7.com/openlive/54d9faca4f8f4c39b09a7cbc37e52710.m3u8',
        avatarPath: require('../assets/img/video1.jpg'),
        title: '南宁好无聊现场直播'
      }, {
        id: 2,
        rtmpUrl: 'rtmp://rtmp.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b',
        hlsUrl: 'http://hls.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b.m3u8',
        avatarPath: require('../assets/img/video2.jpg'),
        title: '钦州南珠东杨帆大道路口路况直播'
      }, {
        id: 3,
        rtmpUrl: 'rtmp://rtmp.open.ys7.com/openlive/d89d850dbc5949028255dc7034d4ad93',
        hlsUrl: 'http://hls.open.ys7.com/openlive/d89d850dbc5949028255dc7034d4ad93.m3u8',
        avatarPath: 'https://pics.yangyangla.com/spjt/1712141616101cdbfbca.jpg@300W_300H_65Q',
        title: '门口'
      }, {
        id: 4,
        rtmpUrl: 'rtmp://rtmp.open.ys7.com/openlive/3fb6a7b038ed4f65812537a03a803185',
        hlsUrl: 'http://hls.open.ys7.com/openlive/3fb6a7b038ed4f65812537a03a803185.m3u8',
        avatarPath: 'https://pics.yangyangla.com/spjt/17121416341586d6f89a.jpg@300W_300H_65Q',
        title: '里面'
      }, {
        id: 5,
        rtmpUrl: '',
        hlsUrl: 'http://18h836974z.51mypc.cn:36345/live/Stream00011.stream/CuPlayer.m3u8',
        avatarPath: 'https://pics.yangyangla.com/spjt/17121416061578c90b56.jpg@300W_300H_65Q',
        title: '实时视频位置：东山橙园 DS-11 单元 '
      }, {
        id: 6,
        rtmpUrl: '',
        hlsUrl: 'http://18h836974z.51mypc.cn:36345/live/Stream00014.stream/CuPlayer.m3u8',
        avatarPath: 'https://pics.yangyangla.com/spjt/17121416124270000ae8.jpg@300W_300H_65Q',
        title: '实时视频位置：东山橙园 DS-14 单元 '
      }]
    }
  },
  created () {
    console.log('asdf')
    this.fetchData()
  },
  mounted () {
  },
  updated () {
    console.log(this.videoConfig)
    if (!isEmpty(this.videoConfig)) {
      var player = new EZUIPlayer('myPlayer')
      console.log(player)
      // player.on('error', function () {
      //   console.log('error')
      // })
      // player.on('play', function () {
      //   console.log('play')
      // })
      // player.on('pause', function () {
      //   console.log('pause')
      // })
    }
  },
  computed: {
  },
  methods: {
    getStamp (val, type) {
      return getStamp(val, type)
    },
    isEmpty (val) {
      return isEmpty(val)
    },
    openPopupFun (type, msg, icon, back) {
      this.popupType = type
      this.popupMsg = msg
      this.popupIcon = icon
      this.showPopup = true
    },
    closePopupFun () { // 关闭弹窗方法
      this.showPopup = false
    },
    goToInfo (val) { // 前往商品详情
      console.log(val)
      this.$router.push({path: prefixUrl + '/goodsInfo', query: {goods_id: val}})
    },
    playVideoFun (arr) {
      var self = this
      self.isVideo = true
      self.videoConfig = arr
    },
    closeVideoFun () {
      var self = this
      self.isVideo = false
      self.videoConfig = []
    },
    fetchData () {
      var self = this
      getVideoList().then(response => {
        var data = response.data
        console.log(data)
        if (data.code === '200') {
          console.log(data.obj)
          // self.videoList = data.obj
        } else {
          self.openPopupFun('alert', data.msg, 2)
        }
        self.showXLoading = false
      })
    }
  }
}
</script>

<style lang="less" scoped>
video {
  width: 100%;
}
.wrapper {
  max-width: 640px;
  margin: 0 auto;
}
.videoList {
  width: 100%;
  padding: 0 6px;
}
.videoItem {
  float: left;
  width: 50%;
  padding: 16px 8px;
}
.videoItem img {
  width: 100%;
}
.videoImg {
  width: 100%;
  height: 2rem;
  background: url('../assets/img/video1.jpg') no-repeat;
  background-position: 50%;
  background-size: cover;
}
.videoItem p {
  font-size: .24rem;
  overflow: hidden;
  height: .3rem;
}
.support {
  font-size: .2rem;
  font-family: "Microsoft YaHei", Arial, sans-serif;
  color: rgb(156, 156, 156);
  margin: 0 0 10px;
  text-align: center;
  width: 100%;
  max-width: 640px;
  position: absolute;
  bottom: 0;
}
.videoMask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  z-index: 9;
  display: -webkit-flex; /* Safari */
  display: flex;
  -webkit-justify-content: center;
  -webkit-align-items: center;
  justify-content: center;
  align-items: center;
}
.close-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  width: .5rem;
  height: .5rem;
  z-index: 10;
}
</style>

