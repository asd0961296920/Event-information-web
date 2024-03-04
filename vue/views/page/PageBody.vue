<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
  data() {
    return {
      apiData: null,
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
            "/v1/post/show/" + id

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
    }



  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div v-if="apiData">
 <h1>{{ apiData.title }}</h1>
<div>

{{apiData.post_text}}

</div>

  </div>
</template>