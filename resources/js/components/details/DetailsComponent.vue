<template>
    <b-container>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Categoria</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody v-for="(category, index) in categories" :key="index">
                <tr>
                    <td v-b-toggle="category.id.toString()">
                        {{ category.name }}
                    </td>
                    <td>{{ category.totalCategoryExpenses }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="p-0 border-0">
                        <b-collapse :id="category.id.toString()">
                            <details-expense-component :value="category"></details-expense-component>
                        </b-collapse>
                    </td>
                </tr>
            </tbody>
        </table>
    </b-container>
</template>
<script>
export default {
    props: {},
    data: function () {
        return {
            categories: [],
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
                    },
                }
            );
        },
    },
};
</script>