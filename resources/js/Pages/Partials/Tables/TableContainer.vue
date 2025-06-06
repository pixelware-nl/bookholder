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
    @apply w-full border-collapse;
}

tr th {
    @apply bg-slate-100 py-[15px] text-left;
}

th:first-child,
td:first-child {
    @apply pl-[15px];
}

tr td:not(.table-item-link) {
    @apply py-[15px] text-slate-800;
}

tbody tr:nth-child(odd) {
    @apply bg-white;
}

tbody tr:nth-child(even) {
    @apply bg-slate-50;
}

tbody tr .table-item-link {
    @apply text-slate-600 hover:text-slate-800;
}

tbody .payed:nth-child(odd) {
    @apply bg-green-50;
}

tbody .payed:nth-child(even) {
    @apply bg-green-100;
}

tbody .payed td {
    @apply text-green-800;
}

tbody .payed .table-item-link {
    @apply text-green-600 hover:text-green-800;
}
</style>
