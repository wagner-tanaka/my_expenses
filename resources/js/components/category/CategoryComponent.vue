<template>
    <div>
        <b-card
            border-variant="primary"
            :header="capitalizeFirstLetter(category.name)"
            header-bg-variant="primary"
            header-text-variant="white"
            align="center"
            class="mt-2"
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
                                {{ expense.name }} <br />
                                {{ expense.value }}
                            </b-button>
                        </b-col>
                    </b-row>
                </div>
            </b-card-text>
            <div
                v-b-toggle="category.id.toString()"
                @click="collapse = !collapse"
                class="text-right mr-3 mt-2"
                style="cursor: pointer; color: black"
            >
                {{ showDetails }}
            </div>
            <b-collapse :id="category.id.toString()">
                <expenses-list
                    :value="category"
                    @update="$emit('update')"
                ></expenses-list>
            </b-collapse>
        </b-card>
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
    </div>
</template>

<script>
export default {
    model: {
        prop: "category",
    },
    props: {
        category: {
            required: true,
        },
    },
    data: function () {
        return {
            form: {
                name: "",
                category_id: null,
            },
            // category: this.value,
            expenseModal: false,
            collapse: false,
        };
    },
    mounted() {
        // this.$emit('input', {oi:'ola'})
        // this.category = 'ola'
        //
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
            // let categoryIndex = this.categories.indexOf(category);
            let url = `/api/categories/${category.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.$emit("update");
                        // this.categories.splice(categoryIndex, 1);
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
                    this.$emit("update");
                    // this.getCategories();
                },
            });
        },
        cancelExpenseCreation() {
            this.expenseModal = false;
            this.form.category_id = null;
        },
    },
    computed: {
        showDetails() {
            if (this.collapse) {
                // this.collapse = false
                return "Ocultar detalhes";
            }
            return "Ver detalhes";
        },
    },
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