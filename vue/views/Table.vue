<script>
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
  props: ['apiData'],
  data() {
    return {
    };
  },

  mounted() {
  },
  methods: {
  PageClick(id) {
window.location.href = "/page/"+id;
    },
WebClick(url){
 window.open(url);
},
date(dateTimeString){

// 将日期字符串转换为 Date 对象
let dateObject = new Date(dateTimeString);

// 使用 Date 对象的方法获取日期部分（年月日）
let dateString = dateObject.toISOString().split('T')[0];
return dateString;
}

  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {},
};
</script>

<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">地區</th>
          <th scope="col">文章標題</th>
          <th scope="col">活動日期</th>
          <th scope="col">活動連結</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in apiData" :key="index">
          <th scope="row">{{item.area.city}}</th>
          <td><a class="page-link" href="#" @click="PageClick(item.id)" >{{ item.title }}</a></td>
          <td>{{date(item.event_date)}}</td>
          <td><button type="button" class="btn btn-outline-info" @click="WebClick(item.post_url)">點我</button></td>
        </tr>
      </tbody>
    </table>




  </div>
</template>