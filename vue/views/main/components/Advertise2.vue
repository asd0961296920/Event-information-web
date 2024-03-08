<script>
import axios from "axios";
export default {
  data() {
    return {
      htmlData:null
    };
  },

  mounted() {
    this.fetchData();
  },
  methods: {

            fetchData() {
  let url = process.env.VUE_APP_APIURL + "/v1/post/js";


      // 发起GET请求
      axios
        .get(url)
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
           this.htmlData = response.data.js2;
          // console.log(this.htmlData);
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

<div v-html="htmlData"></div>

  </div>
</template>