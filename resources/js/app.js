import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import Task from './components/task.vue';
import axios from "axios";


const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: Task },
    { path: '/task', component: Task },
  ],
});

const app = createApp(App);
app.use(router);
app.config.globalProperties.axios = axios;
app.mount('#app');
