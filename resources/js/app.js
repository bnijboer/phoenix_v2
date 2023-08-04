import '../css/app.css';
import 'materialize-css'
import 'materialize-css/dist/css/materialize.css'

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createPinia } from 'pinia';
import { vfmPlugin } from 'vue-final-modal';
import TheHeader from './components/layout/the-header.vue';
import PostCollection from "./components/posts/post-collection.vue";
import PostItem from "./components/posts/post-item.vue";
import CommentSection from './components/comments/comment-section.vue';
import PostBody from './components/comments/post-body.vue';

const pinia = createPinia();
const app = createApp({});

app.component('the-header', TheHeader)
    .component('post-collection', PostCollection)
    .component('post-item', PostItem)
    .component('comment-section', CommentSection)
    .component('post-body', PostBody);

app.use(pinia)
    .use(vfmPlugin);

app.mount('#app');
