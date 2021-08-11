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
                    <td><i :class="[categoryIsOpen(category.id) ? 'fas fa-chevron-down' : 'fas fa-chevron-right']" ></i></td>
                    <td style="width: 33%">
                        {{ category.name }}
                    </td>
                    <td style="width: 33%">{{ category.totalCategoryExpenses }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="p-0 border-0">
                        <b-collapse @show="openCategoriesAdd(category.id)" @hide="openCategoriesRemove(category.id)" :id="category.id.toString()">
                            <daily-expenses-details
                                :value="category"
                            ></daily-expenses-details>
                        </b-collapse>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th>{{ categoriesExpensesTotal }}</th>
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
            openCategories: [],
            categories: [],
            categoriesExpensesTotal: ''
        };
    },
    created() {
        this.getCategoriesExpenses();
    },
    methods: {
        categoryIsOpen(id){
            return this.openCategories.includes(id) ;
        },
        openCategoriesAdd(id){
            if(!this.openCategories.includes(id)){
                this.openCategories.push(id)
            }
        },
        openCategoriesRemove(id){
            this.openCategories = this.openCategories.filter(category_id => category_id !== id)
        },
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
  background-color: #9a5c5c;
  color: white;
}
</style>
