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
            <b-col class="text-right">Débito</b-col>
            <b-col class="text-left">{{ monthDebt }}</b-col>
        </b-row>
        <div class="expensesBackgroundColor">
            <div class="mb-2 mt-2 expensesTitleStyle ">
                Despesas Mensais
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
                <b-col class="align-self-center">Total Despesas</b-col>
                <b-col class="align-self-center"><strong>{{ monthExpensesTotal }}</strong></b-col>
            </b-row>
        </div>


        <!-- Month Earnings Table -->
        <div class="earningsBackgroundColor">
            <div class="earningsTitleStyle">
                Ganhos Mensais
                <b-button
                    class="float-right mb-2"
                    variant="primary"
                    @click="showNewMonthEarningModal = true"
                ><i class="fas fa-plus"></i>
                </b-button>
            </div>

            <month-earnings-table @monthEarningsTotal="monthEarningsTotal = $event"></month-earnings-table>

            <!-- Month Earning Modal -->
            <b-modal
                v-model="showMonthExpensesCategoryCreateUpdateModal"
                title="Nova Categoria de Despesas do Mes"
                centered
                hide-footer
            >
                <month-expenses-category-create-update
                    @save="monthExpensesCategoryHasBeenSaved"
                    @cancel="showMonthExpensesCategoryCreateUpdateModal = false"

                ></month-expenses-category-create-update>
            </b-modal>

            <b-modal
                v-model="showNewMonthEarningModal"
                title="Adicionar conta do Mes"
                centered
                hide-footer
            >
                <month-earning-create
                    @save="monthEarningHasBeenSaved"
                ></month-earning-create>
            </b-modal>
        </div>

    </div>
</template>

<script>
import DetailsComponent from "../daily-expenses/DailyExpensesTable.vue";

export default {
    components: {DetailsComponent},
    props: [],
    data: function () {
        return {
            showMonthExpensesCategoryCreateUpdateModal: false,
            showNewMonthEarningModal: false,
            monthExpenses: [],
            dailyExpensesTotal: "",
            monthExpensesCategories: [],
            monthEarningsTotal: ''
        };
    },
    created() {
        this.getDailyExpensesTotal();
        this.getMonthExpensesCategories()
    },
    methods: {
        MonthExpensesCategoryHasBeenUpdated() {
            this.getMonthExpensesCategories()
        },
        monthExpensesCategoryHasBeenSaved() {
            this.showMonthExpensesCategoryCreateUpdateModal = false
            this.getMonthExpensesCategories()
        },
        getMonthExpensesCategories() {
            let url = "/api/monthExpensesCategories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    this.monthExpensesCategories = response.data.monthExpensesCategories.data
                    this.capitalizeCategoryNameFirstLetter();
                    this.orderCategoriesByName();
                    console.log('monthExpensesCategories', this.monthExpensesCategories)
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
                        this.dailyExpensesTotal = response.data;
                        console.log('dailyExpensesTotal', this.dailyExpensesTotal)
                    },
                }
            );
        },
        monthEarningHasBeenSaved() {
            this.showNewMonthEarningModal = false;
            // this.getMonthEarnings();
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
    },
};
</script>

<style scoped>
.monthDebtClassBiggerThanZero {
    font-size: 1.5em;
    background-color: #146d9e;
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

.earningsTitleStyle {
    background-color: #083c8c;
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
    background-color: #a3ccff
}

</style>

