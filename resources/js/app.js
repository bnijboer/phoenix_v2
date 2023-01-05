import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { vfmPlugin } from 'vue-final-modal';
import TheHeader from './components/layout/the-header';
import CommentSection from './components/comments/comment-section';

const pinia = createPinia();
const app = createApp({});

app.component('the-header', TheHeader)
    .component('comment-section', CommentSection);

app.use(pinia)
    .use(vfmPlugin);

app.mount('#app');
