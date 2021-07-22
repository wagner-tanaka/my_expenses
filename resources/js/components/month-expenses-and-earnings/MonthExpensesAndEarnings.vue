<template>
    <div>
        <div>
            <b-button
                variant="primary"
                class="mr-1"
                @click="showNewMonthExpenseModal = !showNewMonthExpenseModal"
                >Adicionar Despesa
            </b-button>

            <b-button
                variant="primary"
                class="ml-1"
                @click="showNewMonthEarningModal = !showNewMonthEarningModal"
                >Adicionar Ganho
            </b-button>
        </div>

        <b-row class="mt-2" :class="isMonthDebtBiggerThanZero ? 'monthDebtClassBiggerThanZero' : 'monthDebtClassLessThanZero'">
            <b-col class="text-right">Debito</b-col>
            <b-col class="text-left">{{ monthDebt }}</b-col>
        </b-row>

        <!-- Month Expenses Table -->
        <h4 class="mt-2">Despesas</h4>
        <table class="table table-sm mt-1">
            <thead>
                <tr>
                    <th>Gasto</th>
                    <th>Valor</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody v-for="(monthExpense, index) in monthExpenses" :key="index">
                <month-tables v-model="monthExpenses[index]" route="monthExpenses" @delete="getMonthExpenses"></month-tables>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ monthExpensesTotal }}</th>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!-- Month Earnings Table -->
        <h4 class="mt-2">Ganhos</h4>
        <table class="table table-sm mt-1">
            <thead>
                <tr>
                    <th>Ganho</th>
                    <th>Valor</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody v-for="(monthEarning, index) in monthEarnings" :key="index">
                <month-tables v-model="monthEarnings[index]" route="monthEarnings" @delete="getMonthEarnings"></month-tables>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ monthEarningsTotal }}</th>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!-- Month Expense Modal -->
        <b-modal
            v-model="showNewMonthExpenseModal"
            title="Adicionar conta do Mes"
            centered
            hide-footer
        >
            <month-expense-create
                @save="monthExpenseHasBeenSaved"
            ></month-expense-create>
        </b-modal>

        <!-- Month Earning Modal -->
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
export default {
    props: [],
    data: function () {
        return {
            showNewMonthExpenseModal: false,
            showNewMonthEarningModal: false,
            monthExpenses: [],
            monthEarnings: [],
        };
    },
    mounted() {
        this.getMonthEarnings();
        this.getMonthExpenses();
    },
    methods: {
        getMonthExpenses() {
            let url = `/api/monthExpenses`;

            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.monthExpenses = response.data.monthExpenses.data;
                        console.log(response.data.monthExpenses.data);
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
                        console.log(response.data.monthEarnings.data);
                    },
                }
            );
        },
        monthExpenseHasBeenSaved() {
            this.showNewMonthExpenseModal = false;
            this.getMonthExpenses();
        },
        monthEarningHasBeenSaved() {
            this.showNewMonthEarningModal = false;
            this.getMonthEarnings();
        },
    },
    computed: {
        monthExpensesTotal() {
            let initialValue = 0;
            return this.monthExpenses.reduce(
                (accumulator, currentValue) => accumulator + currentValue.value,
                initialValue
            );
        },
        monthEarningsTotal() {
            let initialValue = 0;
            return this.monthEarnings.reduce(
                (accumulator, currentValue) => accumulator + currentValue.value,
                initialValue
            );
        },
        monthDebt() {
            return this.monthEarningsTotal - this.monthExpensesTotal;
        },
        isMonthDebtBiggerThanZero() {
            if (this.monthDebt >= 0) {
                return true;
            }
            return false;
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