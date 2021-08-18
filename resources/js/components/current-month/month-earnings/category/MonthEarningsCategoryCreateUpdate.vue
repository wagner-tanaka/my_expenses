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
            type: Object,
            default: () => ({})
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
            let url = this.value.id ? `/api/monthEarningsCategories/${this.value.id}` : `/api/monthEarningsCategories`
            let method = this.value.id ? 'put' : 'post'
            this.request(method, url, this.form, {
                onSuccess: (response) => {
                    this.$emit('input', response.data.monthEarningsCategory)
                    this.$emit('update')
                    this.$emit('save', response.data.monthEarningsCategory.id)
                },
            });
        },
    },
};
</script>

