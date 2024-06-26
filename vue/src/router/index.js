

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
  },
  {
    path: "/admin/post_text",
    name: "post_text",
    meta: {
      title: "爬取單獨測試",
      authRequired: true,
    },
    component: () => import("/views/admin/AdminMainOneTest"),
  },
  {
    path: "/admin/update/:id",
    name: "update",
    meta: {
      title: "修改爬取網站",
      authRequired: true,
    },
    component: () => import("/views/admin/AdminMainUpdate"),
  },
  {
    path: "/admin/login",
    name: "login",
    meta: {
      title: "登入",
      authRequired: true,
    },
    component: () => import("/views/admin/AdminLogin"),
  }
];

const router = createRouter({
  history: createWebHistory('/'),
  routes,
});

export default router;
