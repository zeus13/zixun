<template>
<div>
  <div class="oppoAppeal"></div>
      <div class="masklayer">
      <div class="bg-1">
        <img src="../../assets/img/bg-top3.png" alt="" class="bg-top">
          <div class="input-b">
            <img src="../../assets/img/chuanma.png" class="img-chuanma" alt="">
            <input type="text" class="input" v-model.trim="string_code" maxlength="11">
          </div>
        <div class="txt">该串码有误或已被其他业务元使用。如有疑问，请填写申诉理由，并提交。</div>
        <div>
          <img src="../../assets/img/anger.png" class="img-anger" alt="">
          <img src="../../assets/img/line.png" class="img-line" alt="">
        </div>
        <div class="div-b">
          <div class="div-bb">
          <textarea name="" id="" placeholder="填写申诉理由" v-model.trim="content" maxlength="255"></textarea>
          </div>
        </div>
        <div class="btn" @click="submit">
          <span>提交申诉</span>
        </div>
      </div>
      </div>
</div>
</template>
<script>
export default {
  data () {
    return {
      ok: false,
      isClick: false,
      string_code: '',
      content: ''
    }
  },
  methods: {
    submit () {
      this.isClick = true
      if (this.string_code === '') {
        alert('乖，别闹！请输入串码')
      } else if (this.content === '') {
        alert('宝贝竟然都来了，你不写点什么我怎么知道你要申诉什么呢')
      } else {
        this.$http({url: '/ajaxOppoAppeal', params: {'tel': this.tel, 'string_code': this.string_code, 'content': this.content}, method: 'POST'}).then((response) => {
          // 响应成功
          let result = response.data
          if (result.code === 500) {
            alert('请登陆')
            this.$router.go(-1)
          } else if (result.code === 200) {
            this.$router.push('/oppoAppealSuccess')
          }
        }, (response) => {
          // 相应失败
        })
      }
    }
  }
}
</script>

<style lang="less" scoped>
@import '../../assets/css/base.css';
* {
  padding: 0;
  margin: 0;
}

.oppoAppeal {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/bg3.png) no-repeat;
  background-size: cover;
  position: absolute;
  z-index: -1;
  top: 0;
}
.masklayer {
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  z-index: 4;
  position: absolute;
  top: 0;
  left: 0;
}
.bg-1 {
  height: 8rem;
  background: #feea7b;
  margin: 1rem 20px 0 20px;
  border-radius: 5px;
  z-index: 5;
}
.bg-top {
  width: 100%;
  height: 20px;
  background-size: 100%;
  position: relative;
  top: -14px;
}
.input-b {
  margin: .1rem .45rem;
  height: .9rem;
  line-height: 1rem;
  background: white;
  border-radius: 10px;
}
.input {
  width: 70%;
  height: .5rem;
  position: relative;
  top: 3px;
  left: -22px;
  font-size: 20px;
  outline: none;
  border: none;
}
.img-chuanma {
  width: 2rem;
  height: 0.5rem;
  position: relative;
  top: -0.4rem;
  left: 50%;
  margin-left: -1rem;
}
.txt {
  margin: .1rem .45rem;
  width: 4rem;
}
.img-line {
  width: 100%;
  height: .05rem;
  background-size: 100%;
  position: relative;
  top: 0.35rem;
  display: block;
}
.img-anger {
  width: 2rem;
  height: 2rem;
  background-size: 100%;
  position: absolute;
  top: 2.5rem;
  right: .4rem;
}
.div-b {
  height: 4.5rem;
  background: white;
  position: relative;
  top: .35rem;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  padding: .2rem .45rem;
}
div.btn {
  width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 8.5rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  color: white;
  padding-top: .1rem;
}
div.btn:active {
    width: 3rem;
  height: 1rem;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 8.5rem;
  left: 50%;
  margin-left: -1.5rem;
  background: url(../../assets/img/btn_s.png) no-repeat;
  background-size: 100%;
  font-size: 0.35rem;
  color: white;
  padding-top: .1rem;
}
.div-bb {
  pading: 10px 10px;
}
textarea {
  width: 100%;
  height: 3.5rem;
  border-radius: 5px;
  resize: none;
  font-size: 16px;
  padding: 10px;
  box-sizing: border-box;
  overflow: hidden;
}
.f-10 {
  font-size: .1rem;
}
.f-12{
  font-size: .2rem;
}
.f-15 {
  font-size: .35rem;
}
</style>
