import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import 'element-ui/lib/theme-chalk/display.css';
import App from './App.vue';

Vue.use(ElementUI);

import router from './router/index.js'; 

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
