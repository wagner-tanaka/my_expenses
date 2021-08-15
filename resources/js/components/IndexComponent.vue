<template>
    <b-container class="text-center containerStyle" >
        <div>
            <b-tabs content-class="mt-3" >
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
                        <daily-expenses-category
                            v-model="categories[index]"
                            @update="categoryHasBeenSaved"
                        ></daily-expenses-category>
                    </div>
                    <b-modal
                        v-model="showNewCategoryModal"
                        title="Nova Categoria"
                        centered
                        hide-footer
                    >
                        <daily-expenses-category-create-update
                            @save="categoryHasBeenSaved"
                            @cancel="showNewCategoryModal = false"
                        ></daily-expenses-category-create-update>
                    </b-modal>
                </b-tab>
                <b-tab title="Despesas do Mes" >
                    <month-expenses-and-earnings></month-expenses-and-earnings>
                </b-tab>
                <b-tab title="Meses Anteriores" active>
                    <previous-months-index></previous-months-index>
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
<style>
.backgroundImage {
    background-image: url("https://data.1freewallpapers.com/detail/gradient-blur-color-background-green.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
}
</style>
