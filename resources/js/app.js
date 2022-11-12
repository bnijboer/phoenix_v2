import { createApp } from 'vue'
import Navigation from './components/Navigation'

const app = createApp({})

app.component('navigation', Navigation);

app.mount('#app')
