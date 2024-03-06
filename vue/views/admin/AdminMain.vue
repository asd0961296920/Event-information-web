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
      newClick() {
      window.location.href = "/admin/post";
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
      <button
      type="button"
      @click="newClick()"
      class="btn btn-outline-secondary m-1"
    >
      新增網站
    </button>
    <AdminTable></AdminTable>
  </div>
</template>