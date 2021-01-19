import router from './router.js';
require('./bootstrap');

window.Vue = require('vue');

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
