<template>
    <AdminContainer form-title="Invoice settings">
        <Link :href="route('invoices.create')" method="get" class="link-button"> Create Invoice </Link>
        <TableContainer>
            <template #thead>
                <tr>
                    <th> Ref nr. </th>
                    <th> From </th>
                    <th> To </th>
                    <th> Date range </th>
                    <th> Created at</th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                </tr>
            </template>
            <template #tbody v-for="invoice in invoices">
                <tr v-for="data in invoice">
                    <td> {{ data.id }} </td>
                    <td> {{ data.from_company }} </td>
                    <td> {{ data.to_company }} </td>
                    <td> {{ data.start_date }} t/m {{ data.end_date }}</td>
                    <td> {{ data.created_at }} </td>
                    <td class="table-item table-item-link">
                        <a :href="route('invoices.show', data.id)" target="_blank">
                            <font-awesome-icon icon="fa-solid fa-file-pdf" class="text-slate-600 hover:text-slate-800"/>
                        </a>
                    </td>
                    <td class="table-item table-item-link">
                        <Link :href="route('invoices.destroy', data.id)" method="delete">
                            <font-awesome-icon icon="fa-solid fa-trash" class="text-slate-600 hover:text-slate-800"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <a href="#">
                            <font-awesome-icon icon="fa-solid fa-envelope" class="text-slate-600 hover:text-slate-800"/>
                        </a>
                    </td>
                </tr>
            </template>
        </TableContainer>
    </AdminContainer>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import { Link } from '@inertiajs/vue3'
import TableContainer from "../../Partials/Tables/TableContainer.vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    invoices: object,
}

const props = defineProps<Props>();

const data = {
    id: null,
    from_company: null,
    to_company: null,
    start_date: null,
    end_date: null,
}
</script>
<style scoped>
.link-button {
    @apply inline-block bg-black text-white py-3 px-5 rounded-lg hover:bg-gray-800 hover:text-slate-200 mb-4
}
</style>
