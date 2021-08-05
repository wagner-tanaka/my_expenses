<template>
    <b-container>
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-footer-header">
            <tr>
                <th>Ganho</th>
                <th>Valor</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody >
            <month-earning-table
                v-for="(monthEarning, index) in monthEarnings" :key="index"
                v-model="monthEarnings[index]"
                route="monthEarnings"
                @delete="getMonthEarnings"
            ></month-earning-table>
            </tbody>
        </table>

        <b-row class="earningsTotalStyle">
            <b-col class="align-self-center">Total Ganhos</b-col>
            <b-col class="align-self-center"><strong>{{ monthEarningsTotal }}</strong></b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    props: { },
    data: function () {
        return {
            monthEarnings: [],
            monthEarningsTotal: "",

        }
    },
    mounted() {
        this.getMonthEarnings();
    },
    methods: {
        getMonthEarnings() {
            let url = `/api/monthEarnings`;

            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.monthEarnings = response.data.monthEarnings.data;
                        this.monthEarningsTotal = response.data.monthEarningsTotal;
                        this.$emit('monthEarningsTotal', this.monthEarningsTotal)
                    },
                }
            );
        },
    },
}
</script>
<style scoped>
.table-footer-header {
    background: #5468ff;
    color: white;
}
.earningsTotalStyle{
    background-color: #5468ff;
    height: 2em;
    font-size: 1.2em;
    border-radius: 6px;
    color: white;
    margin-left: -31px;
    margin-right: -31px;
}

</style>
