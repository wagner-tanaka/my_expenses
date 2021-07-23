<template>
    <table class="table table-sm">
        <thead class="table-info">
            <tr>
                <th>Despesa</th>
                <th>Valor</th>
                <th></th>
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
                <td></td>
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