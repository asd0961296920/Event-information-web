<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import MainTable from "/views/city/CityTable.vue";
import MainTitle from "/views/main/components/MainTitle.vue";
export default {
  components: {
    MainTable,
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
    <MainTable></MainTable>
  
  
   </div>

  
</template>