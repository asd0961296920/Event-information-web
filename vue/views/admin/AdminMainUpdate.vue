<script>
import MainTitle from "/views/main/MainTitle.vue";
// import AdminFormPost from "/views/admin/element/AdminFormPost.vue";
import AdminFormUpdate from "/views/admin/element/AdminFormUpdate.vue";
export default {
  components: {
    MainTitle,
    AdminFormUpdate,
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

    <AdminFormUpdate></AdminFormUpdate>
  </div>
</template>