<template>
  <div class="regionList">
    <div class="head"><img src="../assets/img/1.png" class="head-img"></div>
    <div class="list">
      <div class="list-title">南宁青秀赛区</div>
      <div class="list-rows">
        <div class="row">
          <div class="search-box">
            <input type="text" class="input">
            <span class="search">搜索</span>
          </div>
        </div>
        <div class="row2">
          <div class="row2-item1">默认排序</div>
          <div class="row2-item2">按票数排序</div>
        </div>
        <div class="teamList">
          <div class="teamList-item" @click="gotoTeamInfo">
            <div class="teamList-img"></div>
            <div class="teamList-text">
              <div class="teamName">夕阳红战队</div>
              <div class="row3 clearfix">
                <span class="row3-left">当前票数</span>
                <div class="row3-right">
                  <span class="ticketNum">100000票</span>
                  <span class="btn-vote">投票</span>
                </div>
              </div>
            </div>
          </div>
          <div class="teamList-item">
            <div class="teamList-img"></div>
            <div class="teamList-text">
              <div class="teamName">夕阳红战队</div>
              <div class="row3 clearfix">
                <span class="row3-left">当前票数</span>
                <div class="row3-right">
                  <span class="ticketNum">100票</span>
                  <span class="btn-vote">投票</span>
                </div>
              </div>
            </div>
          </div>
          <div class="teamList-item">
            <div class="teamList-img"></div>
            <div class="teamList-text">
              <div class="teamName">夕阳红战队</div>
              <div class="row3 clearfix">
                <span class="row3-left">当前票数</span>
                <div class="row3-right">
                  <span class="ticketNum">100票</span>
                  <span class="btn-vote">投票</span>
                </div>
              </div>
            </div>
          </div>
          <div class="teamList-item">
            <div class="teamList-img"></div>
            <div class="teamList-text">
              <div class="teamName">夕阳红战队</div>
              <div class="row3 clearfix">
                <span class="row3-left">当前票数</span>
                <div class="row3-right">
                  <span class="ticketNum">100票</span>
                  <span class="btn-vote">投票</span>
                </div>
              </div>
            </div>
          </div>
          <div class="teamList-item">
            <div class="teamList-img"></div>
            <div class="teamList-text">
              <div class="teamName">夕阳红战队</div>
              <div class="row3 clearfix">
                <span class="row3-left">当前票数</span>
                <div class="row3-right">
                  <span class="ticketNum">100票</span>
                  <span class="btn-vote">投票</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pd-02">
      <div class="content-box-body-title">
        <div class="line" style="border-bottom: 1px solid white;"></div>
        <div class="content-box-body-title-text line-text" style="">主办方</div>
      </div>
      <div class="qrcode clearfix">
        <div class="qrcode-item">
          <img src="../assets/img/qrcode4.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">下载小象嗨TV</div>
            <div class="fs-015">手机直播看电视</div>
          </div>
        </div>
        <div class="qrcode-item">
          <img src="../assets/img/qrcode2.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">关注广西广电网络</div>
            <div class="fs-015">每天投1票</div>
          </div>
        </div>
        <div class="qrcode-item">
          <img src="../assets/img/qrcode1.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">关注超级点子王</div>
            <div class="fs-015">每天投1票</div>
          </div>
        </div>
        <div class="qrcode-item">
          <img src="../assets/img/qrcode3.jpg" class="qrcode-img">
          <div class="qrcode-text">
            <div class="fs-016">关注社区大明星</div>
            <div class="fs-015">了解更多比赛信息</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {}
  },
  methods: {
    gotoTeamInfo () {
      return this.$router.push('/test5')
    }
  }
}
</script>
<style scoped>
.teamName {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.btn-vote {
  float: right;
  padding: 0 .1rem;
  border: 1px solid #ffd526;
  border-radius: 10px;
}
.teamList-text {
  background: #ea5924;
  color: white;
}
.teamList-img {
  width: 100%;
  height: 2rem;
  background: url('../assets/img/404.jpg');
  background-size: 100%;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  border: 1px solid #f9f7f7;
}
.teamList-item {
  width: 2.6rem;
  background: white;
  margin: .1rem;
  padding: .1rem;
  border-radius: 5px;
}
.teamList {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.regionList {
  padding-bottom: 1rem;
  width:100%;
  height:100%;
  position: relative;
  top: 0;
  left: 0;
  background: -moz-linear-gradient(top, #558cc5, #63346a, #2c293c); /* 想要多少种颜色，在后面加上就可以了*/
  background: -o-linear-gradient(top, #558cc5, #63346a, #2c293c);
  background: -webkit-linear-gradient(top, #558cc5, #63346a, #2c293c);
}
.head {
  width: 100%;
}
.head-img {
  width: 100%;
  height: 100%;
}
.list-rows {
  padding: .2rem;
}
.list {
  margin: .2rem;
  background: #f5f4f4;
  border-radius: 5px;
}
.list-title {
  color: white;
  padding: .12rem;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  background: -moz-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -o-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -webkit-linear-gradient(left, #e72627, #f65a10, #fd8201);
}
.list-title::before {
  content: '';
  display: inline-block;
  width: .3rem;
  height: .3rem;
  background: url('../assets/img/10.png');
  background-size: 100%;
  position: relative;
  top: .04rem;
  margin-right: .05rem;
}
.row {
  padding: .2rem 0 .4rem 0;
  position: relative;
}
.row2 {
  display: flex;
  flex-direction: row;
  border-top: 1px solid #d23045;
  border-bottom: 1px solid #d23045;
  padding: .1rem;
  margin-bottom: .4rem;
}
.row2-item1 {
  flex-grow: 1;
  text-align: right;
  padding-right: .4rem;
}
.row2-item1::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../assets/img/15.png') no-repeat;
  background-size: 100%;
  vertical-align: middle;
  margin-right: .1rem;
}
.row2-item2 {
  flex-grow: 1;
  text-align: left;
  padding-left: .4rem;
}
.row2-item2::before {
  content: '';
  display: inline-block;
  width: .25rem;
  height: .25rem;
  background: url('../assets/img/16.png') no-repeat;
  background-size: 100%;
  vertical-align: middle;
  margin-right: .1rem;
}
.row3 {
  border-top: 1px solid #d23045;
  padding: .05rem;
  font-size: .2rem
}
.row3-left {
  float: left;
  width: .45rem;
  text-align: center;
}
.row3-right {
  float: left;
  width: 1.7rem;
  margin-top: .15rem;
  margin-left: .05rem;
}
.search-box {
  border: 2px solid #d23045;
  border-radius: 5px;
}
.input {
  width: 70%;
  height: .6rem;
  line-height: .6rem;
  outline: none;
  border: none;
  font-size: .28rem;
  margin-right: 25%;
  margin: .01rem 0;
  background: #f5f4f4;
}
.search {
  display: inline-block;
  width: 25%;
  height: .67rem;
  line-height: .67rem;
  text-align: center;
  position: absolute;
  top: .2rem;
  right: 0;
  border-radius: 5px;
  z-index: 2;
  background: -moz-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -o-linear-gradient(left, #e72627, #f65a10, #fd8201);
  background: -webkit-linear-gradient(left, #e72627, #f65a10, #fd8201);
  color: white;
}
.search::before {
  content: '';
  display: inline-block;
  width: .2rem;
  height: .2rem;
  background: url('../assets/img/11.png') no-repeat;
  background-size: 100%;
  margin-right: .05rem;
}
.teamName {
  padding: .1rem;
}

.content-box-body-title {
  height: .6rem;
  position: relative;
  line-height: .6rem;
  font-size: .26rem;
}
.content-box-body-title-text {
  width: 1.8rem;
  text-align: center;
  position: absolute;
  top: 0;
  left: 50%;
  margin-left: -.9rem;
  z-index: 5;
  background: white;
  color: #f11728;
  font-weight: bolder;
}
.line {
  width: 100%;
  border-bottom: 1px solid #e43b47;
  padding-top: .3rem;
  z-index: 0;
}
.qrcode-img {
  width: 1rem;
  height: 1rem;
}
.qrcode-text {
  color: white;
  text-align: center;
}
.qrcode {
  width: 100%;
  padding: .15rem 0;
}
.qrcode-item {
  width: 1.5rem;
  float: left;
  text-align: center;
}
.line-text {
  background: #362b44;
  width: 1.4rem;
  color: white;
}
.fs-02 { font-size: .2rem; }
.fs-016 { font-size: .16rem; }
.fs-015 { font-size: .15rem; }
.fw { font-weight: bolder; }
.c-red { color: #e43b47; }
.pd-02 { padding: .2rem; }
</style>
