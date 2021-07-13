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
            <div
                v-for="(expense, index) in category.expenses"
                :key="index"
                @click="
                    (expenseModal = true),
                        (form.name = expense),
                        (form.category_id = category.id)
                "
            >
                <b-button variant="warning" class="mb-2">
                    {{ expense }}
                </b-button>
                <!-- New Expense Modal -->
            </div>
        </b-card>

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
                        v-model="selected"
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

        <!-- Expense Modal -->
        <b-modal v-model="expenseModal" hide-footer title="Despesa" centered>
            <div class="container">
                <b-input
                    v-model="form.value"
                    class="mt-2"
                    placeholder="Valor do gasto!"
                ></b-input>

                <div class="text-center mt-2">
                    <b-button
                        variant="danger mr-2"
                        @click="cancelExpenseCreation"
                        >Cancelar</b-button
                    >
                    <b-button variant="success" @click="submitExpense"
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
            <!-- TODO: o componente abaixo seria só pra salvar a categoria nova e emitir o id dela pra ca-->
            <!-- TODO: exemplo, @save=this.form.category_id = $event" -->

            <category-component
                @save="categoryHasBeenSaved"
            ></category-component>
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
                category_id: "",
            },
            categories: [],
            expenseModal: false,
            showNewExpensesModal: false,
            showNewCategoryModal: false,
            categoriesOptions: [],
            selected: null,
            // newCategory: false,
        };
    },
    created() {
        this.getCategories();
        this.getCategoriesOptions();
    },
    methods: {
        submitExpense() {
            let url = `/api/expenses`;
            this.request("post", url, this.form, {
                onSuccess: (response) => {
                    this.form = {};
                    this.selected = null;
                    this.expenseModal = false;
                    this.getCategories();
                },
            });
        },
        submitNewExpense() {
            this.form.category_id = this.selected;

            let url = `/api/expenses`;
            this.request("post", url, this.form, {
                onSuccess: (response) => {
                    // console.log(response);
                    this.form = {};
                    this.selected = null;
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
                    this.categories = response.data.categories.data;
                    // console.log(response.data.categories.data);
                },
            });
        },
        categoryHasBeenSaved(event) {
            if (event == "closeModal") {
                this.showNewCategoryModal = false;
                return;
            }
            console.log(event);
            this.getCategoriesOptions();
            this.showNewCategoryModal = false;
            this.selected = event;
        },
        cancelExpenseCreation() {
            this.expenseModal = false;
            this.showNewExpensesModal = false;
            this.selected = null;
        },
    },
};
</script>
