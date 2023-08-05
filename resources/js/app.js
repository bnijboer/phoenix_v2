import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import 'primeflex/primeflex.css';
import '../css/app.css';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import PrimeVue from 'primevue/config';
import { createPinia } from 'pinia';
import { vfmPlugin } from 'vue-final-modal';

import App from "@/components/app.vue";
import TheHeader from './components/layout/the-header.vue';
import TheSidebar from "@/components/layout/the-sidebar.vue";
import PostCollection from "./components/posts/post-collection.vue";
import PostItem from "./components/posts/post-item.vue";
import CommentSection from './components/comments/comment-section.vue';

const pinia = createPinia();
const app = createApp({});

app
    .component('app', App)
    .component('the-header', TheHeader)
    .component('the-sidebar', TheSidebar)
    .component('post-collection', PostCollection)
    .component('post-preview', PostItem)
    .component('post-item', PostItem)
    .component('comment-section', CommentSection)

app.use(pinia)
    .use(PrimeVue)
    .use(vfmPlugin);

app.mount('#app');
