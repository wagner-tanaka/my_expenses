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
        <!-- <span>
                                    <strong>{{ expense.name }}</strong> -
                                    {{ expense.value }}
                                    <br />
                                </span> -->
    </table>
</template>

<script>
export default {
    props: {
        value: {
            required: true
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