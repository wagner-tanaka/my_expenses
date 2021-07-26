<template>
    <div class="container">
        <b-input
            type="text"
            v-model="form.name"
            class="mt-2"
            placeholder="Nome do gasto aqui!"
        ></b-input>
        <b-input
            type="number"
            v-model="form.value"
            class="mt-2"
            placeholder="Valor do gasto!"
        ></b-input>
        <b-form-checkbox
            v-model="form.is_fixed"
            class="mt-2"
        >
            Fixar gasto
        </b-form-checkbox>
        <div class="text-center mt-2">
            <b-button variant="danger mr-2" @click="cancelExpenseCreation"
                >Cancelar</b-button
            >
            <b-button variant="success" @click="submitExpense">Salvar</b-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        category:{
            required: true,
            type: Object,
            // default: ()=>({})
        },
    },
    data: function () {
        return {
            form: {
                name: "",
                category_id: null,
                is_fixed: false
            },

        };
    },
    mounted() {
    },
    methods: {
         submitExpense() {
            this.form.category_id = this.category.id;
            let url = `/api/expenses`;
            this.request("post", url, this.form, {
                onSuccess: () => {
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
