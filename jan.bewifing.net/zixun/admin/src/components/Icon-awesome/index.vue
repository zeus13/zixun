<template>
  <i class="fa fa-fw" :class="iconClass" slot="icon" aria-hidden="true"></i>
</template>

<script>
  export default {
    name: 'icon-svg',
    props: {
      iconClass: {
        type: String,
        required: true
      }
    },
    computed: {
    }
  }
</script>
<style lang="less" scoped>
i{
  font-size: 16px;
}
</style>