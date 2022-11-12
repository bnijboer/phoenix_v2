import { createApp } from 'vue'
import NavLinks from './components/nav-links'
import CommentCreate from './components/comments/comment-create'
import CommentIndex from './components/comments/comment-index'
import CommentItem from './components/comments/comment-item'
import CommentSection from './components/comments/comment-section'
import ContentComponent from './components/content-component'

const app = createApp({})

app.component('nav-links', NavLinks);
app.component('comment-create', CommentCreate);
app.component('comment-index', CommentIndex);
app.component('comment-item', CommentItem);
app.component('comment-section', CommentSection);
app.component('content-component', ContentComponent);

app.mount('#app')
