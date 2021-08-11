<template>
    <tr>
        <td>{{ value.name }}</td>
        <td>{{ value.value }}</td>
        <td>
            <b-button size="sm" variant="warning">
                <i class="fas fa-pen"></i>
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
