<script>
import MainTitle from "/views/main/components/MainTitle.vue";
// import AdminFormPost from "/views/admin/element/AdminFormPost.vue";
import AdminFormUpdate from "/views/admin/element/AdminFormUpdate.vue";
import Cookies from "/views/admin/element/Cookies.vue";
export default {
  components: {
    MainTitle,
    AdminFormUpdate,
    Cookies
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
        <Cookies></Cookies>
    <MainTitle></MainTitle>
    <div class="container mt-2">
    <AdminFormUpdate></AdminFormUpdate>
      </div>
  </div>
</template>