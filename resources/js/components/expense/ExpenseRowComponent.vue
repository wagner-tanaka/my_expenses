<template>
    <tr>
        <td>{{ expense.date }}</td>
        <td @click="isEditingName = true" v-if="!isEditingName">{{ expense.name }}</td>
        <td v-if="isEditingName">
            <b-row>
                <b-col cols="9" class="text-right pr-0">
                    <b-input type="text" v-model="expense.name" size="sm"></b-input>
                </b-col>
                <b-col cols="3" class="text-left pl-1">
                    <b-button variant="success" size="sm" @click="updateExpenseName"><i class="fas fa-check"></i></b-button>
                </b-col>
            </b-row>
        </td>
        <td @click="isEditingValue = true" v-if="!isEditingValue">{{ expense.value }}</td>
        <td v-if="isEditingValue">
            <b-row>
                <b-col cols="9" class="text-right pr-0">
                    <b-input type="number" v-model="expense.value" size="sm"></b-input>
                </b-col>
                <b-col cols="3" class="text-left pl-1">
                    <b-button variant="success" size="sm" @click="updateExpenseValue"><i class="fas fa-check"></i></b-button>
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
        categoryId:{
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
            url: `api/expenses/${this.expense.id}`
        };
    },
    created() {
        console.log(this.expense);
    },
    methods: {
        
        updateExpenseName(){
            let form = {
                category_id: this.categoryId,
                name: this.expense.name,
                value: this.expense.value
            }
            this.request('put', this.url, form,{
                onSuccess: (response) => {
                    console.log(response)
                }
            })
            this.isEditingName = false
        },
        updateExpenseValue(){
            let form = {
                category_id: this.categoryId,
                name: this.expense.name,
                value: this.expense.value
            }
            this.request('put', this.url, form,{
                onSuccess: (response) => {
                    console.log(response)
                }
            })
            this.isEditingValue = false
        },
        deleteExpense() {
            // let expenseIndex = this.expenses.indexOf(expense);
            let url = `/api/expenses/${this.expense.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: (response) => {
                        // this.expenses.splice(expenseIndex, 1);
                        this.$emit("delete");
                    },
                }
            );
        },
    },
};
</script>