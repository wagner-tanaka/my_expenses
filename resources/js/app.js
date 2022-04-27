/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import dayjs from "dayjs";
window.dayjs = dayjs;

import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
import Translations from './mixins/Translations.vue'


Vue.use(IconsPlugin)

Vue.mixin(Translations)
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




// Main Components
Vue.component('main-index', require('./components/main/MainIndex.vue').default);
Vue.component('daily-expenses-list', require('./components/main/DailyExpenseList.vue').default);
Vue.component('daily-expense-row', require('./components/main/DailyExpenseRow.vue').default);
Vue.component('daily-expense-add-value', require('./components/main/DailyExpenseAddValue.vue').default);
Vue.component('daily-expense-create', require('./components/main/DailyExpenseCreate.vue').default);
Vue.component('daily-expenses-table', require('./components/main/DailyExpensesTable.vue').default);
Vue.component('daily-expenses-category-create-update', require('./components/main/DailyExpensesCategoryCreateUpdate.vue').default);
Vue.component('daily-expenses-category', require('./components/main/DailyExpensesCategory.vue').default);

// Details
Vue.component('daily-expenses-details', require('./components/main/DailyExpensesDetails.vue').default);

// Current Month
Vue.component('current-month-index', require('./components/current-month/CurrentMonthIndex.vue').default);

    // Current Month Expenses
    Vue.component('month-expenses-category-create-update', require('./components/current-month/month-expenses/category/MonthExpensesCategoryCreateUpdate.vue').default);
    Vue.component('month-expenses-category-table', require('./components/current-month/month-expenses/category/MonthExpensesCategoryTable.vue').default);
    Vue.component('month-expenses-category-table-row', require('./components/current-month/month-expenses/category/MonthExpensesCategoryTableRow.vue').default);
    Vue.component('month-expense-create', require('./components/current-month/month-expenses/MonthExpenseCreate.vue').default);

    // Current Month Earnings
    Vue.component('month-earnings-category-create-update', require('./components/current-month/month-earnings/category/MonthEarningsCategoryCreateUpdate.vue').default);
    Vue.component('month-earnings-category-table', require('./components/current-month/month-earnings/category/MonthEarningsCategoryTable.vue').default);
    Vue.component('month-earnings-category-table-row', require('./components/current-month/month-earnings/category/MonthEarningsCategoryTableRow.vue').default);
    Vue.component('month-earning-create', require('./components/current-month/month-earnings/MonthEarningCreate.vue').default);

// Previous Months
Vue.component('previous-months-index', require('./components/previous-months/PreviousMonthsIndex.vue').default);

    // Previous Months Expenses
    Vue.component('previous-months-expenses', require('./components/previous-months/PreviousMonthExpenses.vue').default);
    Vue.component('previous-month-expenses-table-row', require('./components/previous-months/PreviousMonthExpensesTableRow.vue').default);
    // Previous Months Earnings
    Vue.component('previous-months-earnings', require('./components/previous-months/PreviousMonthEarnings.vue').default);
    Vue.component('previous-month-earnings-table-row', require('./components/previous-months/PreviousMonthEarningsTableRow.vue').default);






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
