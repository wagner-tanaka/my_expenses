/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'

Vue.use(IconsPlugin)

import String from './mixins/Strings.vue'
Vue.mixin(String)

import AxiosWrapper from 'sb-axios-wrapper'
import eventBus from './event-bus'
import Notificator from "./Notificator";
Vue.use(BootstrapVue)

 Vue.use(AxiosWrapper, {
    eventBus
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('expenses-component', require('./components/expense/ExpensesComponent.vue').default);
Vue.component('category-component', require('./components/category/CategoryComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

eventBus.$on('notify', (options) => {
    const notificator = new Notificator(options, app)
    notificator.notify()
})