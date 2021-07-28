<template>
    <div>
        <div>
            <b-button
                variant="primary"
                class="mr-1"
                @click="showMonthExpensesCategoryCreateUpdateModal = true"
                >Adicionar Categoria de Despesas
            </b-button>

<!--            <b-button-->
<!--                variant="primary"-->
<!--                class="ml-1"-->
<!--                @click="showNewMonthEarningModal = !showNewMonthEarningModal"-->
<!--                >Adicionar Ganho-->
<!--            </b-button>-->
        </div>

        <div
            v-for="(category, index) in categories"
            :key="category.id"
        >
            <month-expenses-category-list
                v-model="categories[index]"
                @update="getMonthExpensesCategories"
            ></month-expenses-category-list>
        </div>
<!--        <b-row-->
<!--            class="mt-2"-->
<!--            :class="-->
<!--                isMonthDebtBiggerThanZero-->
<!--                    ? 'monthDebtClassBiggerThanZero'-->
<!--                    : 'monthDebtClassLessThanZero'-->
<!--            "-->
<!--        >-->
<!--            <b-col class="text-right">Debito</b-col>-->
<!--            <b-col class="text-left">{{ monthDebt }}</b-col>-->
<!--        </b-row>-->

        <!-- Month Expenses Table -->
        <h4 class="mt-2">Despesas</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th colspan="3">Despesas Fixas</th>
                </tr>
            </thead>
            <tbody v-for="(monthExpense, index) in monthExpenses" :key="index">
                <month-tables
                    v-model="monthExpenses[index]"
                    route="monthExpenses"
                    @delete="getMonthExpenses"
                ></month-tables>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ monthExpensesTotal }}</th>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <table-categories></table-categories>

        <!-- Month Earnings Table -->
        <h4 class="mt-2">Ganhos</h4>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Ganho</th>
                    <th>Valor</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody v-for="(monthEarning, index) in monthEarnings" :key="index">
                <month-tables
                    v-model="monthEarnings[index]"
                    route="monthEarnings"
                    @delete="getMonthEarnings"
                ></month-tables>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ monthEarningsTotal }}</th>
                    <td></td>
                </tr>
            </tfoot>
        </table>

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
</template>

<script>
import DetailsComponent from "../details/TableCategories.vue";
export default {
    components: { DetailsComponent },
    props: [],
    data: function () {
        return {
            showMonthExpensesCategoryCreateUpdateModal: false,
            showNewMonthEarningModal: false,
            monthExpenses: [],
            monthEarnings: [],
            monthExpensesTotal: "",
            monthEarningsTotal: "",
            dailyExpensesTotal: "",
            categories: [],

        };
    },
    mounted() {
        this.getMonthEarnings();
        this.getMonthExpenses();
        this.getDailyExpensesTotal();
        this.getCategories()
    },
    methods: {
        getMonthExpensesCategories(){

        },
        monthExpensesCategoryHasBeenSaved(){
            this.showMonthExpensesCategoryCreateUpdateModal = false
            this.getMonthExpensesCategories()
        },
        getCategories() {
            let url = "/api/categories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    this.categories = response.data.categories.data;
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
                        this.dailyExpensesTotal = response.data;
                    },
                }
            );
        },
        getMonthExpenses() {
            let url = `/api/monthExpenses`;

            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.monthExpenses = response.data.monthExpenses.data;
                        this.monthExpensesTotal =
                            response.data.monthExpensesTotal;
                        console.log(response.data);
                    },
                }
            );
        },
        getMonthEarnings() {
            let url = `/api/monthEarnings`;

            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.monthEarnings = response.data.monthEarnings.data;
                        this.monthEarningsTotal =
                            response.data.monthEarningsTotal;

                        console.log(response.data);
                    },
                }
            );
        },
        // monthExpenseHasBeenSaved() {
        //     this.showNewMonthExpenseModal = false;
        //     this.getMonthExpenses();
        // },
        monthEarningHasBeenSaved() {
            this.showNewMonthEarningModal = false;
            this.getMonthEarnings();
        },
    },
    computed: {
        monthDebt() {
            let totalExpenses =
                Number(this.monthExpensesTotal) +
                Number(this.dailyExpensesTotal);
            return Number(this.monthEarningsTotal) - totalExpenses;
        },
        isMonthDebtBiggerThanZero() {
            return this.monthDebt >= 0;
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
</style>
