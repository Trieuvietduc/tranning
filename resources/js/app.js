import './bootstrap';
import { createApp } from 'vue'
// dùng để gọi các file giao diện vue ra màn hình
// import App from './components/app.vue'
// import index from './components/index.vue'
import createCCompany from './components/create.vue'
import editCompany from './components/edit.vue'



// đưa giao diện vue ra màn hình
// const app = createApp({})
// app.component('MyComponent', createCCompany)
// app.mount('#app');



// createApp(App).mount('#app')
// createApp(index).mount('#index')
createApp(createCCompany).mount('#create')
createApp(editCompany).mount('#edit')

