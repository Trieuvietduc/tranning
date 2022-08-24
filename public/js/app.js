import './bootstrap';
import {createApp} from 'vue'
// dùng để gọi các file giao diện vue ra màn hình
import App from './components/app.vue'
import index from './components/index.vue'
import createCCompany from './components/create.vue'



// đưa giao diện vue ra màn hình




createApp(App).mount('#app')
createApp(index).mount('#index')
createApp(createCCompany).mount('#create')


