<template>
  <div class="login">
    <div class="bg">
      <div class="login-box">
        <div class="rows">
          <img src="../../assets/img/login_tel2.png" alt="" class="img-tel">
          <input type="text" placeholder="请填写你的电话" v-model.trim="tel">
        </div>
        <div class="rows">
          <img src="../../assets/img/keyboard.png" alt="" class="img-tel">
          <input type="password" placeholder="请填写密码" v-model.trim="pwd">
        </div>
        <div class="btn" @touchstart="submit">
          <span>提交</span>
          <!--<router-link to='/oppoIndex' class="link">提交</router-link>-->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      isClick: false,
      tel: '',
      pwd: ''
    }
  },
  methods: {
    submit () {
      this.isClick = true
      // this.$http({ url: '/ajaxOppoIndex', params: {}, method: 'POST' }).then(function (response) {
      //   let result = response.data
      //   console.log(result)
      // }, function (response) {
      //   console.log(response)
      // })
      this.$http({url: '/ajaxOppoLogin', params: {tel: this.tel, pwd: this.pwd}, method: 'POST'}).then(function (response) {
        let result = response.data
        console.log(result)
        if (result.code === 200) {
          // alert('正确')
          this.$router.push({ name: 'oppoIndex' })
        } else if (result.code === 500) {
          alert('错误')
          this.tel = ''
          this.pwd = ''
        }
      }, function (response) {
        console.log(response)
        alert('你的账号或密码不正确')
      })
    }
  }
}
</script>


<style lang="less" scoped>
@import '../../assets/css/base.css';
* {
  margin: auto;
	max-width: 640px;
}

.login {}

div.bg {
  width: 100%;
  height: 100%;
  background: url(../../assets/img/login-bg.png) no-repeat;
  background-size: cover;
  background-position: 50%;
  position: absolute;
  top: 0px;
  left: 0px;
}

div.login-box {
  width: 100%;
  position: absolute;
  bottom: 1rem; // left: 50%;
  text-align: center; // padding: 0px 100px;
  line-height: .5rem;
}

div>input {
  width: 3rem;
  height: .4rem;
  outline: none;
  border: none;
  padding: 0px .15rem;
}

div.btn {
  width: 2rem;
  height: 1rem;
  background: url(../../assets/img/btn.png) no-repeat;
  background-size: 100%;
  line-height: .5rem;
  margin: 0 auto;
  color: white;
}

div.btn:active {
  width: 2rem;
  height: 1rem;
  background: url(../../assets/img/btn_s.png) no-repeat;
  background-size: 100%;
  line-height: .5rem;
  margin: 0 auto;
  color: white;
}

div.rows {
  height: .5rem;
  background: white;
  margin: .2rem 1.2rem;
  border: 1px solid #10b279;
  border-radius: 15px;
}

.img-tel {
  width: .4rem;
  height: .4rem;
  vertical-align: middle;
}
div>.link {
  color: white;
  text-decoration: none;
}
</style>
