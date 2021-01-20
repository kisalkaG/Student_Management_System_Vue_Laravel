import router from './router.js';
import Vue from 'vue';

require('./bootstrap');

window.Vue = require('vue');

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
 
Vue.use(VueSweetalert2);

import axios from 'axios';
axios.defaults.baseURL = 'http://localhost:8000/api'

import App from './App.vue';

const app = new Vue({
    el: '#app',

    components: {
        App
    },
      router
});
