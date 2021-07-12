<template>
    <b-container class="text-center">
        <b-button variant="primary" @click="showNewExpensesModal = true"
            >Novo Gasto</b-button
        >
        <b-card
            border-variant="primary"
            :header="capitalizeFirstLetter(category.name)"
            header-bg-variant="primary"
            header-text-variant="white"
            align="center"
            class="mt-2"
            v-for="category in categories"
            :key="category.id"
        >
            <b-modal
                v-model="showNewExpensesModal"
                title="Nova Despesa"
                centered
            >
                <div class="container">
                    <b-input
                        class="mt-2"
                        placeholder="Nome do gasto aqui!"
                    ></b-input>
                    <b-input
                        class="mt-2"
                        placeholder="Valor do gasto!"
                    ></b-input>
                    <category-component></category-component>
                </div>
            </b-modal>
        </b-card>
    </b-container>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            categories: [],
            showNewExpensesModal: false,
            // newCategory: false,
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
    },
};
</script>
