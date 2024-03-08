<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import MainTable from "/views/main/MainTable.vue";
import MainTitle from "/views/main/components/MainTitle.vue";
import Advertise1 from "/views/main/components/Advertise1.vue";
import Advertise2 from "/views/main/components/Advertise2.vue";
export default {
  components: {
    MainTable,
    MainTitle,
    Advertise1,
    Advertise2,

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
          <Advertise1></Advertise1>
    </div>
 </div>
  <div class="row mt-3">

    <div class="col">
    <MainTable :keyword="keyword" />

    </div>
    <div class="col-2">
          <Advertise2></Advertise2>

    </div>
  </div>

  
  
   </div>

  
</template>