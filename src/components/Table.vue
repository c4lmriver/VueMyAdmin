<template>
  <div>
    <div class="container" :class="container">
    <table class="ant-table">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column" class="ant-table-thead-th">{{ column }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in rows" :key="row.id">
          <td v-for="(cell, key) in row" :key="key + ' ' + cell" class="ant-table-tbody-td">{{ cell }}</td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</template>

<script>
export default {
props: ['columns', 'rows'],

data: () => ({
  nbOfLinesToDisplay: 20
}),

computed: {
  container() {
    if (this.rows.length > this.nbOfLinesToDisplay) {
      return 'scrollbar-enabled';
    } else {
      return 'scrollbar-disabled';
    }
  }
}
}

</script>

<style>
.scrollbar-enabled {
  height: 300px;
  overflow-y: scroll;
}
.scrollbar-disabled {
  overflow-y: visible;
}
.ant-table {
width: 100%;
height: 40px;
border-collapse: collapse;
overflow: scroll;
}
.ant-table-thead-th {
font-weight: bold;
background-color: #fafafa;
text-align: left;
padding: 8px;
}
.ant-table-tbody-td {
border: 1px solid #e8e8e8;
padding: 8px;
}
</style>