<script>
import MainTitle from "/views/main/MainTitle.vue";
// import AdminFormPost from "/views/admin/element/AdminFormPost.vue";
import AdminTable from "/views/admin/element/AdminTable.vue";
export default {
  components: {
    MainTitle,
    AdminTable,
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

    <AdminTable></AdminTable>
  </div>
</template>