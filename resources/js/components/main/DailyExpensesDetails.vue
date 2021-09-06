<template>
    <table class="table table-sm">
        <thead class="table-primary">
            <tr>
                <th>Despesa</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr
                class="table-info"
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
