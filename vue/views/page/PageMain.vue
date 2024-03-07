<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import PageBody from "/views/page/PageBody.vue";
import MainTitle from "/views/main/components/MainTitle.vue";
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

<div class="container">
  <div class="row">

    <div class="col-12">
      <PageBody></PageBody>
    </div>
  </div>
</div>




  
  
   </div>

  
</template>