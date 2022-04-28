<template>
    <div>
        <!-- O problema eh aqui, quando nao tem monthExpenses, nao aparece as despesas diarias. -->
        <div class="expensesBackgroundColor">
            <div class="mb-2 mt-2 expensesTitleStyle ">
                {{ __('global.month_expenses') }}
            </div>
            <b-container>
                <table v-if="previousMonthExpenses.length > 0" class="table table-striped table-bordered table-sm">
                    <thead class="table-footer-header-color">
                    <tr>
                        <th colspan="2">{{ __('global.month_bills') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <previous-month-expenses-table-row
                        v-for="(previousMonthExpense, index) in previousMonthExpenses"
                        :key="JSON.stringify(previousMonthExpense)"
                        :previousMonthExpense="previousMonthExpenses[index]"
                    ></previous-month-expenses-table-row>
                    </tbody>
                    <tfoot class="table-footer-header-color">
                    <tr>
                        <td><strong>{{ __('global.total') }}</strong></td>
                        <td><strong>{{ monthExpensesSubTotal }}</strong></td>
                    </tr>
                    </tfoot>
                </table>
            </b-container>

            <daily-expenses-table  :date="date" @dailyExpensesTotal="dailyExpensesTotal = $event"></daily-expenses-table>

            <b-row class="expensesTotalStyle mb-2">
                <b-col class="align-self-center">{{ __('global.expenses_total') }}</b-col>
                <b-col class="align-self-center"><strong>{{ totalMonthExpenses }}</strong></b-col>
            </b-row>
        </div>
            <!-- <div class="p-2">
                <h4>Nenhum gasto deste mês encontrado!</h4>
            </div> -->
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
            dailyExpensesTotal: 0,
            totalMonthExpenses: 0
        }
    },
    created() {
        this.getMonthExpenses()
    },
    methods: {
        getMonthExpenses() {
            this.request('get', this.monthExpensesUrl, {}, {
                onSuccess: (response) => {
                    console.log('monthExpensesBug', response.data.monthExpensesFiltered)
                    this.previousMonthExpenses = response.data.monthExpensesFiltered.data
                    if (this.previousMonthExpenses.length === 0) {
                        this.$emit('previousMonthExpensesEmpty', true)
                        return
                    }
                    this.$emit('previousMonthExpensesEmpty', false)
                }
            })
        }
    },
    computed: {
        monthExpensesUrl() {
            return `/api/get_month_expenses_filtered?filter[for_date]=${this.date.year}-${this.date.month}`
        },
        monthExpensesSubTotal() {

            let subTotal = this.previousMonthExpenses.reduce((accumulator, value) => {
                return accumulator + parseInt(value.value)
            }, 0)

            this.totalMonthExpenses = subTotal

            return subTotal
        
        },
    },
    watch: {
        date() {
            this.getMonthExpenses()
        },
        dailyExpensesTotal() {
            console.log('totalMonthExpenses', this.totalMonthExpenses)
            this.totalMonthExpenses = this.monthExpensesSubTotal + this.dailyExpensesTotal
        },
        totalMonthExpenses() {
            this.$emit('previousMonthExpensesTotal', this.totalMonthExpenses)
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
