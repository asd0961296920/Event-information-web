<script>
import axios from "axios";
export default {
    components: {
  },
  data() {
    return {
      apiData:{},
      returnData:'爬取中請稍候...',

    };
  },

  mounted() {
    // 在组件挂载后调用API
this.apiData = JSON.parse(this.$route.query.apiData);
this.testData();
  },
  methods: {
    testData() {
      // 发起GET请求
      axios
        .post(process.env.VUE_APP_APIURL + `/v1/automatic/test`, {
          name: this.apiData.name,
          title_filter: this.apiData.title_filter,
          body_filter: this.apiData.body_filter,
          imager1_filter: this.apiData.imager1_filter,
          url: this.apiData.url,
          connect_url: this.apiData.connect_url,
          post_filter: this.apiData.post_filter,
          table_page: this.apiData.table_page,
          page_bool: this.apiData.page_bool,
          page: this.apiData.page,
          enble: this.apiData.enble,
          imager_url: this.apiData.imager_url,
          imager_bool: this.apiData.imager_bool,
          area_id: this.apiData.area_id,
           event_date_filter: this.apiData.event_date_filter,
        })
        .then((response) => {
          // 处理成功的情况
          this.returnData = response.data;
          console.log("Item status updated successfully:", response.data);
          // window.location.reload();
        })
        .catch((error) => {
          // 处理错误
          // this.showErrorModal();
          console.error("Error updating item status:", error);
          alert("輸入數據錯誤\n" + error.response.data.message);
          window.close();
        });
    },



  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
<div>
  <p v-if="typeof returnData === 'string'">{{returnData}}</p>
  <div class="container" v-else>
    <div class="row">
      <div class="col">
        <p>標題列表</p>
        <div v-if="Array.isArray(returnData.list_data)">
          <p v-for="(item, index) in returnData.list_data" :key="index">
            {{item}}
          </p>
        </div>
      </div>
      <div class="col">
        <p>內容</p>
        <div v-if="Array.isArray(returnData.text_data)">
          <p v-for="(item, index) in returnData.text_data" :key="index">
            {{item}}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

</template>