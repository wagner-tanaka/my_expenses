<template>
    <div>
        <b-input
            type="text"
            v-model="form.name"
            class="mt-2"
            placeholder="Nome do ganho aqui!"
        ></b-input>
        <b-input
            type="number"
            v-model="form.value"
            class="mt-2"
            placeholder="Valor da ganho!"
        ></b-input>

        <div class="text-center mt-2">
            <b-button variant="danger mr-2" @click="cancelEarningCreation"
                >Cancelar</b-button
            >
            <b-button variant="success" @click="submitEarning">Salvar</b-button>
        </div>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            form: {
                name: "",
                value: "",
            },
        };
    },
    mounted() {
        //
    },
    methods: {
        submitEarning() {
            let url = `/api/monthEarnings`;
            this.request("post", url, this.form, {
                onSuccess: () => {
                    this.form = {};
                    this.$emit("save");
                },
            });
        },
        cancelEarningCreation() {
            this.$emit("save");
        },
    },
};
</script>
