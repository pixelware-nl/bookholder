<template>
    <h1 class="header-title"> Overview </h1>
    <Link :href="route('invoice.create')" method="get" class="link-button"> Create Invoice </Link>
    <table class="table">
        <thead>
            <tr class="table-header">
                <th class="table-header-item table-item-first"> Ref nr. </th>
                <th class="table-header-item"> From </th>
                <th class="table-header-item"> To </th>
                <th class="table-header-item"> Date </th>
                <th class="table-header-item"> View </th>
                <th class="table-header-item]"> Delete </th>
                <th class="table-header-item"> Mail </th>
            </tr>
        </thead>
        <tbody v-for="invoice in invoices">
            <tr v-for="data in invoice" class="border-b-[1px] ">
                <td class="table-item table-item-first"> {{ data.id }} </td>
                <td class="table-item"> {{ data.from_company }} </td>
                <td class="table-item"> {{ data.to_company }}</td>
                <td class="table-item"> {{ data.start_date }} t/m {{ data.end_date}}</td>
                <td class="table-item table-item-link"> <a :href="route('invoice.show', data.id)" target="_blank"> View </a> </td>
                <td class="table-item table-item-link"> <Link :href="route('invoice.destroy', data.id)" method="delete"> Delete </Link> </td>
                <td class="table-item table-item-link"> <a href="#"> Send </a> </td>
            </tr>
        </tbody>
    </table>
    <div >

    </div>
</template>
<script setup lang="ts">
import {defineProps, onMounted, ref} from "vue";
import { Link } from '@inertiajs/vue3'

interface Props {
    invoices: object,
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
