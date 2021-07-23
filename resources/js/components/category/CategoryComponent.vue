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
                    class="float-left btn-xs"
                    ><i class="fas fa-times fa-sm"></i
                ></b-button>
                <b-button
                    variant="success"
                    @click="showNewExpensesModal = true"
                    size="sm"
                    class="float-right"
                    >Novo Gasto</b-button
                >
                <a
                    style="color: white"
                    class="text-center"
                    @click="showEditCategoryNameModal = true"
                >
                    <strong>{{ category.name }}</strong>
                </a>
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
                            <expense-add-value-component
                                v-model="category.groupedExpenses[index]"
                                :category="category"
                                @update="$emit('update')"
                            ></expense-add-value-component>
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
                    :category="category"
                    @update="$emit('update')"
                ></expenses-list>
            </b-collapse>
        </b-card>

        <!-- New Expense Modal -->
        <b-modal
            v-model="showNewExpensesModal"
            hide-footer
            title="Nova Despesa"
            centered
        >
            <expense-new-component
                :category="category"
                @update="$emit('update'), (showNewExpensesModal = false)"
            ></expense-new-component>
        </b-modal>

        <!-- Edit Category name Modal -->
        <b-modal
            v-model="showEditCategoryNameModal"
            title="Editar Categoria"
            centered
            hide-footer
        >
            <category-create-update-component
                v-model="category"
                @save="categoryHasBeenUpdated"
                @cancel="showNewCategoryModal = false"
            ></category-create-update-component>
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
            type: Object
        },
    },
    data: function () {
        return {
            showNewExpensesModal: false,
            collapse: false,
            showEditCategoryNameModal: false,
        };
    },
    mounted() {},
    methods: {
        categoryHasBeenUpdated(event) {
            this.$emit('update')
            this.showEditCategoryNameModal = false;
        },
        editCategoryName() {
            this.$emit("update", { categoryId: this.category.id });
            // let url = `/api/categories/${category.id}`;
        },
        deleteCategory(category) {
            if (
                !confirm(
                    "Se voce excluir a categoria, ira excluir todos os gastos desta categoria tambem. \n Quer mesmo excluir?"
                )
            ) {
                return;
            }
            let url = `/api/categories/${category.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: (response) => {
                        this.$emit("update");
                    },
                }
            );
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