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


Vue.component('index-component', require('./components/IndexComponent.vue').default);

// Daily Expenses Components
Vue.component('daily-expenses-list', require('./components/daily-expenses/DailyExpenseList.vue').default);
Vue.component('daily-expense-row', require('./components/daily-expenses/DailyExpenseRow.vue').default);
Vue.component('daily-expense-add-value', require('./components/daily-expenses/DailyExpenseAddValue.vue').default);
Vue.component('daily-expense-create', require('./components/daily-expenses/DailyExpenseCreate.vue').default);
Vue.component('daily-expenses-table', require('./components/daily-expenses/DailyExpensesTable.vue').default);
Vue.component('daily-expenses-category-create-update', require('./components/daily-expenses/DailyExpensesCategoryCreateUpdate.vue').default);
Vue.component('daily-expenses-category', require('./components/daily-expenses/DailyExpensesCategory.vue').default);

// Details
Vue.component('daily-expenses-details', require('./components/month-expenses-and-earnings/DailyExpensesDetails.vue').default);

// Month Expenses and Earnings
Vue.component('month-expenses-and-earnings', require('./components/month-expenses-and-earnings/MonthExpensesAndEarnings.vue').default);
// Vue.component('month-earnings-category-create-update', require('./components/month-expenses/category/MonthEarningsCategoryCreateUpdate.vue').default);
// Vue.component('month-earnings-category-table', require('./components/month-expenses/category/MonthEarningsCategoryTable.vue').default);
// Vue.component('month-earnings-category-table-row', require('./components/month-expenses/category/MonthEarningsCategoryTableRow.vue').default);
// Vue.component('month-earning-create', require('./components/month-expenses/category/MonthEarningCreate.vue').default);

// Month Expenses
Vue.component('month-expenses-category-create-update', require('./components/month-expenses/category/MonthExpensesCategoryCreateUpdate.vue').default);
Vue.component('month-expenses-category-table', require('./components/month-expenses/category/MonthExpensesCategoryTable.vue').default);
Vue.component('month-expenses-category-table-row', require('./components/month-expenses/category/MonthExpensesCategoryTableRow.vue').default);
Vue.component('month-expense-create', require('./components/month-expenses/MonthExpenseCreate.vue').default);

// Month Earnings
Vue.component('month-earnings-category-create-update', require('./components/month-earnings/category/MonthEarningsCategoryCreateUpdate.vue').default);
Vue.component('month-earnings-category-table', require('./components/month-earnings/category/MonthEarningsCategoryTable.vue').default);
Vue.component('month-earnings-category-table-row', require('./components/month-earnings/category/MonthEarningsCategoryTableRow.vue').default);
Vue.component('month-earning-create', require('./components/month-earnings/MonthEarningCreate.vue').default);



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
