import { createApp } from 'vue'
import { createPinia } from 'pinia'


import TheHeader from './components/layout/the-header'
import TheSidebar from './components/layout/the-sidebar'
import TheFooter from './components/layout/the-footer'
import CommentSection from './components/comments/comment-section'

const pinia = createPinia()
const app = createApp({});

app.component('the-header', TheHeader)
    .component('the-sidebar', TheSidebar)
    .component('the-footer', TheFooter)
    .component('comment-section', CommentSection);

app.use(pinia)

app.mount('#app');
