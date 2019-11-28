require('./bootstrap');

import 'es6-promise/auto';
import axios from 'axios';
import Vue from 'vue';
import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import Index from './Index';
import auth from './auth';
import router from './router';
import ElementUI from 'element-ui';
import Vuex from 'vuex'
import {store} from './stores/store.js';
import i18n from 'vue-i18n';

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css'; 

import 'element-ui/lib/theme-chalk/index.css';
import VueMaterial from 'vue-material';
import locale from 'element-ui/lib/locale/lang/es'

Vue.material.locale.dateFormat = 'yyyy-MM-dd';
Vue.material.locale.days = ['Domingo','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
Vue.material.locale.shortDays = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
Vue.material.locale.shorterDays = ['D','L', 'M', 'M', 'J', 'V', 'S'];
Vue.material.locale.months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
Vue.material.locale.shortMonths = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
Vue.material.locale.shorterMonths= ['E', 'F', 'M', 'A', 'M', 'Jn', 'Jl', 'A', 'Se', 'O', 'N', 'D'];
Vue.material.locale.firstDayOfAWeek = 1;

Vue.use(Vuex);
Vue.use(Loading);
Vue.use(i18n);
Vue.use(VueMaterial);
Vue.use(ElementUI, { locale })

// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `/api`
Vue.use(VueAuth, auth)

// Load Index
Vue.component('index', Index)

const app = new Vue({
  el: '#app',
  router,
  store
});