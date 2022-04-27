<template>
  <div>
    <b-card
      border-variant="primary"
      :header="capitalizeFirstLetter(category.name)"
      header-bg-variant="primary"
      header-text-variant="white"
      align="center"
      class="mt-2"
    >
      <template v-slot:header>
        <b-button
          @click="deleteCategory(category)"
          variant="danger"
          size="sm"
          class="float-left btn-xs"
        ><i class="fas fa-times fa-sm"></i
        ></b-button>
        <b-button
          variant="success"
          @click="showNewExpensesModal = true"
          size="sm"
          class="float-right"
        >{{ __('global.new_expense') }}</b-button
        >
        <a
          style="color: white"
          class="text-center"
          @click="showEditCategoryNameModal = true"
        >
          <strong>{{ category.name }}</strong>
        </a>
      </template>
      <b-card-text>
        <div>
          <b-row>
            <b-col
              cols="6"
              v-for="(expense, index) in category.groupedExpenses"
              :key="index"
              class="p-0 px-1"
            >
              <daily-expense-add-value
                v-model="category.groupedExpenses[index]"
                :category="category"
                @update="$emit('update')"
              ></daily-expense-add-value>
            </b-col>
          </b-row>
        </div>
      </b-card-text>
      <div
        v-b-toggle="category.id.toString()"
        @click="collapse = !collapse"
        class="text-right mr-3 mt-2"
        style="cursor: pointer; color: black"
      >
        {{ showDetails }}
      </div>
      <b-collapse :id="category.id.toString()">
        <daily-expenses-list
          :category="category"
          @update="$emit('update')"
        ></daily-expenses-list>
      </b-collapse>
    </b-card>

    <!-- New Expense Modal -->
    <b-modal
      v-model="showNewExpensesModal"
      hide-footer
      :title="__('global.new_expense')"
      centered
    >
      <daily-expense-create
        :category="category"
        @update="$emit('update'); (showNewExpensesModal = false)"
      ></daily-expense-create>
    </b-modal>

    <!-- Edit Category name Modal -->
    <b-modal
      v-model="showEditCategoryNameModal"
      title="Editar Categoria"
      centered
      hide-footer
    >
      <daily-expenses-category-create-update
        v-model="category"
        @save="categoryHasBeenUpdated"
        @cancel="showNewCategoryModal = false"
      ></daily-expenses-category-create-update>
    </b-modal>
  </div>
</template>

<script>
export default {
  model: {
    prop: "category",
  },
  props: {
    category: {
      required: true,
      type: Object
    },
  },
  data: function () {
    return {
      showNewExpensesModal: false,
      collapse: false,
      showEditCategoryNameModal: false,
    };
  },
  mounted() {},
  methods: {
    categoryHasBeenUpdated(event) {
      this.$emit('update')
      this.showEditCategoryNameModal = false;
    },
    editCategoryName() {
      this.$emit("update", { categoryId: this.category.id });
      // let url = `/api/categories/${category.id}`;
    },
    deleteCategory(category) {
      if (
        !confirm(
          "Se voce excluir a categoria, ira excluir todos os gastos desta categoria tambem. \n Quer mesmo excluir?"
        )
      ) {
        return;
      }
      let url = `/api/categories/${category.id}`;

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
  computed: {
    showDetails() {
      if (this.collapse) {
        // this.collapse = false
        return "Ocultar detalhes";
      }
      return "Ver detalhes";
    },
  },
  watch:{
    category(){
      console.log('att categoria',this.category.groupedExpenses)
    }
  }
};
</script>

<style scoped>
.btn-xs {
  padding: 0.25rem 0.4rem;
  font-size: 0.875rem;
  line-height: 0.5;
  border-radius: 0.2rem;
}
</style>
