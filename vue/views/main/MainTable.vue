<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
import Table from "/views/main/components/Table.vue";
import PageNumber from "/views/main/components/PageNumber.vue";
export default {
      props: ['keyword'],
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
  let url = process.env.VUE_APP_APIURL + "/v1/post/list?page=" + this.page + "&number=" + this.number;

  if (this.keyword !== null) {
    url += '&keyword=' + this.keyword;
  }

      // 发起GET请求
      axios
        .get(url)
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
           this.pageData = response.data;
          this.apiData = response.data.posts.data;
         document.title ='全台灣最新活動';
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

  watch: {
    keyword() {
      this.fetchData();
    }

  },
};
</script>

<template>
  <div>
    <Table :apiData="apiData" />

 <PageNumber :pageData="pageData" @handlePageClick="PageData" />


  </div>
</template>