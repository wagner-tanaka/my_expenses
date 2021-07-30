<template>
    <div>
        <div class="mb-2 mt-2">
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
            v-for="(monthExpensesCategory, index) in monthExpensesCategories"
            :key="monthExpensesCategory.id"
        >
            <month-expenses-category
                v-model="monthExpensesCategories[index]"
                @update="getMonthExpensesCategories"
            ></month-expenses-category>
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
            monthExpensesCategories: [],

        };
    },
    mounted() {
        this.getMonthEarnings();
        this.getMonthExpenses();
        this.getDailyExpensesTotal();
        this.getMonthExpensesCategories()
    },
    methods: {
        getMonthExpensesCategories(){
            console.log('update expense')
            let url = "/api/monthExpensesCategories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    console.log('salvou e pego as categorias')
                    this.monthExpensesCategories = response.data.monthExpensesCategories.data;
                    this.capitalizeCategoryNameFirstLetter();
                    this.orderCategoriesByName();
                },
            });
        },
        monthExpensesCategoryHasBeenSaved(){
            this.showMonthExpensesCategoryCreateUpdateModal = false
            this.getMonthExpensesCategories()
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
