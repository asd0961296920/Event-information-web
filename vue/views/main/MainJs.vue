<script>
import axios from "axios";
// import textImager from "/src/layouts/easterEggs/textImager";
import htmlTemplate from "/views/main/MainHtml.vue";
export default {
  components: {
    htmlTemplate,
  },
  data() {
    return {
      searchQuery: "",
      apiData: null,
      isChecked: false,
      start: null,
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
        .get(process.env.VUE_APP_APIURL + "/v1/script")
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.apiData = response.data.data;
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },
    showData() {
      // 发起GET请求
      axios
        .get(process.env.VUE_APP_APIURL + "/v1/script")
        .then((response) => {
          // 请求成功，将数据存储在组件的数据中
          this.apiData = response.data.data;
        })
        .catch((error) => {
          // 处理错误
          console.error("Error fetching data:", error);
        });
    },

    scriptEnables(item) {
      // 发起 PATCH 请求
      axios
        .patch(process.env.VUE_APP_APIURL + `/v1/script/enable/${item.id}`, {
          ...item,

          enable: !item.enable,
          //參考寫法
          // script: {
          //   name: item.name,
          //   enable: !item.enable,
          //   api_domain: !item.api_domain,
          //   remark: !item.remark,
          //   methods: !item.methods,
          // },
          // action: item.script_action.map((element) => ({
          //   id: element.id,
          //   name: element.name,
          //   enable: element.enable,
          //   remark: element.remark,
          //   api_request: element.api_request,
          //   api_response: element.api_response,
          //   methods: element.methods,
          //   header: element.header,
          //   script_id: element.script_id,
          // })),
        })
        .then((response) => {
          // 处理成功的情况
          console.log("Item status updated successfully:", response.data);
        })
        .catch((error) => {
          // 处理错误
          console.error("Error updating item status:", error);
        });
    },

    scriptDelete(item) {
      // 发起 delete 请求
      axios
        .delete(process.env.VUE_APP_APIURL + `/v1/script/${item.id}`, {})
        .then((response) => {
          // 处理成功的情况
          console.log("Item status updated successfully:", response.data);
          window.location.reload();
        })
        .catch((error) => {
          // 处理错误
          console.error("Error updating item status:", error);
        });
    },
    searchItems() {
      // 在输入框输入时触发搜索
      // 你可以在这里添加一些延时，以减少请求的频率
      this.fetchData();
    },
    navigateToTarget(item) {
      const itemId = item.id; // 这里是要传递的值，你可以根据需要设置
      this.$router.push({ name: "update_script", params: { id: itemId } });
    },
    navigateToTargetStore() {
      this.$router.push({ name: "store_script" });
    },
    history() {
      this.$router.push({ name: "history" });
    },
    handleCheckboxChange(item) {
      // 在 checkbox 被選取或取消選取時，更新按鈕文字

      if (item.isChecked == null) {
        item.isChecked = true;
      } else {
        item.isChecked = !item.isChecked;
      }
    },
    startCheckboxChange() {
      // 執行腳本

      if (this.checkboxStatus) {
        const getRequests = this.apiData
          .filter((item) => item.isChecked) // 過濾出 isChecked 為 true 的項目
          .map((item) =>
            axios.get(
              process.env.VUE_APP_APIURL +
                `/v1/start/script/${item.id}?state=whole`
            )
          );

        Promise.all(getRequests)
          .then((responses) => {
            // 所有 GET 請求都成功，responses 是一個包含所有 GET 請求結果的陣列
            responses.forEach((response, index) => {
              // 將每個項目的資料存儲在適當的位置，這裡使用 index 就是為了示範
              this.apiData[index].start = response.data;
            });
            this.showSuccessModal();
          })
          .catch((error) => {
            // 如果任何一個 GET 請求失敗，這裡會捕獲到錯誤
            console.error("Error fetching data:", error);
          });
      } else {
        // 发起GET请求
        axios
          .get(
            process.env.VUE_APP_APIURL + "/v1/start/script_action?state=whole"
          )
          .then((response) => {
            // 请求成功，将数据存储在组件的数据中
            this.start = response.data;
            this.showSuccessModal();
          })
          .catch((error) => {
            // 处理错误
            console.error("Error fetching data:", error);
          });
      }
    },

    showSuccessModal() {
      // 使用 Bootstrap 的模態框組件來顯示成功的模態框
      alert("腳本執行完成");
    },
  },

  // 计算属性，用于根据搜索条件过滤数据
  computed: {
    filteredItems() {
      // 判断 this.apiData 是否为 null
      if (this.apiData && Array.isArray(this.apiData)) {
        return this.apiData.filter((item) => {
          return item.name
            .toLowerCase()
            .includes(this.searchQuery.toLowerCase());
        });
      } else {
        return [];
      }
    },
    // 計算所有 checkbox 的狀態
    checkboxStatus() {
      // 檢查是否有任何一個 checkbox 被勾選
      if (this.apiData && Array.isArray(this.apiData)) {
        const anyCheckboxChecked = this.apiData.some((item) => item.isChecked);
        // 返回相應的狀態
        return anyCheckboxChecked ? true : false;
      } else {
        return [];
      }
    },
  },
};
</script>

<template>
  <htmlTemplate></htmlTemplate>
</template>