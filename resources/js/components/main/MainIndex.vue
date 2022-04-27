<template>
    <div>
        <b-button
            class="mt-2"
            variant="primary"
            size="sm"
            @click="showNewCategoryModal = true"
        >
          {{ __('global.add_category') }}
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
            :title="__('global.add_category')"
            centered
            hide-footer
        >
            <daily-expenses-category-create-update
                @save="categoryHasBeenSaved"
                @cancel="showNewCategoryModal = false"
            ></daily-expenses-category-create-update>
        </b-modal>
    </div>
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
    },
};
</script>

<style scoped>

</style>
