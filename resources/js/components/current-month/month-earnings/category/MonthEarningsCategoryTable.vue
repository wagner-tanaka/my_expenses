<template>
    <b-container>
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-footer-header-color">
            <tr>
                <th>
                    <b-button
                        @click="deleteCategory"
                        variant="secondary"
                        size="sm"
                        class="float-left btn-xs"
                    ><i class="fas fa-trash-alt fa-sm"></i
                    ></b-button>
                </th>
                <th colspan="2">
                    <a
                        class="text-center text-white"
                        @click="showEditMonthEarningsCategoryNameModal = true"
                    >
                        <strong>{{ monthEarningsCategory.name }}</strong>
                    </a>
                </th>
                <th>
                    <b-button
                        class="float-right"
                        size="sm"
                        variant="danger"
                        @click="showCreateMonthEarningModal = !showCreateMonthEarningModal"
                    ><i class="fas fa-plus"></i>
                    </b-button>
                </th>
            </tr>
            </thead>
            <tbody >
            <month-earnings-category-table-row
                v-for="(monthEarning, index) in monthEarnings" :key="JSON.stringify(monthEarning)"
                :category-id="monthEarningsCategory.id"
                :monthEarning="monthEarnings[index]"
                @delete="$emit('update')"
            ></month-earnings-category-table-row>
            </tbody>
            <tfoot class="table-footer-header-color">
            <tr>
                <th>Total</th>
                <th></th>
                <th>{{ monthEarningsCategory.monthEarningsCategoryTotal }}</th>
                <th></th>
            </tr>
            </tfoot>
        </table>

        <!--        Month Earnings Create Modal -->
        <b-modal
            v-model="showCreateMonthEarningModal"
            title="Adicionar conta do Mes"
            centered
            hide-footer
        >
            <month-earning-create
                :monthEarningsCategory="monthEarningsCategory"
                @save="monthEarningHasBeenSaved"
            ></month-earning-create>
        </b-modal>

        <!-- Edit Category name Modal -->
        <b-modal
            v-model="showEditMonthEarningsCategoryNameModal"
            title="Editar Categoria"
            centered
            hide-footer
        >
            <month-earnings-category-create-update
                v-model="monthEarningsCategory"
                @update="monthEarningsCategoryHasBeenUpdated"
                @cancel="showEditMonthEarningsCategoryNameModal = false"
            ></month-earnings-category-create-update>
        </b-modal>
    </b-container>
</template>

<script>
export default {
    model: {
            prop: "monthEarningsCategory",
    },
    props: {
        monthEarningsCategory: {
            required: true,
            type: Object
        },
    },
    data: function () {
        return {
            monthEarnings: this.monthEarningsCategory.monthEarnings.data,
            showCreateMonthEarningModal: false,
            showEditMonthEarningsCategoryNameModal: false

        }
    },
    mounted() {
    },
    methods: {
        monthEarningsCategoryHasBeenUpdated() {
            this.showEditMonthEarningsCategoryNameModal = false
        },
        monthEarningHasBeenSaved() {
            this.showCreateMonthEarningModal = false;
            this.$emit('update')
        },
        deleteCategory() {
            if (
                !confirm(
                    "Se voce excluir a categoria, ira excluir todos os ganhos desta categoria tambem. \n Quer mesmo excluir?"
                )
            ) {
                return;
            }
            let url = `/api/monthEarningsCategories/${this.monthEarningsCategory.id}`;

            this.request(
                "delete",
                url,
                {},
                {
                    onSuccess: () => {
                        this.$emit("update");
                    },
                }
            );
        },
    },
    watch: {
        monthEarningsCategory() {
            this.monthEarnings = this.monthEarningsCategory.monthEarnings.data
        },
    }
}
</script>
<style scoped>
.table-footer-header-color{
    background-color: #004C70;
    color: white;
}
table {
    border-collapse: collapse;
    width: 100%;
}
tbody tr:nth-child(odd){
    background-color: #73BAF0;
}
tbody tr:nth-child(even){
background-color: #BDDBF2;
}
</style>
