<template>
        <tr>
            <td v-b-toggle="value.id.toString()">{{ value.name }}</td>
            <td>{{ value.totalCategoryExpenses }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <b-collapse :id="value.id.toString()">
                    <b-card>
                        <span
                            v-for="(expense, index) in value.groupedExpenses"
                            :key="index"
                        >
                            <strong>{{ expense.name }}</strong> -
                            {{ expense.value }}
                            <br />
                        </span>
                    </b-card>
                </b-collapse>
            </td>
        </tr>
</template>
<script>
export default {
    props: {
        value: {
            required: true,
        },
    },
    data: function () {
        return {};
    },
};
</script>