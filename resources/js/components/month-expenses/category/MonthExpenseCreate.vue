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

        <b-form-select v-model="selected" :options="daysOfMonth" class="mt-2"></b-form-select>

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
    props: {
        monthExpensesCategory:{
            required:true,
            type:Object
        }
    },
    data: function () {
        return {
            form: {
                name: "",
                value: "",
                pay_day:"",
                is_fixed: false
            },
            selected: null,
            daysOfMonth: [
                { value: null, text: 'Selecione o dia da conta' },
            ]
        };
    },
    mounted() {
        this.createDaysOfMonth()
    },
    methods: {
        createDaysOfMonth(){
            let day = "";
            for (let i = 1; i < 32; i++) {
                day = i;
                this.daysOfMonth.push(day)
            }
        },
        submitExpense() {
            this.form.pay_day = this.selected
            let url = `/api/monthExpenses`;
            this.form.month_expenses_category_id = this.monthExpensesCategory.id
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
