<template>
    <b-container>
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-footer-header-color">
                <tr>
                    <th colspan="4">Despesas Diarias</th>
                </tr>
            </thead>
            <tbody v-for="(category, index) in categories" :key="index">
                <tr >
                    <td style="width: 10%"></td>
                    <td v-b-toggle="category.id.toString()" style="width: 40%">
                        {{ category.name }}
                    </td>
                    <td style="width: 40%">{{ category.totalCategoryExpenses }}</td>
                    <td style="width: 10%">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="p-0 border-0">
                        <b-collapse :id="category.id.toString()">
                            <table-expenses-grouped
                                :value="category"
                            ></table-expenses-grouped>
                        </b-collapse>
                    </td>
                </tr>
            </tbody>
            <tfoot class="table-footer-header-color">
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th class="text-center">{{ categoriesExpensesTotal }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </b-container>
</template>
<script>
export default {
    props: {},
    data: function () {
        return {
            categories: [],
            categoriesExpensesTotal: ''
        };
    },
    created() {
        this.getCategoriesExpenses();
    },
    methods: {
        getCategoriesExpenses() {
            let url = "/api/categories";
            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.categories = response.data.categories.data;
                        this.categoriesExpensesTotal = response.data.categoriesAmountTotal
                    },
                }
            );
        },
    },

};
</script>
<style scoped>
.table-footer-header-color{
    background-color: #EF5151;
    color: white;
}
</style>
