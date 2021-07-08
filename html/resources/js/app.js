require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Import Router
import {routes} from './routes';
const router = new VueRouter({
    routes,
    mode: 'history'
});

// Import User
import User from "./helpers/User";
window.User = User;

// Import AppStorage
import AppStorage from "./helpers/AppStorage";
window.AppStorage = AppStorage;

// Import Sweetalert
import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});
window.Toast = Toast;

const app = new Vue({
    el: '#app',
    router
});
