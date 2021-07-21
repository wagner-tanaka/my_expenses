<template>
    <div>
        <b-table
            small
            striped="striped"
            head-variant="light"
            hover
            :fields="fields"
            :items="expenses"
        >
            <template #cell(excluir_ou_editar_despesa)="item">
                <b-button
                    size="sm"
                    variant="outline-secondary"
                    style="cursor: pointer; color: black"
                    @click="deleteExpense(item.item)"
                >
                    <i class="fa fa-trash-alt" aria-hidden="true"> </i>
                </b-button>
            </template>
            <!-- <template #cell(value)="item">
                <b-button
                    size="sm"
                    variant="outline-secondary"
                    style="cursor: pointer; color: black"
                >
                    {{ item.value }}
                </b-button>
            </template> -->
            <template #cell(data)="data">
                {{ data.item.date }} -- {{ data.item.time }}
            </template>
            <template v-slot:custom-foot>
                <b-tr style="background-color: #d3d3d3">
                    <b-td class="text-center">
                        <strong>Total</strong>
                    </b-td>
                    <b-td></b-td>
                    <b-td class="text-center">
                        <strong>{{ value.totalCategoryExpenses }}</strong>
                    </b-td>
                    <b-td></b-td>
                </b-tr>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            required: true,
            // type: Array,
        },
    },
    data: function () {
        return {
            fields: [
                { key: "data", sortable: true },
                { key: "name", label: "Despesa", sortable: true },
                { key: "value", label: "Valor", sortable: true },
                { key: "excluir_ou_editar_despesa", label: "" },
            ],
            expenses: this.value.expenses.data,
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
                    onSuccess: (response) => {
                        this.expenses.splice(expenseIndex, 1);
                        this.$emit('update')
                    },
                }
            );
        },
    },
    watch: {
        value() {
            this.expenses = this.value.expenses.data;
        },
    },
};
</script>