<script>
import axios from "axios";
export default {
  data() {
    return {
      Data: null,
     apiData: null,
      keyword:null
    };
  },

  mounted() {
    // 在组件挂载后调用API
    this.fetchData();
  },
  methods: {
    fetchData() {
      // 发起GET请求
      axios
        .get(
          process.env.VUE_APP_APIURL +
            "/v1/area/list" 
        )
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.apiData = response.data;
          
          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },


    search() {
this.keyword = this.Data;
  if(this.keyword === '後台' || this.keyword === '後臺'){
window.location.href = "/admin";
  }
    this.$emit('search', this.keyword);

    },
    city(id) {
window.location.href = "/city/"+id;

    },



  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">台灣即時活動</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" v-for="(item, index) in apiData" :key="index">

        <li class="nav-item">
          <a class="nav-link" href="#" @click="city(item.id)">{{item.city}}</a>
        </li>

      </ul>
      <form class="d-flex" @submit.prevent="search">
        <input class="form-control me-2" type="search" placeholder="請輸入關鍵字" aria-label="Search" v-model="Data">
        <button class="btn btn-outline-success" type="submit">查詢</button>
      </form>
    </div>
  </div>
</nav>





  </div>
</template>