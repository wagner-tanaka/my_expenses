<template>
    <div>
        <b-row
            class="mt-2"
            :class="
                        isMonthDebtBiggerThanZero
                            ? 'monthDebtClassBiggerThanZero'
                            : 'monthDebtClassLessThanZero'
                    "
        >
            <b-col class="text-right">{{ __('global.debt') }}</b-col>
            <b-col class="text-left">{{ monthDebt }}</b-col>
        </b-row>

        <!--        Month Expenses-->
        <div class="expensesBackgroundColor">
            <div class="mb-2 mt-2 expensesTitleStyle ">
                {{ __('global.month_expense') }}
                <b-button
                    class="float-right mb-2"
                    variant="danger"
                    @click="showMonthExpensesCategoryCreateUpdateModal = true"
                ><i class="fas fa-plus"></i>
                </b-button>
            </div>

            <div
                v-for="(monthExpensesCategory, index) in monthExpensesCategories"
                :key="index"
            >
                <month-expenses-category-table
                    v-model="monthExpensesCategories[index]"
                    @update="MonthExpensesCategoryHasBeenUpdated"
                ></month-expenses-category-table>
            </div>

            <hr>

            <daily-expenses-table></daily-expenses-table>

            <b-row class="expensesTotalStyle mb-2">
                <b-col class="align-self-center">{{ __('global.total_expenses') }}</b-col>
                <b-col class="align-self-center"><strong>{{ monthExpensesTotal }}</strong></b-col>
            </b-row>
        </div>

        <!--        Month Earnings-->
        <div class="earningsBackgroundColor">
            <div class="mb-2 mt-2 earningsTitleStyle ">
                {{ __('global.month_earnings') }}
                <b-button
                    class="float-right mb-2"
                    variant="primary"
                    @click="showMonthEarningsCategoryCreateUpdateModal = true"
                ><i class="fas fa-plus"></i>
                </b-button>
            </div>

            <div
                v-for="(monthEarningsCategory, index) in monthEarningsCategories"
                :key="index"
            >
                <month-earnings-category-table
                    v-model="monthEarningsCategories[index]"
                    @update="MonthEarningCategoryHasBeenUpdated"
                ></month-earnings-category-table>
            </div>

            <b-row class="earningsTotalStyle mb-2">
                <b-col class="align-self-center">{{ __('global.month_earnings_total') }}</b-col>
                <b-col class="align-self-center"><strong>{{ monthEarningsTotal }}</strong></b-col>
            </b-row>
        </div>

<!-- MonthExpensesCategoryCreateUpdate Modal -->
        <b-modal
            v-model="showMonthExpensesCategoryCreateUpdateModal"
            :title="__('global.new_month_expenses_category')"
            centered
            hide-footer
        >
            <month-expenses-category-create-update
                @save="monthExpensesCategoryHasBeenSaved"
                @cancel="showMonthExpensesCategoryCreateUpdateModal = false"

            ></month-expenses-category-create-update>
        </b-modal>

<!-- MonthEarningsCategoryCreateUpdate Modal -->
        <b-modal
            v-model="showMonthEarningsCategoryCreateUpdateModal"
            :title="__('global.new_month_earnings_category')"
            centered
            hide-footer
        >
            <month-earnings-category-create-update
                @save="monthEarningsCategoryHasBeenSaved"
                @cancel="showMonthEarningsCategoryCreateUpdateModal = false"

            ></month-earnings-category-create-update>
        </b-modal>

    </div>
</template>

<script>
import DetailsComponent from "../main/DailyExpensesTable.vue";

export default {
    components: {DetailsComponent},
    props: [],
    data: function () {
        return {
            showMonthExpensesCategoryCreateUpdateModal: false,
            showMonthEarningsCategoryCreateUpdateModal: false,
            showNewMonthEarningModal: false,
            monthExpenses: [],
            dailyExpensesTotal: "",
            monthExpensesCategories: [],
            monthEarningsCategories: [],
        };
    },
    created() {
        this.getDailyExpensesTotal();
        this.getMonthExpensesCategories()
        this.getMonthEarningsCategories()
    },
    methods: {
        MonthExpensesCategoryHasBeenUpdated() {
            this.getMonthExpensesCategories()
        },
        monthExpensesCategoryHasBeenSaved() {
            this.showMonthExpensesCategoryCreateUpdateModal = false
            this.getMonthExpensesCategories()
        },
        MonthEarningCategoryHasBeenUpdated() {
            this.getMonthEarningsCategories()
        },
        monthEarningsCategoryHasBeenSaved() {
            this.showMonthEarningsCategoryCreateUpdateModal = false
            this.getMonthEarningsCategories()
        },
        getMonthExpensesCategories() {
            let url = "/api/monthExpensesCategories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    this.monthExpensesCategories = response.data.monthExpensesCategories.data
                    this.capitalizeCategoryNameFirstLetter();
                    this.orderCategoriesByName();
                },
            });
        },
        getMonthEarningsCategories() {
            let url = "/api/monthEarningsCategories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    this.monthEarningsCategories = response.data.monthEarningsCategories.data
                    this.capitalizeCategoryNameFirstLetter();
                    this.orderCategoriesByName();
                },
            });
        },
        getDailyExpensesTotal() {
            let url = "/api/getDailyExpensesTotal";
            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.dailyExpensesTotal = response.data.totalCategoryExpenses;
                    },
                }
            );
        },
        monthEarningHasBeenSaved() {
            this.showNewMonthEarningModal = false;
        },
        capitalizeCategoryNameFirstLetter() {
            this.monthExpensesCategories.map((category) => {
                category.name = this.capitalizeFirstLetter(category.name);
                return category;
            });
        },
        orderCategoriesByName() {
            this.monthExpensesCategories = _.orderBy(this.monthExpensesCategories, ["name"]);
        },
    },
    computed: {
        monthDebt() {
            return Number(this.monthEarningsTotal) - Number(this.monthExpensesTotal);
        },
        isMonthDebtBiggerThanZero() {
            return this.monthDebt >= 0;
        },
        monthExpensesTotal() {
            let monthExpensesCategoriesTotal = this.monthExpensesCategories.reduce((accumulator, value) => {
                return accumulator + parseInt(value.monthExpensesCategoryTotal)
            }, 0)
            return monthExpensesCategoriesTotal + this.dailyExpensesTotal
        },
        monthEarningsTotal() {
            return this.monthEarningsCategories.reduce((accumulator, value) => {
                return accumulator + parseInt(value.monthEarningsCategoryTotal)
            }, 0)

        },
    },
};
</script>

<style scoped>
.monthDebtClassBiggerThanZero {
    font-size: 1.5em;
    background-color: #00851F;
}

.monthDebtClassLessThanZero {
    font-size: 1.5em;
    background-color: #e33949;
}


.expensesTotalStyle {
    background-color: #6E0E16;
    height: 2em;
    font-size: 1.2em;
    border-radius: 6px;
    color: #fff;
}

.expensesTitleStyle {
    background-color: #6e0e16;
    height: 37px;
    line-height: 37px;
    font-size: 1.4em;
    border-radius: 6px;
    color: #fff;
}

.earningsTotalStyle {
    background-color: #3F526B;
    height: 2em;
    font-size: 1.2em;
    border-radius: 6px;
    color: #fff;
}

.earningsTitleStyle {
    background-color: #3F526B;
    height: 37px;
    line-height: 37px;
    font-size: 1.4em;
    border-radius: 6px;
    color: #fff;
}

hr {
    border: 1px solid;
}

.expensesBackgroundColor {
    background-color: #c4aeac
}

.earningsBackgroundColor {
    background-color: #5A92BD
}

</style>

