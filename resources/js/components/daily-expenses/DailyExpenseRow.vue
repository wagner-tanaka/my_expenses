<template>
    <tr>
        <td>{{ expense.date }}</td>
        <td @click="isEditingName = true" v-if="!isEditingName">{{ form.name }}</td>
        <td v-if="isEditingName">
            <b-row>
                <b-col cols="9" class="text-right pr-0">
                    <b-input type="text" v-model="form.name" size="sm"></b-input>
                </b-col>
                <b-col cols="3" class="text-left pl-1">
                    <b-button variant="success" size="sm" @click="updateExpenseName"><i class="fas fa-check"></i>
                    </b-button>
                </b-col>
            </b-row>
        </td>
        <td @click="isEditingValue = true" v-if="!isEditingValue">{{ form.value }}</td>
        <td v-if="isEditingValue">
            <b-row>
                <b-col cols="9" class="text-right pr-0">
                    <b-input type="number" v-model="form.value" size="sm"></b-input>
                </b-col>
                <b-col cols="3" class="text-left pl-1">
                    <b-button variant="success" size="sm" @click="updateExpenseValue"><i class="fas fa-check"></i>
                    </b-button>
                </b-col>
            </b-row>
        </td>
        <td>
            <b-button
                size="sm"
                variant="outline-secondary"
                style="cursor: pointer; color: black"
                @click="deleteExpense()"
            >
                <i class="fa fa-trash-alt" aria-hidden="true"> </i>
            </b-button>
        </td>
    </tr>
</template>

<script>
export default {
    props: {
        categoryId: {
            required: true
        },
        expense: {
            type: Object,
            required: true,
        },
    },
    data: function () {
        return {

            isEditingName: false,
            isEditingValue: false,
            url: `api/expenses/${this.expense.id}`,
            form: {
                category_id: this.categoryId,
                name: this.expense.name,
                value: this.expense.value
            }
        };
    },
    created() {
    },
    methods: {

        updateExpenseName() {
            this.request('put', this.url, this.form, {resetForm: false})
            this.isEditingName = false
        },
        updateExpenseValue() {
            this.request('put', this.url, this.form, {resetForm: false})
            this.isEditingValue = false
        },
        deleteExpense() {
            // let expenseIndex = this.expenses.indexOf(daily-expenses);

            this.request(
                "delete",
                this.url,
                {},
                {
                    onSuccess: () => {
                        // this.expenses.splice(expenseIndex, 1);
                        this.$emit("delete");
                    },
                }
            );
        },
    },
};
</script>
