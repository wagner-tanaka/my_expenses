<template>
    <div>
        <b-input
            v-model="form.name"
            class="mt-2"
            placeholder="Nome da Categoria aqui!"
        ></b-input>

        <div class="text-center mt-2">
            <b-button variant="danger mr-2" @click="$emit('cancel')">Cancelar</b-button>
            <b-button variant="success" @click="submitCategory">Salvar</b-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            default: null
        }
    },
    data: function () {
        return {
            form: {
                name: this.value ? this.value.name : ''
            },
        };
    },
    created() {
    },
    methods: {
        submitCategory() {
            let url = this.value ? `/api/categories/${this.value.id}` : `/api/categories`
            let method = this.value ? 'put' : 'post'
            this.request(method, url, this.form, {
                onSuccess: (response) => {
                    this.$emit('save', response.data.category.id)
                },
            });
        },
    },
};
</script>

