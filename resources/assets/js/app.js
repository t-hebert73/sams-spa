/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import { VueMasonryPlugin } from 'vue-masonry'
import VeeValidate from 'vee-validate'
import VueLocalStorage from 'vue-ls'
import VueSweetalert2 from 'vue-sweetalert2'
import VueEditor from 'vue2-editor'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'font-awesome/scss/font-awesome.scss'

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(VueMasonryPlugin)
Vue.use(VeeValidate)
Vue.use(VueSweetalert2)

let lsOptions = {
  namespace: 'vuejs__'
}

Vue.use(VueLocalStorage, lsOptions)
Vue.use(VueEditor)

window.vue = Vue

// vue-flash setup
/**
 * Our Vuejs event handler which we will be using for flash messaging
 * @type  {Vue}
 */
window.events = new Vue()

/**
 * Our Flash function which will be used to add new flash events to our event
 * handler
 *
 * @param    String message Our alert message
 * @param    String type    The type of alert we want to show
 */
window.flash = function (message, type) {
  window.events.$emit('flash', message, type)
}

Vue.component('flash', require('vue-flash'))

// set all subsequent axios requests to have access token
window.axios.interceptors.request.use(function (config) {
  if (Vue.prototype.$ls.get('accessToken')) {
    config.headers.common['Authorization'] = 'Bearer ' +
      Vue.prototype.$ls.get('accessToken')
  }
  return config
})

const BASE_PATH = (process.env.NODE_ENV === 'production')
  ? 'alescosalon.herokuapp.com'
  : 'http://localhost:8000'

// Event Bus to allow emitting and receiving events in different components
// Also set global api route variable
var EventBus = new Vue()
// Add to Vue properties by exposing a getter for $bus
Object.defineProperties(Vue.prototype, {
  $bus: {
    get: function () {
      return EventBus
    }
  },
  THEME_NAME: {
    get: function () {
      return 'Alesco Salon'
    }
  },
  BASE_PATH: {
    get: function () {
      return BASE_PATH
    }
  },
  API_ROUTE: {
    get: function () {
      return '/api/'
    }
  }
})

Vue.component('main-app', require('./components/MainApp.vue'))
Vue.component('admin-component',
  require('./components/admin/AdminComponent.vue'))
Vue.component('home-page', require('./components/page-templates/HomePage.vue'))
Vue.component('about-page',
  require('./components/page-templates/AboutPage.vue'))
Vue.component('generic-page',
  require('./components/page-templates/GenericPage.vue'))
Vue.component('service-page',
  require('./components/page-templates/ServicePage.vue'))
Vue.component('gallery-page',
  require('./components/page-templates/GalleryPage.vue'))
Vue.component('contact-page',
  require('./components/page-templates/ContactPage.vue'))

Vue.component('main-header', require('./components/layouts/MainHeader.vue'))
Vue.component('main-menu', require('./components/widgets/menu/MainMenu.vue'))
Vue.component('main-footer', require('./components/layouts/MainFooter.vue'))

const routes = [
  {
    path: '/login',
    name: 'pages.login',
    component: require('./components/page-templates/LoginPage.vue')
  },
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: require('./components/admin/Dashboard.vue')
  },
  {
    path: '/admin/inquiries/:id',
    name: 'inquiries.show',
    component: require('./components/admin/inquiries/InquiryShow.vue'),
    props: true
  },
  {
    path: '/admin/pages',
    name: 'pages.index',
    component: require('./components/admin/pages/PageList.vue'),
    props: true
  },
  {
    path: '/admin/pages/create',
    name: 'pages.create',
    component: require('./components/admin/pages/PageCreate.vue'),
    props: true
  },
  {
    path: '/admin/pages/:id',
    name: 'pages.show',
    component: require('./components/admin/pages/PageShow.vue'),
    props: true
  },
  {
    path: '/admin/pages/:id/edit',
    name: 'pages.edit',
    component: require('./components/admin/pages/PageEdit.vue'),
    props: true
  },
  {
    path: '/admin/employees',
    name: 'employees.index',
    component: require('./components/admin/employees/EmployeeList.vue'),
    props: true
  },
  {
    path: '/admin/employees/create',
    name: 'employees.create',
    component: require('./components/admin/employees/EmployeeCreate.vue'),
    props: true
  },
  {
    path: '/admin/employees/:id',
    name: 'employees.show',
    component: require('./components/admin/employees/EmployeeShow.vue'),
    props: true
  },
  {
    path: '/admin/employees/:id/edit',
    name: 'employees.edit',
    component: require('./components/admin/employees/EmployeeEdit.vue'),
    props: true
  },
  {
    path: '/admin/services',
    name: 'services.index',
    component: require('./components/admin/services/ServiceIndex.vue'),
    props: true
  },
  {
    path: '/admin/services/:id',
    name: 'services.employee.show',
    component: require('./components/admin/services/ServiceEmployeeShow.vue'),
    props: true
  },
  {
    path: '/admin/service-categories',
    name: 'service-categories.index',
    component: require('./components/admin/service-categories/ServiceCategoryList.vue'),
    props: true
  },
  {
    path: '/admin/service-categories/create',
    name: 'service-categories.create',
    component: require('./components/admin/service-categories/ServiceCategoryCreate.vue'),
    props: true
  },
  {
    path: '/admin/service-categories/:id',
    name: 'service-categories.show',
    component: require('./components/admin/service-categories/ServiceCategoryShow.vue'),
    props: true
  },
  {
    path: '/admin/service-categories/:id/edit',
    name: 'service-categories.edit',
    component: require('./components/admin/service-categories/ServiceCategoryEdit.vue'),
    props: true
  },
  {
    path: '/*',
    component: require('./components/PageRouter.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

const app = new Vue({
  el: '#main_app',
  router

}).$mount()