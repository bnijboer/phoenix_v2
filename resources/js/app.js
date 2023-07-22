import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { vfmPlugin } from 'vue-final-modal';
import TheHeader from './components/layout/the-header';
import PostCollection from "./components/posts/post-collection";
import PostItem from "./components/posts/post-item";
import CommentSection from './components/comments/comment-section';
import PostBody from './components/comments/post-body';

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
