

import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: "/",
    name: "main",
    meta: {
      title: "總列表",
      authRequired: true,
    },
    component: () => import("/views/main/Main"),
  },
  {
    path: "/city/:id",
    name: "city",
    meta: {
      title: "地區列表",
      authRequired: true,
    },
    component: () => import("/views/city/CityMain"),
  },
  {
    path: "/page/:id",
    name: "page",
    meta: {
      title: "文章內頁",
      authRequired: true,
    },
    component: () => import("/views/page/PageMain"),
  },
  {
    path: "/admin",
    name: "admin",
    meta: {
      title: "後台",
      authRequired: true,
    },
    component: () => import("/views/admin/AdminMain"),
  },
  {
    path: "/admin/post",
    name: "post",
    meta: {
      title: "新增爬取網站",
      authRequired: true,
    },
    component: () => import("/views/admin/AdminMainPost"),
  },
  {
    path: "/admin/test",
    name: "test",
    meta: {
      title: "測試頁面",
      authRequired: true,
    },
    component: () => import("/views/admin/element/AdminTest"),
    props: route => ({
      apiData: JSON.parse(route.query.apiData)
    })
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
