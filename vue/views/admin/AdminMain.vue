<script>
import MainTitle from "/views/main/components/MainTitle.vue";
// import AdminFormPost from "/views/admin/element/AdminFormPost.vue";
import AdminTable from "/views/admin/element/AdminTable.vue";
import Cookies from "/views/admin/element/Cookies.vue";
import axios from "axios";
export default {
  components: {
    MainTitle,
    AdminTable,
    Cookies
  },
  data() {
    return {
      searchQuery: "",
      isChecked: false,
      start: null,
    };
  },
  methods: {
    postData() {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/automatic/post")
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          alert("成功");

          console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },

    testClick() {
      window.open("/admin/post_text");
      // window.location.href = "/admin/post_text";
    },
    newClick() {
      window.location.href = "/admin/post";
    },

    logout(){
  localStorage.removeItem('token');
      window.location.href = "/admin/login";
    }
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
      <button
        type="button"
        @click="postData()"
        class="btn btn-outline-secondary m-1"
      >
        執行爬蟲
      </button>

        <button
        type="button"
        @click="logout()"
        class="btn btn-outline-secondary m-1"
      >
        登出
      </button>

      <AdminTable></AdminTable>
    </div>
  </div>
</template>