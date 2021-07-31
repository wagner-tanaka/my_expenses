<template>
    <div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th colspan="3">Despesas Diárias</th>
                </tr>
            </thead>
            <tbody v-for="(category, index) in categories" :key="index">
                <tr >
                    <td v-b-toggle="category.id.toString()" style="width: 33%">
                        {{ category.name }}
                    </td>
                    <td style="width: 33%">{{ category.totalCategoryExpenses }}</td>
                    <td style="width: 33%">
                        <b-button disabled variant="warning" size="sm"
                            ><i class="fas fa-pen"></i
                        ></b-button>
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
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ categoriesExpensesTotal }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
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
