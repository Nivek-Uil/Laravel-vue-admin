<template>
  <div class="dashboard-container">
    <el-card class="box-card">
      <div class="dashboard-text">name: {{ name }}</div>
    </el-card>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Dashboard',
  computed: {
    ...mapGetters([
      'name'
    ])
  }
}
</script>

<style lang="scss" scoped>
.dashboard {
  &-container {
    /*margin: 0px;*/
  }
  &-text {
    font-size: 30px;
    line-height: 46px;
  }
}
.box-card{
  margin: 10px;
  min-height: 900px;
}
</style>
