<template>
    <div>
        <div v-if="previousMonthExpenses.length > 0" class="expensesBackgroundColor">
            <div class="mb-2 mt-2 expensesTitleStyle ">
                Despesas Mensais
            </div>
            <b-container>
                <table class="table table-striped table-bordered table-sm">
                    <thead class="table-footer-header-color">
                    <tr>
                        <th colspan="2">Contas Mensais</th>
                    </tr>
                    </thead>
                    <tbody>
                    <previous-month-expenses-table-row
                        v-for="(previousMonthExpense, index) in previousMonthExpenses"
                        :key="JSON.stringify(previousMonthExpense)"
                        :previousMonthExpense="previousMonthExpenses[index]"
                    ></previous-month-expenses-table-row>
                    </tbody>
                </table>
            </b-container>

            <daily-expenses-table :date="date"></daily-expenses-table>

            <b-row class="expensesTotalStyle mb-2">
                <b-col class="align-self-center">Total Despesas</b-col>
                <b-col class="align-self-center"><strong>2000000</strong></b-col>
            </b-row>
        </div>
        <div v-else class="p-5">
            <h4>Nenhum gasto deste mes encontrado!</h4>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        date: {
            type: Object
        }
    },
    data: function () {
        return {
            filter: {
                created_at: "",
            },
            previousMonthExpenses: [],
            previousDailyExpenses: [],
        }
    },
    created() {
        this.getMonthExpenses()
        this.getDailyExpenses()
    },
    methods: {
        getDailyExpenses() {
            this.request('get', this.dailyExpensesUrl, {}, {
                onSuccess: (response) => {
                    this.previousDailyExpenses = response.data.dailyExpensesFiltered.data
                    // console.log('response dailyExpenses', this.previousDailyExpenses)
                }
            })
        },
        getMonthExpenses() {
            this.request('get', this.monthExpensesUrl, {}, {
                onSuccess: (response) => {
                    this.previousMonthExpenses = response.data.monthExpensesFiltered.data

                }
            })
        }
    },
    computed: {
        monthExpensesUrl() {
            return `/api/get_month_expenses_filtered?filter[for_date]=${this.date.year}-${this.date.month}`
        },
        dailyExpensesUrl() {
            return `/api/get_daily_expenses_filtered?filter[for_date]=${this.date.year}-${this.date.month}`
        }
    },
    watch: {
        date() {
            this.getMonthExpenses()
            this.getDailyExpenses()
        }
    }
}
</script>

<style scoped>
.expensesTitleStyle {
    background-color: #6e0e16;
    height: 37px;
    line-height: 37px;
    font-size: 1.4em;
    border-radius: 6px;
    color: #fff;
}

.table-footer-header-color {
    background-color: #9a5c5c;
    color: white;
}

.expensesTotalStyle {
    background-color: #6E0E16;
    height: 2em;
    font-size: 1.2em;
    border-radius: 6px;
    color: #fff;
}

.expensesBackgroundColor {
    background-color: #c4aeac
}

tbody tr:nth-child(odd) {
    background-color: #FFE6D9;
}

tbody tr:nth-child(even) {
    background-color: #D9B6A3;
}
</style>
