<template>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Despesa</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody v-for="(expense, index) in expenses" :key="JSON.stringify(expense)">
                <daily-expense-row
                    :category-id="category.id"
                    :expense="expenses[index]"
                    @delete="$emit('update')"
                ></daily-expense-row>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th>{{ category.totalCategoryExpenses }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        category: {
            required: true,
            type: Object,
        },
    },
    data: function () {
        return {
            expenses: this.category.expenses.data,
        };
    },
    mounted() {
        // this.getExpenses()
    },
    methods: {
        deleteExpense(expense) {
            let expenseIndex = this.expenses.indexOf(expense);
            let url = `/api/expenses/${expense.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: () => {
                        this.expenses.splice(expenseIndex, 1);
                        this.$emit("update");
                    },
                }
            );
        },
    },
    watch: {
        category() {
            this.expenses = this.category.expenses.data;
        },
    },
};
</script>
