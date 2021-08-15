<template>
    <div>
        <div v-if="previousMonthExpenses.length > 1" class="expensesBackgroundColor">
            <div class="mb-2 mt-2 expensesTitleStyle ">
                Despesas Mensais
            </div>
            <b-container>
                <table class="table table-striped table-bordered table-sm">
                    <thead class="table-footer-header-color">
                    <tr>
                        <th>Despesa</th>
                        <th>Valor</th>
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
            <b-row class="expensesTotalStyle mb-2">
                <b-col class="align-self-center">Total Despesas</b-col>
                <b-col class="align-self-center"><strong>2000000</strong></b-col>
            </b-row>
        </div>
        <div v-else class="p-5">
            <h4>Nenhum deste mes encontrado!</h4>
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
        }
    },
    created() {
        this.getExpenses()
    },
    methods: {
        getExpenses() {
            // /users?filter[name]=john&filter[email]=gmail
            // let url = '/api/get_month_expenses_filtered'
            this.request('get', this.url, {}, {
                onSuccess: (response) => {
                    this.previousMonthExpenses = response.data.monthExpensesFiltered.data
                    console.log('response', this.previousMonthExpenses)

                }
            })
        }
    },
    computed: {
        url() {
            return `/api/get_month_expenses_filtered?filter[for_date]=${this.date.year}-${this.date.month}`
        }
    },
    watch: {
        date() {
            this.getExpenses()
            console.log('date', this.date)
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
