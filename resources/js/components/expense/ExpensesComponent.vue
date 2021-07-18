<template>
    <b-container class="text-center">
        <b-button variant="primary" @click="showNewExpensesModal = true"
            >Novo Gasto</b-button
        >
        <div v-for="(category, index) in categories"
            :key="category.id">
            <category-component v-model="categories[index]" @update="consoleLog"></category-component>
        </div>
        <!-- New Expense Modal -->
        <b-modal
            v-model="showNewExpensesModal"
            hide-footer
            title="Nova Despesa"
            centered
        >
            <div class="container">
                <b-input
                    v-model="form.name"
                    class="mt-2"
                    placeholder="Nome do gasto aqui!"
                ></b-input>
                <b-input
                    v-model="form.value"
                    class="mt-2"
                    placeholder="Valor do gasto!"
                ></b-input>

                <b-input-group class="mt-2">
                    <b-form-select
                        v-model="form.category_id"
                        :options="categoriesOptions"
                    >
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled
                                >-- Selecione uma Categoria --
                            </b-form-select-option>
                        </template>
                    </b-form-select>
                    <template v-slot:append>
                        <b-button
                            variant="outline-dark"
                            @click="showNewCategoryModal = true"
                        >
                            <i class="fas fa-plus"></i>
                        </b-button>
                    </template>
                </b-input-group>

                <div class="text-center mt-2">
                    <b-button
                        variant="danger mr-2"
                        @click="cancelExpenseCreation"
                        >Cancelar</b-button
                    >
                    <b-button variant="success" @click="submitNewExpense"
                        >Salvar</b-button
                    >
                </div>
            </div>
        </b-modal>

        <!-- New Category Modal -->
        <b-modal
            v-model="showNewCategoryModal"
            title="Nova Categoria"
            centered
            hide-footer
        >
            <create-category-component
                @save="categoryHasBeenSaved"
                @cancel="showNewCategoryModal = false"
            ></create-category-component>
        </b-modal>
    </b-container>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            form: {
                name: "",
                category_id: null,
            },
            categories: [],
            showNewExpensesModal: false,
            showNewCategoryModal: false,
            categoriesOptions: [],
            // form.category_id: null,
            // newCategory: false,
        };
    },
    created() {
        this.getCategories();
        this.getCategoriesOptions();
    },
    methods: {
       consoleLog(){
            this.getCategories();
            console.log('emitou')
       },
        submitExpense() {
            let url = `/api/expenses`;
            this.request("post", url, this.form, {
                onSuccess: (response) => {
                    this.form = {};
                    this.form.category_id = null;
                    this.expenseModal = false;
                    this.getCategories();
                },
            });
        },
        submitNewExpense() {
            this.form.category_id = this.form.category_id;

            let url = `/api/expenses`;
            this.request("post", url, this.form, {
                onSuccess: (response) => {
                    // console.log(response);
                    this.form = {};
                    this.form.category_id = null;
                    this.showNewExpensesModal = false;
                    this.getCategories();
                },
            });
        },
        getCategoriesOptions() {
            let url = "/api/get_categories";
            this.request(
                "get",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.categoriesOptions = response.data.categories;
                    },
                }
            );
        },
        getCategories() {
            let url = "/api/categories";
            this.request("get", url, null, {
                onSuccess: (response) => {
                    console.log('pegou as categorias', response)
                    this.categories = response.data.categories.data;
                    console.log('pegou as categorias', this.categories)
                },
            });
        },
        categoryHasBeenSaved(event) {
            console.log(event);
            this.getCategoriesOptions();
            this.showNewCategoryModal = false;
            this.form.category_id = event;
        },
        cancelExpenseCreation() {
            // this.expenseModal = false;
            this.showNewExpensesModal = false;
            this.form.category_id = null;
        },
    },
    // computed: {
    //     totalCategoryExpenses(){
    //         let total = this.categories
    //         return total
    //     }
    // },
    // watch: {
    //     totalCategoryExpenses(){
    //         console.log('aaaa')
    //     }
    // }
};
</script>

