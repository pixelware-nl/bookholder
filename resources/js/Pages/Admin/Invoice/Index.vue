<template>
    <AdminContainer :form-title="$t('invoice.index.title')">
        <Link :href="route('invoices.create')" method="get" class="link-button"> {{ $t('invoice.index.add_invoice') }} </Link>
        <TableContainer>
            <template #thead>
                <tr>
                    <th> {{ $t('invoice.index.ref_number') }} </th>
                    <th> {{ $t('invoice.index.from') }} </th>
                    <th> {{ $t('invoice.index.to') }} </th>
                    <th> {{ $t('invoice.index.date_range') }} </th>
                    <th> {{ $t('invoice.index.created_at') }} </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                </tr>
            </template>
            <template #tbody v-for="invoice in invoices">
                <tr v-for="data in invoice" :class="{'payed': data.payed}">
                    <td> {{ data.id }} </td>
                    <td> {{ data.from_company }} </td>
                    <td> {{ data.to_company }} </td>
                    <td> {{ data.start_date }} t/m {{ data.end_date }}</td>
                    <td> {{ data.created_at }} </td>
                    <td class="table-item table-item-link">
                        <Link v-if="data.payed == false" :href="route('invoices.payed', data.id)" method="post">
                            <FontAwesomeIcon icon="fa-solid fa-circle-check" class="text-slate-600 hover:text-slate-800"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <a :href="route('invoices.show', data.id)" target="_blank">
                            <FontAwesomeIcon icon="fa-solid fa-file-pdf"/>
                        </a>
                    </td>
                    <td class="table-item table-item-link">
                        <Link v-if="data.payed == false" :href="route('invoices.edit', data.id)">
                            <FontAwesomeIcon icon="fa-solid fa-pen-to-square"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <Link :href="route('invoices.destroy', data.id)" method="delete">
                            <FontAwesomeIcon icon="fa-solid fa-trash"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <a href="#">
                            <FontAwesomeIcon icon="fa-solid fa-envelope"/>
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
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

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
