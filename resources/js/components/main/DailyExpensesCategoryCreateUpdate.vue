<template>
    <div>
        <b-input
            v-model="form.name"
            class="mt-2"
            :placeholder="__('global.category_name')"
        ></b-input>

        <div class="text-center mt-2">
            <b-button variant="danger mr-2" @click="$emit('cancel')">{{ __('global.cancel') }}</b-button>
            <b-button variant="success" @click="submitCategory">{{ __('global.save') }}</b-button>
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
            let url = this.value.id ? `/api/categories/${this.value.id}` : `/api/categories`
            let method = this.value.id ? 'put' : 'post'
            this.request(method, url, this.form, {
                onSuccess: (response) => {
                    this.$emit('save', response.data.category.id)
                },
            });
        },
    },
};
</script>

