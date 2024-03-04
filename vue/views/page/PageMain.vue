<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import PageBody from "/views/page/PageBody.vue";
import MainTitle from "/views/main/MainTitle.vue";
export default {
  components: {
    PageBody,
    MainTitle
    
  },
  data() {
    return {
      searchQuery: "",
      isChecked: false,
      start: null,
    };
  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>

<div>
        <MainTitle></MainTitle>
      <PageBody></PageBody>
  
  
   </div>

  
</template>