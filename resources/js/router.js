import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/task",
        component: () => import("./components/task.vue"),
    },
   
];

export default createRouter({
    history: createWebHistory(),
    routes,
});