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
import Notifier from "./Notifier";
Vue.use(BootstrapVue)

 Vue.mixin(AxiosWrapper)

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

// Expense Components
Vue.component('expenses-list', require('./components/expense/ExpensesListComponent.vue').default);
Vue.component('expense-add-value-component', require('./components/expense/ExpenseAddValueComponent.vue').default);
Vue.component('expense-new-component', require('./components/expense/ExpenseNewComponent.vue').default);

// Category Components
Vue.component('category-list-component', require('./components/category/CategoryListComponent.vue').default);
Vue.component('category-create-update-component', require('./components/category/CategoryCreateComponent.vue').default);
Vue.component('category-component', require('./components/category/CategoryComponent.vue').default);

// Details
Vue.component('details-component', require('./components/details/DetailsComponent.vue').default);
Vue.component('details-cateagory-component', require('./components/details/DetailsCategoryComponent.vue').default);
Vue.component('details-expense-component', require('./components/details/DetailsExpenseComponent.vue').default);

// Month Expenses and Earnings
Vue.component('month-expenses-and-earnings', require('./components/month-expenses-and-earnings/MonthExpensesAndEarnings.vue').default);
Vue.component('month-tables', require('./components/month-expenses-and-earnings/MonthTables.vue').default);
// Vue.component('month-earning', require('./components/month-expenses-and-earnings/MonthEarning.vue').default);
Vue.component('month-expense-create', require('./components/month-expenses-and-earnings/MonthExpenseCreate.vue').default);
Vue.component('month-earning-create', require('./components/month-expenses-and-earnings/MonthEarningCreate.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

app.$root.$on('notify', (options) => {
    const notifier = new Notifier(options, app)
    notifier.notify()
})
