<template>
    <b-container>
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-footer-header-color">
            <tr>
                <th>
                    <b-button
                        @click="deleteCategory"
                        variant="secondary"
                        size="sm"
                        class="float-left btn-xs"
                    ><i class="fas fa-trash-alt fa-sm"></i
                    ></b-button>
                </th>
                <th colspan="2">
                    <a
                        class="text-center text-white"
                        @click="showEditMonthExpensesCategoryNameModal = true"
                    >
                        <strong>{{ monthExpensesCategory.name }}</strong>
                    </a>
                </th>
                <th>
                    <b-button
                        class="float-right"
                        size="sm"
                        variant="danger"
                        @click="showCreateMonthExpenseModal = !showCreateMonthExpenseModal"
                    ><i class="fas fa-plus"></i>
                    </b-button>
                </th>
            </tr>
            </thead>
            <tbody >
            <month-expenses-category-table-row
                v-for="(monthExpense, index) in monthExpenses" :key="JSON.stringify(monthExpense)"
                :category-id="monthExpensesCategory.id"
                :monthExpense="monthExpenses[index]"
                @delete="$emit('update')"
            ></month-expenses-category-table-row>
            </tbody>
            <tfoot class="table-footer-header-color">
            <tr>
                <th>Total</th>
                <th></th>
                <th>{{ monthExpensesCategory.monthExpensesCategoryTotal }}</th>
                <th></th>
            </tr>
            </tfoot>
        </table>

        <!--        Month Expenses Create Modal -->
        <b-modal
            v-model="showCreateMonthExpenseModal"
            :title="__('global.add_month_expenses')"
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
            :title="__('global.edit_category')"
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
    model: {
        prop: "monthExpensesCategory",
    },
    props: {
        monthExpensesCategory: {
            required: true,
            type: Object
        },
    },
    data: function () {
        return {
            monthExpenses: this.monthExpensesCategory.monthExpenses.data,
            showCreateMonthExpenseModal: false,
            showEditMonthExpensesCategoryNameModal: false

        }
    },
    mounted() {
    },
    methods: {
        monthExpensesCategoryHasBeenUpdated() {
            this.showEditMonthExpensesCategoryNameModal = false
        },
        monthExpenseHasBeenSaved() {
            this.showCreateMonthExpenseModal = false;
            this.$emit('update')
        },
        deleteCategory() {
            if (
                !confirm(this.__('global.delete_category_confirm'))
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
        monthExpensesCategory() {
            this.monthExpenses = this.monthExpensesCategory.monthExpenses.data
            console.log('monthExpensesCategory - monthExpensesCategory', this.monthExpensesCategory)
        },
    }
}
</script>
<style scoped>
.table-footer-header-color{
    background-color: #9a5c5c;
    color: white;
}
table {
    border-collapse: collapse;
    width: 100%;
}
tbody tr:nth-child(odd){
    background-color: #FFE6D9;
}
tbody tr:nth-child(even){
background-color: #D9B6A3;
}
</style>
