<template>
    <table class="table">
        <thead>
            <slot name="thead" />
        </thead>
        <tbody>
            <slot name="tbody" />
        </tbody>
    </table>
</template>
<style>
/* @TODO: make this scoped */
.table {
    @apply border-collapse w-full
}

tr th {
    @apply text-left py-[15px] bg-slate-100
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

tbody tr:nth-child(even) {
    @apply bg-slate-50
}
</style>
