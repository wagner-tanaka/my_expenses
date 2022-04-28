<template>
    <div>
        <b-row class="mt-2">
            <b-col>
                <b-form-select v-model="selectedYear" :options="years"></b-form-select>
            </b-col>
            <b-col>
                <b-form-select v-model="selectedMonth" :options="monthsOfYear"></b-form-select>
            </b-col>
        </b-row>

        <b-row
            v-if="!isPreviousMonthExpensesEmpty || !isPreviousMonthEarningsEmpty"
            class="mt-2"
            :class="
                        isMonthDebtBiggerThanZero
                            ? 'monthDebtClassBiggerThanZero'
                            : 'monthDebtClassLessThanZero'
                    "
        >
            <b-col class="text-right">{{ __('global.debt') }}</b-col>
            <b-col class="text-left">{{ monthDebt }}</b-col>
        </b-row>

        <previous-months-expenses :date="date"
                                  @previousMonthExpensesTotal="previousMonthExpensesTotal = $event"
                                  @previousMonthExpensesEmpty="isPreviousMonthExpensesEmpty = $event">
        </previous-months-expenses>
        <previous-months-earnings :date="date"
                                  @previousMonthEarningsTotal="previousMonthEarningsTotal = $event"
                                  @previousMonthEarningsEmpty="previousMonthEarningsEmpty = $event">
        </previous-months-earnings>
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
                {value: null, text: 'Ano', disabled: true},
            ],
            monthsOfYear: [
                {value: null, text: 'Mês', disabled: true},
            ],
            previousMonthEarningsTotal: '',
            previousMonthExpensesTotal: '',
            isPreviousMonthExpensesEmpty: true,
            isPreviousMonthEarningsEmpty: true
        }
    },
    created() {
        this.createYears()
        this.createMonthsOfYear()
    },
    methods: {
        showHideDebitRow(event) {
            this.isPreviousMonthExpensesEmpty = event
            console.log('event', event)
            console.log('isPreviousMonthExpensesEmpty', this.isPreviousMonthExpensesEmpty)
        },
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
        date() {
            if (!this.selectedYear || !this.selectedMonth) {
                return {}
            }
            return {
                'year': this.selectedYear,
                'month': this.selectedMonth,
            }
        },
        monthDebt() {
            return Number(this.previousMonthEarningsTotal) - Number(this.previousMonthExpensesTotal);
        },
        isMonthDebtBiggerThanZero() {
            return this.monthDebt >= 0;
        },
    },
}
</script>

<style scoped>
.monthDebtClassBiggerThanZero {
    font-size: 1.5em;
    background-color: #00851F;
}

.monthDebtClassLessThanZero {
    font-size: 1.5em;
    background-color: #e33949;
}
</style>
