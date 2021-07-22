<template>
    <div>
        <div>
            <b-button
                variant="primary"
                class="mr-1"
                @click="
                    showNewMonthExpenseseModal = !showNewMonthExpenseseModal
                "
                >Adicionar Despesa
            </b-button>

            <b-button
                variant="primary"
                class="ml-1"
                @click="showNewMonthEarningModal = !showNewMonthEarningModal"
                >Adicionar Ganho
            </b-button>
        </div>
        <b-modal
            v-model="showNewMonthExpenseseModal"
            title="Adicionar conta do Mes"
            centered
            hide-footer
        >
            <month-expense-create @save="showNewMonthExpenseseModal = false"></month-expense-create>
        </b-modal>
        <b-modal
            v-model="showNewMonthEarningModal"
            title="Adicionar conta do Mes"
            centered
            hide-footer
        >
            <month-earning-create @save="showNewMonthEarningModal = false"></month-earning-create>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            showNewMonthExpenseseModal: false,
            showNewMonthEarningModal: false,
            
        };
    },
    mounted() {
        //
    },
    methods: {
        
    },
};
</script>