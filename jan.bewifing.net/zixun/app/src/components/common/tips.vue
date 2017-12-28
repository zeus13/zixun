<template>
<section class="tips">
    <div class="content"><i class="fa fa-warning"></i> {{content}}</div>
</section>
</template>

<script>
export default {
  props: {
    content: ''
  },
  methods: {
  }
}
</script>

<style lang="less">
.tips{
  width: 100%;
  height: 100%;
  position: absolute;
  display: -webkit-flex; /* Safari */
  display: flex;
  justify-content: center;
  align-items: center;
  -webkit-justify-content: center;
  -webkit-align-items: center;
  font-size: 1.4rem;
}
.content{
  padding: 0 20px;
  text-align: center;
}
</style>