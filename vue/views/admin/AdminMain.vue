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
  methods: {
    testClick() {
      window.location.href = "/admin/post_text";
    },
  },
  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <MainTitle></MainTitle>
    <button
      type="button"
      @click="testClick()"
      class="btn btn-outline-secondary m-1"
    >
      單獨測試環境
    </button>
    <AdminTable></AdminTable>
  </div>
</template>