<template>
    <div>
        <b-table 
            small 
            striped="striped"
            head-variant="light" 
            hover 
            :fields="fields" 
            :items="expenses">
            <template #cell(adicionar_parcela)="">
                <b-button size="sm" variant="outline-secondary" style="cursor: pointer; color: black">
                    <i class="fa fa-trash-alt" aria-hidden="true">
                    </i>
                </b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            required: true,
            type: Array
        }
    },
    data: function () {
        return {
            fields: [
                { key: 'data', sortable: true },
          { key:'name', label: 'Despesa',  sortable: true},
          { key:'value', label: 'Valor', sortable: true},
          { key: 'adicionar_parcela', label: '' },
        ],
        expenses: this.value
        };
    },
    mounted() {
        // this.getExpenses()
    },
    methods: {
        // getExpenses(){
        //     let url = `/api/get_expenses/${this.categoryId}`
        //     this.request('get',url,{},{
        //         onSuccess: (response) => {
        //             this.expenses = response.data.expenses.data 
        //         }
        //     })
        // }
    },
    watch: {
        value() {
            this.expenses = this.value
        },
    }
};
</script>