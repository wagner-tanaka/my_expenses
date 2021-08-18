<template>
    <div>
        <b-input
            type="text"
            v-model="form.name"
            class="mt-2"
            placeholder="Nome do ganho aqui!"
        ></b-input>

        <b-input
            type="number"
            v-model="form.value"
            class="mt-2"
            placeholder="Valor do ganho!"
        ></b-input>

        <b-form-select v-model="selected" :options="daysOfMonth" class="mt-2"></b-form-select>

        <b-form-checkbox
            v-model="form.is_fixed"
            class="mt-2"
        >
            Fixar Ganho
        </b-form-checkbox>

        <div class="text-center mt-2">
            <b-button variant="danger mr-2" @click="cancelEarningCreation"
                >Cancelar</b-button
            >
            <b-button variant="success" @click="submitEarning">Salvar</b-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        monthEarningsCategory:{
            required:true,
            type:Object
        }
    },
    data: function () {
        return {
            form: {
                name: "",
                value: "",
                received_day:"",
                is_fixed: false
            },
            selected: null,
            daysOfMonth: [
                { value: null, text: 'Selecione o dia do ganho' },
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
        submitEarning() {
            this.form.pay_day = this.selected
            let url = `/api/monthEarnings`;
            this.form.month_earnings_category_id = this.monthEarningsCategory.id
            this.request("post", url, this.form, {
                onSuccess: () => {
                    this.form = {};
                    this.$emit('save')
                },
            });
        },
        cancelEarningCreation() {
            this.$emit('save')
            this.showNewMonthEarningseModal = false;
        },
    },
};
</script>
