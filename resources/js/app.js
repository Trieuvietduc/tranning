import './bootstrap';
Window.Vue = require('vue');

Vue.compoment('create-compoment', require('.compoments/CreateCompoment.vue').default);
const app = new Vue({
    el: '#form'
})
