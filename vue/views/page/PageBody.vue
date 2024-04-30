<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
  data() {
    return {
      apiData: null,
      post: null
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
           this.post = this.apiData.post_text;

          this.post = this.post.replace(/\s/g, "<br>");
          document.title =this.apiData.title;
          console.log(this.apiData.post_text);
          this. insertMetaTags();
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
          insertMetaTags() {
      // 创建 meta 标签
      const metaTags = [
        { property: 'og:title', content: this.apiData.title },
        { property: 'og:description', content: this.apiData.post_text.substring(0, 100) },
        { property: 'og:image', content: this.apiData.imager1 },
        { property: 'og:url', content: process.env.VUE_APP_URL + "/page/"+this.apiData.id},
        { property: 'og:type', content: this.apiData.title }
      ];

      // 插入 meta 标签到头部
      metaTags.forEach(tag => {
        const metaTag = document.createElement('meta');
        metaTag.setAttribute('property', tag.property);
        metaTag.setAttribute('content', tag.content);
        document.head.appendChild(metaTag);
      });
    }



  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
<div v-if="apiData">
  <h2>{{ apiData.title }}</h2>

<img v-if="apiData.imager1 != null" :src="apiData.imager1" :alt="apiData.title">

  <div v-html="post"></div>
</div>
</template>