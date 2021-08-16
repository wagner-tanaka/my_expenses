<template>
    <div>
        <div v-if="previousMonthEarnings.length > 0" class="earningsBackgroundColor">
            <div class="mb-2 mt-2 earningsTitleStyle ">
                Ganhos Mensais
            </div>
            <b-container>
                <table class="table table-striped table-bordered table-sm">
                    <thead class="table-footer-header-color">
                    <tr>
                        <th>Ganho</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <previous-month-earnings-table-row
                        v-for="(previousMonthEarning, index) in previousMonthEarnings"
                        :key="JSON.stringify(previousMonthEarning)"
                        :previousMonthEarning="previousMonthEarnings[index]"
                    ></previous-month-earnings-table-row>
                    </tbody>
                </table>
            </b-container>
            <b-row class="earningsTotalStyle mb-2">
                <b-col class="align-self-center">Total Ganhos</b-col>
                <b-col class="align-self-center"><strong>2000000</strong></b-col>
            </b-row>
        </div>
        <div v-else class="p-5">
            <h4>Nenhum Ganho deste mes encontrado!</h4>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        date: {
            type: Object
        }
    },
    data: function () {
        return {
            filter: {
                created_at: "",
            },
            previousMonthEarnings: [],
        }
    },
    created() {
        this.getEarnings()
    },
    methods: {
        getEarnings() {
            this.request('get', this.url, {}, {
                onSuccess: (response) => {
                    this.previousMonthEarnings = response.data.monthEarningsFiltered.data
                }
            })
        }
    },
    computed: {
        url() {
            return `/api/get_month_earnings_filtered?filter[for_date]=${this.date.year}-${this.date.month}`
        }
    },
    watch: {
        date() {
            this.getEarnings()
            console.log('date', this.date)
        }
    }
}
</script>

<style scoped>
.earningsTitleStyle {
    background-color: #3F526B;
    height: 37px;
    line-height: 37px;
    font-size: 1.4em;
    border-radius: 6px;
    color: #fff;
}

.table-footer-header-color {
    background-color: #5A92BD;
    color: white;
}

.earningsTotalStyle {
    background-color: #3F526B;
    height: 2em;
    font-size: 1.2em;
    border-radius: 6px;
    color: #fff;
}

.earningsBackgroundColor {
    background-color: #5A92BD
}

tbody tr:nth-child(odd) {
    background-color: #73BAF0;
}

tbody tr:nth-child(even) {
    background-color: #BDDBF2;
}
</style>
