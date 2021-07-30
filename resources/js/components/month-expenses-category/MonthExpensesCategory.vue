<template>
    <b-container>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>
                    <b-button
                        @click="deleteCategory"
                        variant="danger"
                        size="sm"
                        class="float-left btn-xs"
                    ><i class="fas fa-times fa-sm"></i
                    ></b-button>
                </th>
                <th colspan="2">
                    <a
                        class="text-center"
                        @click="showEditMonthExpensesCategoryNameModal = true"
                    >
                        <strong>{{ monthExpensesCategory.name }}</strong>
                    </a>
                </th>
                <th>
                    <b-button
                        variant="success"
                        size="sm"
                        class="float-right"
                        @click="showCreateMonthExpenseModal = !showCreateMonthExpenseModal"
                    >Nova Conta
                    </b-button
                    >
                </th>
            </tr>
            </thead>
            <tbody v-for="(monthExpense, index) in monthExpenses" :key="index">
            <month-expense-row
                :category-id="value.id"
                :monthExpense="monthExpenses[index]"
                @delete="$emit('update')"
            ></month-expense-row>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th></th>
                <!--                <th>{{ category.totalCategoryExpenses }}</th>-->
                <th></th>
            </tr>
            </tfoot>
        </table>

        <!--        Month Expenses Create Modal -->
        <b-modal
            v-model="showCreateMonthExpenseModal"
            title="Adicionar conta do Mes"
            centered
            hide-footer
        >
            <month-expense-create
                :monthExpensesCategory="monthExpensesCategory"
                @save="monthExpenseHasBeenSaved"
            ></month-expense-create>
        </b-modal>

        <!-- Edit Category name Modal -->
        <b-modal
            v-model="showEditMonthExpensesCategoryNameModal"
            title="Editar Categoria"
            centered
            hide-footer
        >
            <month-expenses-category-create-update
                v-model="monthExpensesCategory"
                @update="monthExpensesCategoryHasBeenUpdated"
                @cancel="showEditMonthExpensesCategoryNameModal = false"
            ></month-expenses-category-create-update>
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
            monthExpensesCategory: this.value,
            monthExpenses: [],
            showCreateMonthExpenseModal: false,
            showEditMonthExpensesCategoryNameModal: false

        }
    },
    created() {
        this.monthExpenses = this.value.monthExpenses.data
    },
    methods: {
        monthExpensesCategoryHasBeenUpdated() {
            this.showEditMonthExpensesCategoryNameModal = false
        },
        monthExpenseHasBeenSaved() {
            this.showCreateMonthExpenseModal = false;
            this.$emit('update')
            // this.$emit('input', this.monthExpensesCategory)
            // this.getMonthExpenses();
        },
        deleteCategory() {
            if (
                !confirm(
                    "Se voce excluir a categoria, ira excluir todos os gastos desta categoria tambem. \n Quer mesmo excluir?"
                )
            ) {
                return;
            }
            let url = `/api/monthExpensesCategories/${this.monthExpensesCategory.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: () => {
                        this.$emit("update");
                    },
                }
            );
        },
    },
    watch: {
        monthExpenses: function () {
            console.log('chego no MonthCategoria')
        }
    }
}
</script>
