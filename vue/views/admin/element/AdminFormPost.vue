<script>
import axios from "axios";

export default {
    components: {

  },
  data() {
    return {
      apiData: {
        name: null,
        title_filter: null,
        body_filter: null,
        imager1_filter: null,
        url: null,
        connect_url: null,
        post_filter: null,
        table_page: null,
        page_bool: false,
        page: null,
        enble: true,
        imager_url: null,
        imager_bool: true,
        area_id: null,
        event_date_filter: null,
      },
      area:null,
    };
  },
  created() {
    // 在组件创建时调用 addBlock 方法
    // this.addBlock();
  },
  mounted() {
    // 在组件挂载后调用API
        this.areaData();
  },
  methods: {
    areaData() {
      // 发起GET请求
      axios
        .get(
          process.env.VUE_APP_APIURL +
            "/v1/area/list" 
        )
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.area = response.data;
          
          // console.log(response);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },

    scriptEnable() {
      // 发起 post 请求
      // console.log(this.apiData);
      axios
        .post(process.env.VUE_APP_APIURL + `/v1/htmlPython/post`, {
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
          this.showSuccessModal();
          console.log("Item status updated successfully:", response.data);
          window.location.reload();
        })
        .catch((error) => {
          // 处理错误
          this.showErrorModal();
          console.error("Error updating item status:", error);
        });
    },


    showSuccessModal() {
      // 使用 Bootstrap 的模態框組件來顯示成功的模態框
      alert("新增成功！");
    },
    showErrorModal() {
      // 使用 Bootstrap 的模態框組件來顯示失敗的模態框
      alert("新增失敗！");
    },
    page_bool() {
      // 切換 enable 的值
      this.apiData.page_bool = !this.apiData.page_bool;
    },
        enble() {
      // 切換 enable 的值
      this.apiData.enble = !this.apiData.enble;
    },
        imager_bool() {
      // 切換 enable 的值
     this.apiData.imager_bool = !this.apiData.imager_bool;
    },

    testClick(url){
  const queryString = encodeURIComponent(JSON.stringify(this.apiData));
  const newUrl = `${url}?apiData=${queryString}`;
window.open(newUrl, '_blank');

}


  },
};
</script>

<template>
  <div>
    <hr class="my-2" />
    <form class="needs-validation" @submit.prevent="scriptEnable">
      <div class="container">
  <div class="row">
<div class="col">








<div class="mb-3 row">
  <label for="inputPassword" class="col-sm-3 col-form-label"
    >是否啟用</label
  >
  <div class="col-sm-9">
    <div class="form-check form-switch m-2">
      <input
        class="form-check-input"
        type="checkbox"
        role="switch"
        id="flexSwitchCheckDefault"
        :checked="apiData.enble"
        @change="enble"
      />
    </div>
  </div>
</div>

<div class="mb-3 row">
  <label for="inputPassword" class="col-sm-3 col-form-label"
    >要不要圖片</label
  >
  <div class="col-sm-9">
    <div class="form-check form-switch m-2">
      <input
        class="form-check-input"
        type="checkbox"
        role="switch"
        id="flexSwitchCheckDefault"
        :checked="apiData.imager_bool"
        @change="imager_bool"
      />
    </div>
  </div>
</div>



<div class="mb-3 row">
  <label for="inputPassword" class="col-sm-3 col-form-label"
    >要不要翻頁</label
  >
  <div class="col-sm-9">
    <div class="form-check form-switch m-2">
      <input
        class="form-check-input"
        type="checkbox"
        role="switch"
        id="flexSwitchCheckDefault"
        :checked="apiData.page_bool"
        @change="page_bool"
      />
    </div>
  </div>
</div>
















<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">爬取網站名稱<span style="color: red;">（必填）</span></label>
  <input type="text" v-model="apiData.name" required class="form-control" id="formGroupExampleInput" placeholder="請輸入名稱">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">列表的第一層定位（外層）<span style="color: red;">（必填）</span></label>
  <input type="text" v-model="apiData.body_filter" required class="form-control" id="formGroupExampleInput2" placeholder="列表的第一層定位">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">列表的第二層定位（內層標題）<span style="color: red;">（必填）</span></label>
  <input type="text" v-model="apiData.title_filter" required class="form-control" id="formGroupExampleInput" placeholder="列表的第二層定位">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">圖片定位</label>
  <input type="text" v-model="apiData.imager1_filter"  class="form-control" id="formGroupExampleInput" placeholder="圖片定位">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">列表網址（URL）<span style="color: red;">（必填）</span></label>
  <input type="text" v-model="apiData.url" required class="form-control" id="formGroupExampleInput" placeholder="列表網址（URL）">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">內容的開頭網址（不用就跳過）</label>
  <input type="text" v-model="apiData.connect_url"  class="form-control" id="formGroupExampleInput" placeholder="內容網址">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">文章內容定位<span style="color: red;">（必填）</span></label>
  <input type="text" v-model="apiData.post_filter" required class="form-control" id="formGroupExampleInput" placeholder="文章內容定位">
</div>
</div>
<div class="col">
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">列表翻頁變數</label>
  <input type="text" v-model="apiData.table_page"  class="form-control" id="formGroupExampleInput" placeholder="列表翻頁變數">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">要翻幾頁</label>
  <input type="integer" v-model="apiData.page"  class="form-control" id="formGroupExampleInput" placeholder="要翻幾頁">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">圖片開頭網址（不用就跳過）</label>
  <input type="text" v-model="apiData.imager_url"  class="form-control" id="formGroupExampleInput" placeholder="圖片開頭網址（不用就跳過）">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">活動時間定位<span style="color: red;">（必填）</span></label>
  <input type="text" v-model="apiData.event_date_filter" required class="form-control" id="formGroupExampleInput" placeholder="活動時間定位">
</div>


<div class="mb-3 row">
  <label for="inputPassword" class="col-sm-2 col-form-label"
    >地區</label
  >
  <div class="col-sm-10">
    <select
      class="form-select form-select-sm"
      aria-label=".form-select-sm example"
      v-model="apiData.area_id"
    >
      <!-- <option selected value="GET">GET</option> -->
      <option v-for="(item, index) in area" :key="index" :value="item.id">{{item.city}}</option>

    </select>
  </div>
</div>







</div>
  </div>
</div>
<div class="d-flex justify-content-end mt-4 mb-2">

      <button type="button" @click="testClick('/admin/test')" class="btn btn-outline-secondary m-1">
        測試爬取效果
      </button>
      
      <button type="submit" class="btn btn-outline-secondary m-1">
        新增爬取網站
      </button>
</div>
    </form>




  </div>
</template>