<script>
import axios from "axios";
export default {
  components: {},
  data() {
    return {
      apiData: null,
    };
  },
  mounted() {
    this.loginData();
  },
  methods: {
    loginData() {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/user/token")
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.apiData = response.data.token;
          // 在获取到 apiData 后调用 token 方法
          this.token();
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
    token() {
      if (this.apiData !== localStorage.getItem("token")) {
        window.location.href = "/admin/login";
      }
    },
  },
  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>
