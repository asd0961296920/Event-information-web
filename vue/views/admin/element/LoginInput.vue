<script>
import axios from "axios";

export default {
  components: {},
  data() {
    return {
      login: null,
      password: null,
    };
  },
  mounted() {
    // this.fetchData();
  },
  methods: {
    loginData() {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/user?password=" + this.password)
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.login = response.data.login;

          if (this.login) {
            this.setCookie(response.data.token);
            alert("登入成功！");

            window.location.href = "/admin";
          } else {
            alert("密碼錯誤！（資料庫使用md5小寫32位utf8編碼）");
            console.log("資料庫使用md5小寫32位utf8編碼");
          }

          console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },

    setCookie(value) {
      localStorage.setItem("token", value);
    },
  },
  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <form class="needs-validation" @submit.prevent="loginData">
      <div class="container">
        <div class="row">
            <div class="col"></div>
          <div class="col">
            <p></p>
            <h2>使用者登入</h2>
            <div class="mb-3">
              <label for="formGroupExampleInput" class="form-label">請輸入密碼：</label>
              <input
                type="password"
                v-model="password"
                required
                class="form-control"
                id="formGroupExampleInput"
                placeholder="密碼"
              />
            </div>

            <button type="submit" class="btn btn-outline-secondary m-1">
              登入
            </button>
          </div>
          <div class="col"></div>
        </div>
      </div>
    </form>
  </div>
</template>