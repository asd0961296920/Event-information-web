<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import MainTable from "/views/main/MainTable.vue";
export default {
  components: {
    MainTable,
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
  
    <MainTable></MainTable>
  
  
   </div>

  
</template>