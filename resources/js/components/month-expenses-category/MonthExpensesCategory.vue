<template>
    <b-container>

        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>
                    <b-button
                        variant="danger"
                        size="sm"
                        class="float-left btn-xs"
                    ><i class="fas fa-times fa-sm"></i
                    ></b-button>
                </th>
                <th colspan="2">{{ expenseMonthCategory.name }}</th>
                <th>
                    <b-button
                        variant="success"
                        size="sm"
                        class="float-right"
                        @click="showNewMonthExpenseModal = !showNewMonthExpenseModal"
                    >Nova Conta
                    </b-button
                    >
                </th>
            </tr>
            </thead>
            <!--            <tbody v-for="(expense, index) in expenses" :key="index">-->
            <!--            <expense-row-component-->
            <!--                :category-id="category.id"-->
            <!--                :expense="expenses[index]"-->
            <!--                @delete="$emit('update')"-->
            <!--            ></expense-row-component>-->
            <!--            </tbody>-->
            <tfoot>
            <tr>
                <th>Total</th>
                <th></th>
                <!--                <th>{{ category.totalCategoryExpenses }}</th>-->
                <th></th>
            </tr>
            </tfoot>
        </table>
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
    </b-container>
</template>

<script>
export default {
    props: {
        value: {
            required: true,
            type: Object
        }
    },
    data: function () {
        return {
            expenseMonthCategory: this.value,
            showNewMonthExpenseModal: false,

        }
    },
    created() {
    },
    methods: {
        monthExpenseHasBeenSaved() {
            this.showNewMonthExpenseModal = false;
            this.$emit('update')
            // this.$emit('input', this.expenseMonthCategory)
            // this.getMonthExpenses();
        },
    },
}
</script>
