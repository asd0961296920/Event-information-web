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
      chrome:false,
    };
  },
       mounted() {
this.user();
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
    },


        chrome_post() {
          axios
        .post(process.env.VUE_APP_APIURL + "/v1/user/chrome", {
          chrome: this.chrome
        })
        .then((response) => {
          // 处理成功的情况

          console.log("Item status updated successfully:", response.data);

        })
        .catch((error) => {
          // 处理错误
          console.error("Error updating item status:", error);
        });
    },


    user() {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/user/get_user")
        .then((response) => {
        
          this.chrome = response.data.chrome;
          console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },


chrome_ture(){
  if(this.chrome)
  {
this.chrome =false
  }else{
    this.chrome = true
  }
  this.chrome_post();

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

<div class="mb-3 row">
  <label for="inputPassword" class="col-sm-3 col-form-label"
    >啟用chrome</label
  >
  <div class="col-sm-9">
    <div class="form-check form-switch m-2">
      <input
        class="form-check-input"
        type="checkbox"
        role="switch"
        id="flexSwitchCheckDefault"
        :checked="chrome"
        @change="chrome_ture"
      />
    </div>
  </div>
</div>


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