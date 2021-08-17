<template>
    <b-container>
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-footer-header-color">
            <tr>
                <th colspan="3" class="text-center text-white"><strong> Despesas Diárias </strong></th>
            </tr>
            </thead>
            <tbody v-for="(category, index) in categories" :key="index">
            <tr v-b-toggle="category.id.toString()">
                <td><i :class="[categoryIsOpen(category.id) ? 'fas fa-chevron-down' : 'fas fa-chevron-right']"></i></td>
                <td style="width: 33%">
                    {{ category.name }}
                </td>
                <td style="width: 33%">{{ category.totalCategoryExpenses }}</td>
            </tr>
            <tr>
                <td colspan="3" class="p-0 border-0">
                    <b-collapse @show="openCategoriesAdd(category.id)" @hide="openCategoriesRemove(category.id)"
                                :id="category.id.toString()">
                        <daily-expenses-details
                            :value="category"
                        ></daily-expenses-details>
                    </b-collapse>
                </td>
            </tr>
            </tbody>
            <tfoot class="table-footer-header-color">
            <tr>
                <th>Total</th>
                <th></th>
                <th>{{ dailyExpensesTotal }}</th>
            </tr>
            </tfoot>
        </table>
    </b-container>
</template>
<script>
export default {
    props: {
        date: {
            type: Object,
            required: false
        }
    },
    data: function () {
        return {
            openCategories: [],
            categories: [],
            categoriesExpensesTotal: '',
            dailyExpensesTotal: ''
        };
    },
    created() {
        this.getCategoriesExpenses();
    },
    methods: {
        categoryIsOpen(id) {
            return this.openCategories.includes(id);
        },
        openCategoriesAdd(id) {
            if (!this.openCategories.includes(id)) {
                this.openCategories.push(id)
            }
        },
        openCategoriesRemove(id) {
            this.openCategories = this.openCategories.filter(category_id => category_id !== id)
        },
        getCategoriesExpenses() {

            let url = this.date ? `/api/get_categories_filtered?filter[for_date]=${this.date.year}-${this.date.month}` : "/api/categories";
            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        if (response.data.categories) {
                            this.categories = response.data.categories.data;
                            this.sumDailyExpensesTotal();
                        }
                    },
                }
            );
        },
        sumDailyExpensesTotal() {
            this.dailyExpensesTotal = this.categories.reduce((accumulator, value) => {
                return accumulator + parseInt(value.totalCategoryExpenses)
            }, 0)
        }
    },
    computed: {},
    watch: {
        date() {
            this.getCategoriesExpenses()
        },
        dailyExpensesTotal() {
            this.$emit('dailyExpensesTotal', this.dailyExpensesTotal)
        }
    }

};
</script>

<style scoped>
.table-footer-header-color {
    background-color: #9a5c5c;
    color: white;
}

tbody:nth-child(odd) {
    background-color: #D9B6A3;
}

tbody:nth-child(even) {
    background-color: #FFE6D9;
}
</style>
