<template>
    <div>
        <b-input
            v-model="form.name"
            class="mt-2"
            placeholder="Nome da Categoria aqui!"
        ></b-input>

        <div class="text-center mt-2">
            <b-button variant="danger mr-2" @click="$emit('save', 'closeModal')">Cancelar</b-button>
            <b-button variant="success" @click="submitCategory">Salvar</b-button>
        </div>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            form: {},
        };
    },
    created() {},
    methods: {
        submitCategory() {
            this.request("post", `/api/categories`, this.form, {
                onSuccess: (response) => {
                    this.$emit('save', response.data.category.id)
                },
            });
        },
    },
};
</script>


 