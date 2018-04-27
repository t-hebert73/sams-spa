
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

import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import {VueMasonryPlugin} from 'vue-masonry'
import VeeValidate from 'vee-validate'
import VueLocalStorage from 'vue-ls'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(VueMasonryPlugin)
Vue.use(VeeValidate)

let lsOptions = {
  namespace: 'vuejs__'
};

Vue.use(VueLocalStorage, lsOptions);

window.vue = Vue

// set all subsequent axios requests to have access token
window.axios.interceptors.request.use(function (config) {
  if (Vue.prototype.$ls.get('accessToken')) {
    config.headers.common['Authorization'] = 'Bearer ' +
      Vue.prototype.$ls.get('accessToken')
  }
  return config
})

const BASE_PATH = (process.env.NODE_ENV === 'production') ? 'alescosalon.herokuapp.com' : 'http://localhost:8000'

// Event Bus to allow emitting and receiving events in different components
// Also set global api route variable
var EventBus = new Vue();
// Add to Vue properties by exposing a getter for $bus
Object.defineProperties(Vue.prototype, {
  $bus: {
    get: function () {
      return EventBus;
    }
  },
  THEME_NAME: {
    get: function() {
      return 'Alesco Salon'
    }
  },
  BASE_PATH: {
    get: function() {
      return BASE_PATH
    }
  },
  API_ROUTE: {
    get: function() {
      return '/api/'
    }
  }
})

Vue.component('main-app', require('./components/MainApp.vue'));
window.vue.component('admin-component', require('./components/admin/AdminComponent.vue'))
Vue.component('home-page', require('./components/page-templates/HomePage.vue'))
Vue.component('about-page', require('./components/page-templates/AboutPage.vue'))
Vue.component('service-page', require('./components/page-templates/ServicePage.vue'))
Vue.component('gallery-page', require('./components/page-templates/GalleryPage.vue'))
Vue.component('contact-page', require('./components/page-templates/ContactPage.vue'))

Vue.component('main-header', require('./components/layouts/MainHeader.vue'))
Vue.component('main-menu', require('./components/widgets/MainMenu.vue'))
Vue.component('main-footer', require('./components/layouts/MainFooter.vue'))

const routes = [
    { path: '/admin', name: 'admin.dashboard', component: require('./components/admin/Dashboard.vue')},
    { path: '/', name: 'website.home', component: require('./components/PageRouter.vue') },
    { path: '/*', component: require('./components/PageRouter.vue') }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#main_app',
    router

})