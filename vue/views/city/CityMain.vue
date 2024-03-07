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
<div class="row mt-3">
    <div class="col">
Column
    </div>
 </div>
  <div class="row mt-3">

    <div class="col">
    <MainTable></MainTable>
    </div>
    <div class="col-2">
      Column
    </div>
  </div>


  
  
   </div>

  
</template>