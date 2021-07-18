<template>
    <div>
        <b-button
            variant="warning"
            class="mb-2 w-100"
            @click="
                (expenseModal = true),
                    (form.name = expense.name),
                    (form.category_id = category.id)
            "
        >
            {{ expense.name }} <br />
            {{ expense.value }}
        </b-button>
        <!-- Expense Modal -->
        <b-modal
            v-model="expenseModal"
            hide-footer
            :title="expense.name"
            centered
        >
            <div class="container">
                <b-input
                    v-model="form.value"
                    class="mt-2"
                    placeholder="Valor do gasto!"
                ></b-input>

                <div class="text-center mt-2">
                    <b-button
                        variant="danger mr-2"
                        @click="cancelExpenseCreation"
                        >Cancelar</b-button
                    >
                    <b-button variant="success" @click="submitExpense"
                        >Salvar</b-button
                    >
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
     model: {
        prop: "expense",
    },
    props: {
        category:{
            required: true
        },
        expense: {
            required: true,
        },
    },
    data: function () {
        return {
            expenseModal: false,
             form: {
                name: "",
                category_id: null,
            },
        };
    },
    mounted() {
        //
    },
    methods: {
        submitExpense() {
            this.form.category_id = this.category.id;
            let url = `/api/expenses`;
            this.request("post", url, this.form, {
                onSuccess: (response) => {
                    this.form = {};
                    this.form.category_id = null;
                    this.expenseModal = false;
                    this.showNewExpensesModal = false;
                    this.$emit("update");
                },
            });
        },
        cancelExpenseCreation() {
            this.showNewExpensesModal = false;
            this.expenseModal = false;
            this.form.category_id = null;
        },
    },
};
</script>