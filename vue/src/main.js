import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
// import axios from '@/plugins/api.js';

import bootstrap from 'bootstrap/dist/css/bootstrap.css';
// import BootstrapVue from 'bootstrap-vue'// BOOTSTRAP _ VUE IMPORT 
// import 'bootstrap/dist/css/bootstrap.css' 
// import 'bootstrap-vue/dist/bootstrap-vue.css'

createApp(App)
    .use(store)
    .use(router)
    .use(bootstrap)
    .mount('#app')
