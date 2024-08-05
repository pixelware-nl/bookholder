<template>
    <table class="table">
        <thead>
            <slot name="thead" />
        </thead>
        <tbody v-for="item in collection">
            <tr v-for="data in item">
                <slot name="tbody" />
            </tr>
        </tbody>
    </table>
</template>
<script setup lang="ts">
interface Props {
    collection: object,
}

const props = defineProps<Props>();
</script>
<style scoped>
.table {
    @apply border-collapse w-full
}

tr {
    @apply bg-slate-100
}

tr th {
    @apply text-left py-[15px]
}

th:first-child, td:first-child {
    @apply pl-[15px]
}

tr td {
    @apply py-[15px]
}

.table-item-link {
    @apply text-blue-600 hover:text-blue-900 select-none
}
</style>
