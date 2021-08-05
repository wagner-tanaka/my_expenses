<template>
    <tr>
        <td @click="isEditingPayDay = true" v-if="!isEditingPayDay" style="width: 10%">{{ form.pay_day }}</td>
        <td v-if="isEditingPayDay">
            <b-row>
                <b-col cols="9" class="text-right pr-0">
                    <b-input type="text" v-model="form.pay_day" size="sm"></b-input>
                </b-col>
                <b-col cols="3" class="text-left pl-1">
                    <b-button variant="success" size="sm" @click="updateExpensePayDay"><i class="fas fa-check"></i>
                    </b-button>
                </b-col>
            </b-row>
        </td>
        <td @click="isEditingName = true" v-if="!isEditingName" style="width: 40%">{{ form.name }}</td>
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
        <td @click="isEditingValue = true" v-if="!isEditingValue" style="width: 40%">{{ form.value }}</td>
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
        <td class="text-right" style="width: 10%">
            <b-button
                size="sm"
                variant="outline-secondary"
                style="cursor: pointer; color: black"
                @click="deleteMonthExpense()"
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
        monthExpense: {
            type: Object,
            required: true,
        },
    },
    data: function () {
        return {
            isEditingPayDay: false,
            isEditingName: false,
            isEditingValue: false,
            url: `/api/monthExpenses/${this.monthExpense.id}`,
            form: {
                month_expenses_category_id: this.categoryId,
                name: this.monthExpense.name,
                value: this.monthExpense.value,
                pay_day: this.monthExpense.pay_day
            }
        };
    },
    created() {
    },
    methods: {
        updateExpensePayDay() {
            this.request('put', this.url, this.form, {resetForm: false})
            this.isEditingPayDay = false
        },
        updateExpenseName() {
            console.log('form', this.form)
            this.request('put', this.url, this.form,{resetForm: false})
            this.isEditingName = false
        },
        updateExpenseValue() {
            this.request('put', this.url, this.form, {resetForm: false})
            this.isEditingValue = false
        },
        deleteMonthExpense() {
            if (!confirm('Despesa sera removida.')) return
            // let expenseIndex = this.expenses.indexOf(monthExpense);
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
