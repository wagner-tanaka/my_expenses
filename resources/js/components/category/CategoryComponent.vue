<template>
    <div>
        <b-input-group class="mt-2">
            <b-form-select v-model="selected" :options="categoriesOptions">
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled
                        >-- Selecione uma Categoria --
                    </b-form-select-option
                    >
                </template>
            </b-form-select>
            <template v-slot:append>
                <b-button
                    variant="outline-dark"
                    @click="showModalNewCategory = true"
                >
                    <i class="fas fa-plus"></i>
                </b-button>
            </template>
        </b-input-group>
        <b-modal
            v-model="showModalNewCategory"
            title="Nova Categoria"
            centered
            hide-footer
        >
            <b-input
                v-model="form.name"
                class="mt-2"
                placeholder="Nome da Categoria aqui!"
            ></b-input>

            <div class="text-center mt-2">
                <b-button variant="danger mr-2">Cancelar</b-button>
                <b-button variant="success" @click="submit">Salvar</b-button>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            form: {},
            showModalNewCategory: false,
            categoriesOptions: [],
            selected: null,
        };
    },
    created() {
        this.getCategories();
    },
    methods: {
        submit() {
            this.request("post", `/api/categories`, this.form, {
                onSuccess: (response) => {
                    this.showModalNewCategory = false;
                    this.getCategories();
                    this.selected = response.data.data.id
                },
            });
        },
        getCategories() {
            this.request(
                "get",
                "/api/get_categories",
                {},
                {
                    onSuccess: (response) => {
                        this.categoriesOptions = response.data.data;
                    },
                }
            );
        },
    },
};
</script>