<script>
import MainTitle from "/views/main/components/MainTitle.vue";
import LoginInput from "/views/admin/element/LoginInput.vue";
export default {
  components: {
    MainTitle,
    LoginInput,
  },
  data() {
    return {
      searchQuery: "",
      isChecked: false,
      start: null,
    };
  },
  methods: {


  },
  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <MainTitle></MainTitle>
    <LoginInput></LoginInput>
  </div>
</template>