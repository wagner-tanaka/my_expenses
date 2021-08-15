<template>
    <tr>
        <td>{{ previousMonthEarning.name }}</td>
        <td>{{ previousMonthEarning.value }}</td>
    </tr>
</template>

<script>
export default {
    props: {
        previousMonthEarning: {
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


