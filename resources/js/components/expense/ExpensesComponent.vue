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
            <template v-slot:header>
                <b-button
                    @click="deleteCategory(category)"
                    variant="danger"
                    size="sm"
                    class="float-right ml-2 btn-xs"
                    ><i class="fas fa-times fa-sm"></i
                ></b-button>
                <b-button variant="warning" size="sm" class="float-right btn-xs"
                    ><i class="fas fa-pen fa-sm"></i
                ></b-button>
                <div style="color: white" class="text-center">
                    <strong>{{ category.name }}</strong>
                </div>
            </template>
            <b-card-text>
                <div>
                    <b-row>
                        <b-col
                            cols="6"
                            v-for="(expense, index) in category.groupedExpenses"
                            :key="index"
                            class="p-0 px-1"
                        >
                            <b-button
                                variant="warning"
                                class="mb-2 w-100"
                                @click="
                                    (expenseModal = true),
                                        (form.name = expense.name),
                                        (form.category_id = category.id)
                                "
                            >
                                {{ expense.name }} <br> 
                                {{ expense.value }}
                            </b-button>
                        </b-col>
                    </b-row>
                </div>
            </b-card-text>
            <div
                v-b-toggle="category.id.toString()"
                class="text-right mr-3 mt-2"
                style="cursor: pointer; color: black"
            >
                Ver detalhes
            </div>
            <b-collapse :id="category.id.toString()">
                <expenses-list :value="category" @update="getCategories"></expenses-list>
            </b-collapse>
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
            expenseModal: false,
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
        deleteCategory(category) {
            if (
                !confirm(
                    "Se voce excluir a categoria, ira excluir todos os gastos desta categoria tambem. \n Quer mesmo excluir?"
                )
            ) {
                return;
            }
            let categoryIndex = this.categories.indexOf(category);
            let url = `/api/categories/${category.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.categories.splice(categoryIndex, 1);
                        console.log(categoryIndex);
                    },
                }
            );
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
                    this.categories = response.data.categories.data;
                    console.log(this.categories);
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
            this.expenseModal = false;
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

<style scoped>
.btn-xs {
    padding: 0.25rem 0.4rem;
    font-size: 0.875rem;
    line-height: 0.5;
    border-radius: 0.2rem;
}
</style>