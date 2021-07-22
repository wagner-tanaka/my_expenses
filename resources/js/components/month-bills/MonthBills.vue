<template>
    <div>
        <b-button
            variant="primary"
            @click="showNewMonthExpenseModal = !showNewMonthExpenseModal"
            >Adicionar Conta</b-button
        >
        <b-modal
            v-model="showNewMonthExpenseModal"
            title="Adicionar conta do Mes"
            centered
            hide-footer
        >
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

            <div class="text-center mt-2">
                <b-button variant="danger mr-2" @click="cancelExpenseCreation"
                    >Cancelar</b-button
                >
                <b-button variant="success" @click="submitExpense"
                    >Salvar</b-button
                >
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            showNewMonthExpenseModal: false,
            form: {
                name: '',
                value: ''
            }
        };
    },
    mounted() {
        //
    },
    methods: {
         submitExpense() {
            let url = `/api/bills`;
            this.request("post", url, this.form, {
                onSuccess: (response) => {
                    this.form = {};
                    this.showNewMonthExpenseModal = false;
                },
            });
        },
        cancelExpenseCreation() {
            this.showNewMonthExpenseModal = false;
        },
    },
};
</script>