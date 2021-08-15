<template>
    <div>
        <b-row>
            <b-col>
                <b-form-select v-model="selectedYear" :options="years"></b-form-select>
            </b-col>
            <b-col>
                <b-form-select v-model="selectedMonth" :options="monthsOfYear"></b-form-select>
            </b-col>
<!--            <b-col cols="2">
                <b-button><i class="fas fa-search"></i></b-button>
            </b-col>-->
        </b-row>
        <previous-months-expenses :date="date"></previous-months-expenses>
    </div>
</template>

<script>
export default {
    props: {},
    data: function () {
        return {
            selectedYear: dayjs().format('YYYY'),
            selectedMonth: Number(dayjs().format('MM')),
            years: [
                {value: null, text: 'Ano', disabled:true},
            ],
            monthsOfYear: [
                {value: null, text: 'Mês', disabled:true},
            ]
        }
    },
    created() {
        this.createYears()
        this.createMonthsOfYear()
    },
    methods: {
        createYears() {
            let year = '';
            for (let i = 2021; i < 2030; i++) {
                year = i;
                this.years.push(year)
            }
        },
        createMonthsOfYear() {
            let month = "";
            for (let i = 1; i <= 12; i++) {
                month = i;
                this.monthsOfYear.push(month)
            }
        },
    },
    computed: {
        date(){
            if(!this.selectedYear || !this.selectedMonth ) {
                return {}
            }
            return {
                'year': this.selectedYear,
                'month': this.selectedMonth,
            }
        }
    },
    watch: {}
}
</script>

<style scoped>

</style>
