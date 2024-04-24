<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
  components: {},
  data() {
    return {
      apiData: null,
    };
  },

  mounted() {
    // 在组件挂载后调用API
    this.fetchData();
  },
  methods: {
    fetchData() {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/htmlPython/list")
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.apiData = response.data;

          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
    WebClick(id) {
      window.location.href = "/admin/update/" + id;
    },
    Delete(id) {
      // 发起GET请求
      axios
        .delete(process.env.VUE_APP_APIURL + "/v1/htmlPython/delete/" + id)
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          window.location.reload();
          this.apiData = response.data;

          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
    Post_One(id) {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/automatic/post_one/"+id)
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

  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">編號</th>
            <th scope="col">名稱</th>
            <th scope="col">網址</th>
            <th scope="col">啟用狀態</th>
            <th scope="col">按鈕</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in apiData" :key="index">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.url }}</td>
            <td>
              <span v-if="item.enble" style="color: green">啟用</span>
              <span v-else style="color: red">未啟用</span>
            </td>
            <td>
              <button
                type="button"
                class="btn btn-outline-info"
                @click="WebClick(item.id)"
              >
                修改
              </button>
              <button
                type="button"
                class="btn btn-outline-info"
                @click="Delete(item.id)"
              >
                刪除
              </button>
              <button
                type="button"
                class="btn btn-outline-info"
                @click="Post_One(item.id)"
              >
                執行此網站爬蟲
              </button>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>