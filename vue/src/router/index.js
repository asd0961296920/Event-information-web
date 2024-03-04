

import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: "/",
    name: "index_route",
    meta: {
      title: "腳本系統",
      authRequired: true,
    },
    component: () => import("/views/main/Main"),
  },
  {
    path: "/city/:id",
    name: "page",
    meta: {
      title: "腳本系統",
      authRequired: true,
    },
    component: () => import("/views/pageMain/PageMain"),
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
