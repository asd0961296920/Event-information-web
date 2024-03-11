<script>
import MainTitle from "/views/main/components/MainTitle.vue";
import Cookies from "/views/admin/element/Cookies.vue";
import axios from "axios";
export default {
  components: {
    MainTitle,
    Cookies
  },
  data() {
    return {

      apiData: {
        tag:null,
body_filter:null,
title_filter:"",
url:""
      },
      returnData:null
    };
  },
    methods: {

    fetchData() {
      // 发起GET请求
      axios
        .get(
          process.env.VUE_APP_APIURL +
            "/v1/automatic/post_text" + '?tag='+ this.apiData.tag+'&body_filter='+this.apiData.body_filter+'&title_filter='+this.apiData.title_filter+'&url='+this.apiData.url
        )
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
           this.returnData = response.data;
          
          // console.log(response);
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
    <Cookies></Cookies>
    <MainTitle></MainTitle>

    <div class="container">
  <div class="row">

    <div class="col">
<form class="needs-validation" @submit.prevent="fetchData">
<div class="mb-3 row">
  <label for="inputPassword" class="col-sm-2 col-form-label"
    >測試項目</label
  >
  <div class="col-sm-10">
    <select
      class="form-select form-select-sm"
      aria-label=".form-select-sm example"
      v-model="apiData.tag"
    >
      <option selected value="title">列表</option>
      <option  value="text">文章</option>
      <option  value="imager">圖片</option>
      <option  value="date">活動日期</option>
    </select>
  </div>
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">網址</label>
  <input type="text" v-model="apiData.url"  class="form-control" id="formGroupExampleInput" placeholder="網址">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">關鍵字</label>
  <input type="text" v-model="apiData.body_filter"  class="form-control" id="formGroupExampleInput" placeholder="關鍵字">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">關鍵字2(只有列表需要)</label>
  <input type="text" v-model="apiData.title_filter"  class="form-control" id="formGroupExampleInput" placeholder="關鍵字2(只有列表需要)">
</div>


  <button type="submit" class="btn btn-outline-secondary m-1">
    開始測試
  </button>

</form>


<div>
<p></p>
<span style="color: red;">測試結果：</span>
<p></p>
  {{returnData}}
</div>
    </div>

  </div>
</div>





  </div>
</template>