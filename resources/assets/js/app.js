
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

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter)
Vue.use(BootstrapVue);
Vue.component('main-app', require('./components/MainApp.vue'));
Vue.component('home-page', require('./components/page-templates/HomePage.vue'))
Vue.component('about-page', require('./components/page-templates/AboutPage.vue'))
Vue.component('service-page', require('./components/page-templates/ServicePage.vue'))
Vue.component('gallery-page', require('./components/page-templates/GalleryPage.vue'))
Vue.component('contact-page', require('./components/page-templates/ContactPage.vue'))

Vue.component('main-header', require('./components/layouts/MainHeader.vue'))
Vue.component('main-menu', require('./components/widgets/MainMenu.vue'))
Vue.component('main-footer', require('./components/layouts/MainFooter.vue'))

const routes = [
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