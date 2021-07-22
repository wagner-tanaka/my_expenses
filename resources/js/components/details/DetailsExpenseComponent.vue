<template>
    <table class="table table-sm text-center">
        <thead class="table-info">
            <tr >
                <th>Despesa</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr
                class="table-primary"
                v-for="(expense, index) in value.groupedExpenses"
                :key="index"
            >
                <td>{{ expense.name }}</td>
                <td>{{ expense.value }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        value: {
            required: true,
            type: Object
        }
    },
    data: function () {
        return {
            //
        };
    },
    mounted() {
        //
    },
    methods: {
        //
    },
};
</script>