
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import BootstrapVue from 'bootstrap-vue'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.use(VueAxios, axios)
Vue.use(BootstrapVue)

Vue.axios.defaults.baseURL="/api";
Vue.router = router;

// Laravel-mix resolves '@' symbol as current directory, it can't resolve @websanova/vue-auth
Vue.use(require('./../../../node_modules/@websanova/vue-auth'), {
  auth: require('./../../../node_modules/@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('./../../../node_modules/@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('./../../../node_modules/@websanova/vue-auth/drivers/router/vue-router.2.x.js')
});

Vue.component('App', require('./App.vue'));

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  template: '<App/>',
  components: {
    App
  }
})
