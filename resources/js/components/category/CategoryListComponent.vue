<template>
    <b-container class="text-center containerStyle">
        <div>
            <b-tabs content-class="mt-3">
                    <b-tab title="Home"  >
                    <b-button
                        variant="primary"
                        size="sm"
                        @click="showNewCategoryModal = true"
                    >
                        Nova Categoria
                    </b-button>
                    <div
                        v-for="(category, index) in categories"
                        :key="category.id"
                    >
                        <category-component
                            v-model="categories[index]"
                            @update="categoryHasBeenSaved"
                        ></category-component>
                    </div>
                    <b-modal
                        v-model="showNewCategoryModal"
                        title="Nova Categoria"
                        centered
                        hide-footer
                    >
                        <category-create-update-component
                            @save="categoryHasBeenSaved"
                            @cancel="showNewCategoryModal = false"
                        ></category-create-update-component>
                    </b-modal>
                </b-tab>
                <b-tab title="Detalhes">
                    <daily-expenses-table></daily-expenses-table>
                </b-tab>
                <b-tab title="Despesas do Mes" active>
                    <month-expenses-and-earnings></month-expenses-and-earnings>
                </b-tab>
            </b-tabs>
        </div>
    </b-container>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            categories: [],
            showNewCategoryModal: false,
        };
    },
    created() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            let url = "/api/categories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    this.categories = response.data.categories.data;
                    this.capitalizeCategoryNameFirstLetter();
                    this.orderCategoriesByName();
                },
            });
        },
            categoryHasBeenSaved() {
            this.getCategories();
            this.showNewCategoryModal = false;
        },
        orderCategoriesByName() {
            this.categories = _.orderBy(this.categories, ["name"]);
        },
        capitalizeCategoryNameFirstLetter() {
            this.categories.map((category) => {
                category.name = this.capitalizeFirstLetter(category.name);
                return category;
            });
        },
        // orderByDate(){
        //     this.categories = _.orderBy(this.categories, ['date'],['desc']);
        // }
    },
};
</script>

