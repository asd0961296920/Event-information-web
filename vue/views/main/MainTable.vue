<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
  data() {
    return {
      apiData: null,
      page: 2,
      number: 5,
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
            "&&number=" +
            this.number
        )
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.apiData = response.data.posts.data;
          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <htmlTemplate></htmlTemplate>
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
        <tr v-for="(item, index) in this.apiData" :key="index">
          <th scope="row"></th>
          <td>{{ item.title }}</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>