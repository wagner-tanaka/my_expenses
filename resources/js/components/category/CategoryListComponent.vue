<template>
    <b-container class="text-center">
        <div>
            <b-tabs content-class="mt-3">
                <b-tab title="Home" active>
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
                <b-tab title="Detalhes do Mes"> 
                    <details-component></details-component>

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
                },
            });
        },
        categoryHasBeenSaved() {
            this.getCategories();
            this.showNewCategoryModal = false;
        },
    },
};
</script>