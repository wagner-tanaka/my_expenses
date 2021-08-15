<template>
    <tr>
        <td>{{ previousMonthExpense.name }}</td>
        <td>{{ previousMonthExpense.value }}</td>
    </tr>
</template>

<script>
export default {
    props: {
        previousMonthExpense: {
            type: Object,
            required: true
        }
    },
    data: function () {
        return {}
    },
    created() {

    },
    methods: {},
    computed: {},
    watch: {}
}
</script>

<style scoped>

</style>


