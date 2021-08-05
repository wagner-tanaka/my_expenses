<template>
    <tr>
        <td v-if="!isEditing" style="width: 40%">{{ value.name }}</td>
        <td v-if="isEditing"><b-input v-model="value.name" size="sm" class="text-center"></b-input></td>
        <td v-if="!isEditing" style="width: 40%">{{ value.value }}</td>
        <td v-if="isEditing"><b-input v-model="value.value" size="sm" class="text-center"></b-input></td>
        <td style="width: 20%">
            <b-button v-if="!isEditing" size="sm" variant="warning" @click="isEditing = true">
                <i class="fas fa-pen"></i>
            </b-button>
            <b-button v-if="isEditing" size="sm" variant="success" @click="updateExpense">
                <i class="fas fa-check"></i>
            </b-button>
            <b-button v-if="isEditing" size="sm" variant="danger" @click="deleteExpense">
                <i class="fas fa-times-circle"></i>
            </b-button>
        </td>
    </tr>
</template>

<script>
export default {
    props: {
        value: {
            required: true,
            type: Object,
            default: () => ({})
        },
        route:{
            required: true,
            type: String,
        }
    },
    data: function () {
        return {
            isEditing: false
        };
    },
    mounted() {
        //
    },
    methods: {
        updateExpense(){
            let form = {}
            form.name = this.value.name
            form.value = this.value.value
            this.isEditing = false
            let url = `api/${this.route}/${this.value.id}`
            this.request('put',url,form,{
                onSuccess: (response) => {
                }
            })

        },
        deleteExpense(){
            this.isEditing = false
            let url = `api/${this.route}/${this.value.id}`
            this.request('delete',url,{},{
                onSuccess: () => {
                    this.$emit('delete')
                }
            })

        }
    },
};
</script>

