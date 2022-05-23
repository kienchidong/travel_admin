require('../js/bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import router from "./router/index";
import store from "./store";
import VueInternationalization from 'vue-i18n';
import Locale from '../layouts/js/vue-i18n-locales.generated.js';
import axios from 'axios';

Vue.use(VueInternationalization);
const i18n = new VueInternationalization({
    locale: document.head.querySelector('meta[name="locale"]').content,
    messages: Locale
});


import Begin from './Begin';

import laravelRoutes from '../layouts/js/laravel-routes';

let constant = require('../layouts/js/constants');
Vue.prototype.$myConstant = constant;
axios.post(laravelRoutes(constant['GET_ADMIN_LOGIN'])).then(response => {
    let user = response.data;
    store.dispatch('handleChangeUserInfo', user);
    localStorage.setItem('permission', JSON.stringify(user.permission));
});

require('../layouts/js/golbal-event');


Vue.prototype.$axios = axios;
Vue.mixin({
    data() {
        return {
            clientLink: window.Laravel.baseUrl,
        };
    },
    mounted(){

    },
    methods: {
        laravelRoutes,
        userHasPermission(permission)  {
            var arr = this.$store.getters.userInfo.permission != undefined ? this.$store.getters.userInfo.permission : [];
            return Object.values(arr).includes(permission)
        }
    }
});



const app = new Vue({
    el: '#app',
    router,
    i18n,
    store,
    render: h => h(Begin)
});