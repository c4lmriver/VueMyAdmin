<template>
  <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff' }">
    <a-breadcrumb style="margin: 16px 0">
      <a-breadcrumb-item>{{ currentDb }}</a-breadcrumb-item>
      <a-breadcrumb-item>{{ currentTable }}</a-breadcrumb-item>
    </a-breadcrumb>
    <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">
      <Table :columns="columns" :rows="rows"></Table>
    </div>
  </a-layout-content>
</template>


<script>
import Table from './Table.vue';
export default {
    components: {
        Table,
    },
    props: {
        columns: Array,
        rows: Array,
        currentDb: '',
        currentTable: ''
    }

}

</script>


<style>

Table {
    max-height: 60vh;
}

</style>