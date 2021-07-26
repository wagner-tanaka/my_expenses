<template>
    <div>
        <b-input
            type="text"
            v-model="form.name"
            class="mt-2"
            placeholder="Nome da conta aqui!"
        ></b-input>

        <b-input
            type="number"
            v-model="form.value"
            class="mt-2"
            placeholder="Valor da conta!"
        ></b-input>

        <b-form-checkbox
            v-model="form.is_fixed"
            class="mt-2"
        >
            Fixar Conta
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
    props: [],
    data: function () {
        return {
            form: {
                name: "",
                value: "",
                is_fixed: false
            },
        };
    },
    mounted() {
        //
    },
    methods: {
        submitExpense() {
            let url = `/api/monthExpenses`;
            this.request("post", url, this.form, {
                onSuccess: () => {
                    this.form = {};
                    this.$emit('save')
                },
            });
        },
        cancelExpenseCreation() {
            this.$emit('save')
            this.showNewMonthExpenseseModal = false;
        },
    },
};
</script>
