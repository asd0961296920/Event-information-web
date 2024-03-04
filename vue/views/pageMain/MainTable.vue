<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
  data() {
    return {
      apiData: null,
      page: 1,
      number: 10,
      pageData: 0
    };
  },

  mounted() {
    // 在组件挂载后调用API
    const id = this.$route.params.id;
    this.fetchData(id);
  },
  methods: {
    fetchData(id) {
      // 发起GET请求
      axios
        .get(
          process.env.VUE_APP_APIURL +
            "/v1/post/list?page=" +
            this.page +
            "&&number=" +
            this.number +"&&city_id=" +id
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

  handlePageClick(pageNumber) {

    this.page = pageNumber;
    this.fetchData();

    }



  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">文章標題</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in apiData" :key="index">
          <th scope="row"></th>
          <td>{{ item.title }}</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
      </tbody>
    </table>



<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous" @click="handlePageClick(page > 1 ? page - 1 : 1)">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
<div v-for="counter in pageData.totalPages" :key="counter"> 
    <li class="page-item active" aria-current="page" v-if="counter == page">
      <a class="page-link" href="#" @click="handlePageClick(counter)">{{ counter }}</a>
      </li>
          <li class="page-item" v-else>
      <a class="page-link" href="#" @click="handlePageClick(counter)">{{ counter }}</a>
      </li>
</div>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next" @click="handlePageClick(page < pageData.totalPages ? page + 1 : pageData.totalPages)">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


  </div>
</template>