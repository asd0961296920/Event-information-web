<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
import Table from "/views/main/components/Table.vue";
import PageNumber from "/views/main/components/PageNumber.vue";
export default {
      props: ['keyword'],
    components: {
    Table,
    PageNumber
  },
  data() {
    return {
      apiData: null,
      page: 1,
      number: 10,
      pageData: 0,
      currentPage: 1,
      moth:null,
      year:null,
      yearsArray:null
    };
  },

  mounted() {
    // 在组件挂载后调用API
    this.fetchData();
    this.yeardate();
  },
  methods: {
    fetchData() {
 let url = process.env.VUE_APP_APIURL + "/v1/post/list?page=" + this.page + "&number=" + this.number;
if(this.year == "null"){
this.year =null;
}

if(this.moth == "null"){
  this.moth =null;
}

  if(this.moth != null && this.year != null){
       url = process.env.VUE_APP_APIURL + "/v1/post/list?page=" + this.page + "&number=" + this.number +"&moth="+this.moth+"&year="+this.year;
  }else if(this.moth == null && this.year){
       url = process.env.VUE_APP_APIURL + "/v1/post/list?page=" + this.page + "&number=" + this.number +"&year="+this.year;
  }else if(this.moth && this.year == null){
       url = process.env.VUE_APP_APIURL + "/v1/post/list?page=" + this.page + "&number=" + this.number+"&moth="+this.moth;
  }else{
 url = process.env.VUE_APP_APIURL + "/v1/post/list?page=" + this.page + "&number=" + this.number;
  } 




  if (this.keyword !== null) {
    url += '&keyword=' + this.keyword;
  }

      // 发起GET请求
      axios
        .get(url)
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
           this.pageData = response.data;
          this.apiData = response.data.posts.data;
         document.title ='全台灣最新活動';
          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
  PageClick(id) {
window.location.href = "/page/"+id;
    },
    PageData(number){
      this.page = number;
      this.fetchData();
    },
     yeardate() {
let now = new Date();
let year = now.getFullYear();

this.yearsArray = [year+1, year, year-1,year-2,year-3];

     }


  },

  watch: {
    keyword() {
      this.fetchData();
    }

  },
};
</script>

<template>
  <div>




<div class="container">
  <div class="row">
    <div class="col">

      <select class="form-select form-select-sm" aria-label=".form-select-sm example" v-model="year" @change="fetchData">
        <option selected value=null >請選擇年份</option>
<option v-for="(item, index) in this.yearsArray" :key="index" :value="item">{{item}}</option>

      </select>

    </div>
    <div class="col">

    <select class="form-select form-select-sm" aria-label=".form-select-sm example" v-model="moth" @change="fetchData">
      <option selected  value=null >請選擇月份</option>
      <option value=1>一月</option>
      <option value=2>二月</option>
      <option value=3>三月</option>
        <option value=4>四月</option>
      <option value=5>五月</option>
      <option value=6>六月</option>
        <option value=7>七月</option>
      <option value=8>八月</option>
      <option value=9>九月</option>
        <option value=10>十月</option>
      <option value=11>十一月</option>
      <option value=12>十二月</option>
    </select>


    </div>

  </div>
</div>



    <Table :apiData="apiData" />

 <PageNumber :pageData="pageData" @handlePageClick="PageData" />


  </div>
</template>