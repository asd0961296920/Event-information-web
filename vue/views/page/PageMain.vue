<script>
// import textImager from "/src/layouts/easterEggs/textImager";
import PageBody from "/views/page/PageBody.vue";
import MainTitle from "/views/main/components/MainTitle.vue";
import Advertise3 from "/views/main/components/Advertise3.vue";
import Advertise2 from "/views/main/components/Advertise2.vue";
export default {
  components: {
    PageBody,
    MainTitle,
    Advertise3,
    Advertise2
    
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

    <div class="col">
      <Advertise3></Advertise3>
    </div>
  </div>
  <div class="row">

    <div class="col-10">
      <PageBody></PageBody>
    </div>
        <div class="col">
      <Advertise2></Advertise2>
    </div>
  </div>
</div>




  
  
   </div>

  
</template>