<template>
    <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff'}">
      <!-- <a-breadcrumb style="margin: 16px 0" v-if="currentDb !== ''">
        <a-breadcrumb-item>{{ currentDb }}</a-breadcrumb-item>
        <a-breadcrumb-item>{{ currentTable }}</a-breadcrumb-item>
      </a-breadcrumb> -->

      <h3 v-if="currentDb !== '' && currentTable !== ''">Exécuter une ou des requêtes SQL sur la table "<strong>{{ currentTable }}</strong>.<strong>{{ currentDb }}</strong>" :</h3>
      <h3 v-else-if="currentDb !== ''">Exécuter une ou des requêtes SQL sur la base de données "<strong>{{ currentDb }}</strong>" :</h3>
      <h3 v-else>Exécuter une ou des requêtes SQL sur le serveur <strong>MySQL</strong> :</h3>


      <div class="inline">
        <div id="left-part">
            <textarea name="" cols="30" rows="10" v-model="structRequest"></textarea>
            <div>
                <a-button class="ant-button" v-if="currentDb !== '' && currentTable !== ''" @click="btnSelect()">Select</a-button>
                <a-button class="ant-button" v-if="currentDb !== '' && currentTable !== ''" @click="btnInsert()">Insert</a-button>
                <a-button class="ant-button" v-if="currentDb !== '' && currentTable !== ''" @click="btnUpdate()">Update</a-button>
                <a-button class="ant-button" v-if="currentDb !== '' && currentTable !== ''" @click="btnDelete()">Delete</a-button>
                <a-button class="ant-button" v-if="currentDb !== '' && currentTable == ''" @click="btnGrant()">Grant</a-button>
                <a-button class="ant-button" v-if="currentDb !== '' && currentTable == ''" @click="btnCreate()">Create</a-button>
            </div>
        </div>
        
        <div class="container_request" :class="container_request">
        <table class="request-table" v-if="currentDb !== ''">
            <thead>
                <tr>
                    <th class="request-table-thead-th" v-if="currentDb !== '' && currentTable !== ''">Attribut(s)</th>
                    <th class="request-table-thead-th" v-else>Table(s)</th>                
                </tr>
            </thead>
            <tbody v-if="currentDb !== '' && currentTable !== ''">
                <tr v-for="column in columns" :key="column">
                    <td class="request-table-tbody-td">{{ column }}</td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr v-for="table in tables" :key="table">
                    <td class="request-table-tbody-td">{{ table[0] }}</td>
                </tr>
            </tbody>
        </table>
        </div>

      </div>
      <a-button type="primary" id="btn-exec" @click="execSQLRequest()">Exécuter</a-button>

      <!-- <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">
        <Table :columns="columns" :rows="rows"></Table>
      </div> -->
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
        tables: Array,
        currentDb: '',
        currentTable: ''
    },
    data: () => ({
        nbOfLinesToDisplay: 20,
        structRequest: ''
    }),
    methods: {
        btnSelect() {
            this.structRequest = "SELECT ... FROM ... WHERE ... ;";
        },
        btnInsert() {
            this.structRequest = "INSERT INTO ... (...) VALUES (...) ;";
        },
        btnUpdate () {
            this.structRequest = "UPDATE ... SET ... WHERE ... ;";
        },
        btnDelete() {
            this.structRequest = "DELETE FROM ... WHERE ... ;";
        },
        btnGrant() {
            this.structRequest = "GRANT ... ON ... TO {...} [WITH GRANT OPTION]";
        },
        btnCreate() {
            this.structRequest = "CREATE TABLE ... (colonne1 type_donnees, colonne2 type_donnees, ...)";
        },
        // execSQLRequest() {
        //     const mysql = require('mysql2');
        //     const connection = mysql.createConnection({
        //         host: 'localhost',
        //         user: 'root',
        //         password: '',
        //         database: ''
        //     });
        // }
    },
    computed: {
        container_request() {
            if (this.columns.length > this.nbOfLinesToDisplay) {
                return 'scrollbar-enabled';
            } else {
                return 'scrollbar-disabled';
            }
        },

    }
}
</script>
  
  
<style>

h3 {
    margin-bottom: 30px !important;
}

.container_request {
    width: 17%;
    margin-left: 15%;
    display: relative;
    max-height: 250px;
    /* border-collapse: collapse; */
    overflow: auto;
}

.request-table {
    width: 100%;
}

.scrollbar-enabled {
  height: 500px;
  overflow-y: scroll;
}

.scrollbar-disabled {
  overflow-y: visible;
}

.request-table-thead-th {
    font-weight: bold;
    background-color: #fafafa;
    text-align: left;
    padding: 8px;
}

.request-table-tbody-td {
    border: 1px solid #e8e8e8;
    padding: 8px;
    }

.inline {
    display: flex;
    max-height: 40vh;
    margin-bottom: 30px;
}

#left-part {
    width: 60%;
}

textarea {
    width: 100%;
    margin-bottom: 20px !important;
}

.ant-button {
    margin-right: 20px;
    border-radius: 7px !important;
}

.ant-button:hover {
    color: #41b883 !important;
    border-color: #41b883 !important;
}

.ant-button:focus {
    color: #41b883 !important;
    border-color: #41b883 !important;
}

#btn-exec {
    background-color: #41b883;
    border-color: #41b883;
    border-radius: 7px ;
    height:  40px;
    font-size: medium;
    margin-left: 90%;
}

</style>