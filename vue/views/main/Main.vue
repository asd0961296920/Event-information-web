<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import MainTable from "/views/main/MainTable.vue";
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
      keyword:null
    };
  },
    methods: {
    search(data){
      this.keyword = data;
    }


    },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>

<div>

          <MainTitle @search="search" />
<div class="row mt-3">
    <div class="col">
Column
    </div>
 </div>
  <div class="row mt-3">

    <div class="col">
    <MainTable :keyword="keyword" />

    </div>
    <div class="col-2">
      Column
    </div>
  </div>

  
  
   </div>

  
</template>