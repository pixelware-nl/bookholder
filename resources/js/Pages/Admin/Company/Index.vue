<template>
    <h1 class="header-title"> Overview of Companies </h1>
    <Link href="#" method="get" class="link-button"> Create Company </Link>
    <table class="table">
        <thead>
        <tr class="table-header">
            <th class="table-header-item table-item-first"> Name </th>
            <th class="table-header-item"> Location </th>
            <th class="table-header-item"> Phone </th>
            <th class="table-header-item"> Email </th>
        </tr>
        </thead>
        <tbody v-for="company in companies">
        <tr class="border-b-[1px] ">
            <td class="table-item table-item-first"> {{ company.name }} </td>
            <td class="table-item"> {{ company.city }}, {{ company.province }} </td>
            <td class="table-item"> {{ company.phone }} </td>
            <td class="table-item"> {{ company.email }} </td>
        </tr>
        </tbody>
    </table>
    <div >

    </div>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import { Link } from '@inertiajs/vue3'

interface Props {
    companies: object,
}

const props = defineProps<Props>();
</script>
<style scoped>
.header-title {
    @apply font-bold text-2xl uppercase mb-8
}

.link-button {
    @apply inline-block bg-black text-white py-3 px-5 rounded-lg hover:bg-gray-800 hover:text-slate-200 mb-4
}

.table {
    @apply border-collapse w-full
}

.table-header {
    @apply bg-slate-100
}

.table-header-item {
    @apply text-left py-[15px]
}

.table-item-first {
    @apply pl-[15px]
}

.table-item {
    @apply py-[15px]
}

.table-item-link {
    @apply text-blue-600 hover:text-blue-900 select-none
}
</style>
