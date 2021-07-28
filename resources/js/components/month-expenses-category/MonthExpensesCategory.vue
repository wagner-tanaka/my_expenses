<template>
    <b-container>
        {{expenseMonthCategory.name}}
    </b-container>
</template>

<script>
export default {
    props:{
        value:{
            required: true,
            type: Array
        }
    },
    data: function () {
        return {
            expenseMonthCategory: this.value
        }
    },
    created() {
    },
    methods: {

    },
}
</script>
