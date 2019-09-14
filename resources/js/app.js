/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Home from './pages/Home'
import AddBook from './pages/AddBook'
import CheckBook from './pages/CheckBook'
import Status from './pages/Status'

import Vuex from 'vuex'
import VueRouter from 'vue-router'

Vue.use(Vuex)
Vue.use(VueRouter)

import store from './store/index.js'


const routes = [
    { path: '/add', component: AddBook, name: 'add-book' },
    { path: '/check-book', component: CheckBook, name: 'check-book' },
    { path: '/status', component: Status, name: 'status' },
]

const router = new VueRouter({
    routes // short for `routes: routes`
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#main-app',
    components: {
        Home
    },
    store,
    router
});
