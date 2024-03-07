<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
import Table from "/views/main/components/Table.vue";
import PageNumber from "/views/main/components/PageNumber.vue";
export default {
    components: {
    Table,
    PageNumber
  },
  data() {
    return {
      apiData: null,
      page: 1,
      number: 10,
      pageData: 0,
      currentPage: 1,
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
            "/v1/post/list?page=" +
            this.page +
            "&number=" +
            this.number
        )
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
           this.pageData = response.data;
          this.apiData = response.data.posts.data;
          
          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
  PageClick(id) {
window.location.href = "/page/"+id;
    },
    PageData(number){
      this.page = number;
      this.fetchData();
    }


  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {
  },
};
</script>

<template>
  <div>
    <Table :apiData="apiData" />

 <PageNumber :pageData="pageData" @handlePageClick="PageData" />


  </div>
</template>