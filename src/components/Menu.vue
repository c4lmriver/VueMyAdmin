<template>
  <a-layout-sider v-model:collapsed="collapsed" :trigger="null" :style="{ overflow: 'auto', height: '100vh', position: 'fixed', left: 0, top: 0, bottom: 0 }" collapsible>
    <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">

      <img v-if="collapsed" src="../assets/Vue_js_logo.png" class="vue_logo" alt="">
      <img v-else src="../assets/log_menu.png" class="vue_logo" alt="">

       <a-sub-menu v-for="(database, key1) in databases" :key="key1" @click="showTables(database.Database)">
        <template #title>
          <span>
            <DatabaseOutlined />
            <span>{{ database.Database }}</span>
          </span>
        </template>
        <a-menu-item v-for="(table, key2) in tables[database.Database]" :key="key1 * 1000 + key2" @click="showTableData(table[0], database.Database), showStructure(table[0], database.Database)" class="table">
            <TableOutlined />
            <span>{{ table[0] }}</span>
        </a-menu-item>
      </a-sub-menu>

      <menu-unfold-outlined v-if="collapsed" class="trigger" @click="() => (collapsed = !collapsed)" />
      <menu-fold-outlined v-else class="trigger" @click="() => (collapsed = !collapsed)" />
    </a-menu>
  </a-layout-sider>
</template>


<script>
import axios from 'axios';
import { DatabaseOutlined, TableOutlined, MenuFoldOutlined, MenuUnfoldOutlined } from '@ant-design/icons-vue';
import { defineComponent, ref } from 'vue';

const API_URL = 'http://localhost/db.php';

export default defineComponent({
  components: {
    DatabaseOutlined,
    TableOutlined,
    MenuUnfoldOutlined,
    MenuFoldOutlined,
  },
  props: {
    databases: Array
  },
  data() {
    return {
      selectedKeys: ref(['1']),
      collapsed: ref(false),
      tables: [],
      selectedDatabase: ref(''),
    }
  },
  methods: {
    showTables(databaseName) {
      if (this.selectedDatabase != databaseName) {
        this.selectedDatabase = databaseName;
        axios.get(`${API_URL}?database=${databaseName}`)
        .then(response => {
          this.tables[databaseName]= response.data;
          this.$emit('changeTables', this.tables[databaseName]);
          this.currentDb = databaseName;
          this.currentTable = '';
          this.$emit('changeCurrentDB', this.currentDb);
          this.$emit('changeCurrentTable', this.currentTable);

          // réinitialisation du contenu et de la structure lors du changement de table
          this.tableColumns = [];
          this.tableRows = [];
          this.structureColumns = [];
          this.structureRows = [];
          this.$emit('changeTableColumns', this.tableColumns);
          this.$emit('changeTableRows', this.tableRows);          
          this.$emit('changeStructureColumns', this.structureColumns);
          this.$emit('changeStructureRows', this.structureRows);

        })
        .catch(error => {
          console.error(error);
        });
      }
    },
    showStructure(tableName) {
      axios.get(`${API_URL}?database=${this.selectedDatabase}&table=${tableName}&structure=true`)
      .then(response => {
        this.structureColumns = Object.keys(response.data[0]);
        this.structureRows = response.data;
        this.$emit('changeStructureColumns', this.structureColumns);
        this.$emit('changeStructureRows', this.structureRows);
      })
      .catch(error => {
        console.error(error);
      });
    },
    showTableData(tableName, selectedDatabase) {

      if (this.selectedDatabase !== selectedDatabase) {
        this.showTables(selectedDatabase);
      }
      axios.get(`${API_URL}?database=${this.selectedDatabase}&table=${tableName}`)
        .then(response => {
          this.tableColumns = Object.keys(response.data[0]);
          this.tableRows = response.data;
          this.currentTable = tableName;
          this.$emit('changeTableColumns', this.tableColumns);
          this.$emit('changeTableRows', this.tableRows);
          this.$emit('changeCurrentTable', this.currentTable);
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
});
</script>


<style>
.ant-menu-item-selected {
    background-color: #41b883 !important;
}

.trigger {
  font-size: 25px;
  margin: 25px auto 0 25px;
  position: fixed;
  bottom: 5vh;
}

.vue_logo {
  margin: 25px auto 50px 15px;
  height: 40px;

}

.table {
  margin-bottom: -1px !important;
  margin-top: -1px !important;
  padding-left: 32px !important;
  line-height: 30px !important; 
  height: 30px !important; 
}
</style>
