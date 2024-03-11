<script>
import MainTitle from "/views/main/components/MainTitle.vue";
import LoginInput from "/views/admin/element/LoginInput.vue";
import NullCookies from "/views/admin/element/NullCookies.vue";
export default {
  components: {
    MainTitle,
    LoginInput,
    NullCookies
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
        <NullCookies></NullCookies>
    <MainTitle></MainTitle>
    <LoginInput></LoginInput>
  </div>
</template>