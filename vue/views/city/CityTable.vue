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
    const id = this.$route.params.id;
    this.fetchData(id);
    this.yeardate();
  },
  methods: {
    fetchData(id) {
  let url = process.env.VUE_APP_APIURL +
            "/v1/post/list?page=" +
            this.page +
            "&number=" +
            this.number +"&city_id=" +id;


if(this.year == "null"){
this.year =null;
}

if(this.moth == "null"){
  this.moth =null;
}

  if(this.moth != null && this.year != null){
       url = process.env.VUE_APP_APIURL +
            "/v1/post/list?page=" +
            this.page +
            "&number=" +
            this.number +"&city_id=" +id+"&moth="+this.moth+"&year="+this.year;
  }else if(this.moth == null && this.year){
       url = process.env.VUE_APP_APIURL +
            "/v1/post/list?page=" +
            this.page +
            "&number=" +
            this.number +"&city_id=" +id+"&year="+this.year;
  }else if(this.moth && this.year == null){
       url = process.env.VUE_APP_APIURL +
            "/v1/post/list?page=" +
            this.page +
            "&number=" +
            this.number +"&city_id=" +id+"&moth="+this.moth;
  }else{
url = process.env.VUE_APP_APIURL +
            "/v1/post/list?page=" +
            this.page +
            "&number=" +
            this.number +"&city_id=" +id;

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
          if (this.apiData && this.apiData.length > 0) {
           document.title ='全'+ this.apiData[0].area.city + '最新活動總覽';
          }
          this.insertMetaTags();
          console.log(id);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
    PageData(number){
      this.page = number;
      this.fetchData(this.$route.params.id);
    },
         yeardate() {
let now = new Date();
let year = now.getFullYear();

this.yearsArray = [year+1, year, year-1,year-2,year-3];

     },
    insertMetaTags() {
      // 创建 meta 标签
      const metaTags = [
        { property: 'og:title', content: '全'+ this.apiData[0].area.city + '最新活動總覽' },
        { property: 'og:url', content: process.env.VUE_APP_APIURL + "/city/"+this.$route.params.id},
        { property: 'og:type', content: '全'+ this.apiData[0].area.city + '最新活動總覽' }
      ];

      // 插入 meta 标签到头部
      metaTags.forEach(tag => {
        const metaTag = document.createElement('meta');
        metaTag.setAttribute('property', tag.property);
        metaTag.setAttribute('content', tag.content);
        document.head.appendChild(metaTag);
      });
    }



  },
  watch: {
    keyword() {
      this.fetchData(this.$route.params.id);
    },
  },
  // 计算属性，用于根据搜索条件过滤数据
  computed: {

  },
};
</script>

<template>
  <div>




<div class="container">
  <div class="row">
    <div class="col">

      <select class="form-select form-select-sm" aria-label=".form-select-sm example" v-model="year" @change="fetchData(this.$route.params.id)">
        <option selected value=null >請選擇年份</option>
        <option v-for="(item, index) in this.yearsArray" :key="index" :value="item">{{item}}</option>

      </select>

    </div>
    <div class="col">

    <select class="form-select form-select-sm" aria-label=".form-select-sm example" v-model="moth" @change="fetchData(this.$route.params.id)">
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