<script>
// import textImager from "/src/layouts/easterEggs/textImager";
export default {
    props: ['pageData'],
    components: {
  },
  data() {
    return {
      page: 1,
    };
  },

  mounted() {
    // 在组件挂载后调用API
  },
  methods: {


  handlePageClick(pageNumber) {

    this.page = pageNumber;
    this.$emit('handlePageClick', this.page);
    },
  PageClick(id) {
window.location.href = "/page/"+id;
    }


  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {
    displayedPageNumbers() {
      const maxDisplayedPages = 10;
      const startPage = Math.max(1, this.page - Math.floor(maxDisplayedPages / 2));
      const endPage = Math.min(this.pageData.totalPages, startPage + maxDisplayedPages - 1);
      const displayedPages = [];

      for (let i = startPage; i <= endPage; i++) {
        displayedPages.push(i);
      }

      return displayedPages;
    },
  },
};
</script>

<template>
  <div>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous" @click="handlePageClick(1)">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous" @click="handlePageClick(page > 1 ? page - 1 : 1)">
        <span aria-hidden="true"> &lt; </span>
      </a>
    </li>
<div v-for="counter in displayedPageNumbers" :key="counter"> 
    <li class="page-item active" aria-current="page" v-if="counter == page">
      <a class="page-link" href="#" @click="handlePageClick(counter)">{{ counter }}</a>
      </li>
          <li class="page-item" v-else>
      <a class="page-link" href="#" @click="handlePageClick(counter)">{{ counter }}</a>
      </li>
</div>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next" @click="handlePageClick(page < pageData.totalPages ? page + 1 : pageData.totalPages)">
        <span aria-hidden="true"> &gt; </span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next" @click="handlePageClick(pageData.totalPages)">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


  </div>
</template>