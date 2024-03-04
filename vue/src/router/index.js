

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
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
