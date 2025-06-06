<template>
    <TableContainer>
        <template #thead>
            <tr>
                <th>{{ $t('invoice.index.ref_number') }}</th>
                <th>{{ $t('invoice.index.from') }}</th>
                <th>{{ $t('invoice.index.to') }}</th>
                <th>{{ $t('invoice.index.date_range') }}</th>
                <th>{{ $t('invoice.index.created_at') }}</th>
                <th class="w-[50px]"></th>
                <th class="w-[50px]"></th>
                <th class="w-[50px]"></th>
                <th class="w-[50px]"></th>
                <th class="w-[50px]"></th>
            </tr>
        </template>
        <template #tbody v-if="filteredInvoices.length > 0" >
            <tr v-for="invoice in filteredInvoices" :class="{ payed: invoice.payed }" v-bind:key="invoice.id">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.from_company }}</td>
                <td>{{ invoice.to_company }}</td>
                <td>{{ invoice.start_date }} t/m {{ invoice.end_date }}</td>
                <td>{{ invoice.created_at }}</td>
                <td class="table-item table-item-link">
                    <Link v-if="invoice.payed == false" :href="route('invoices.payed', invoice.id)" method="post">
                        <FontAwesomeIcon icon="fa-solid fa-circle-check" class="text-slate-600 hover:text-slate-800" />
                    </Link>
                </td>
                <td class="table-item table-item-link">
                    <a :href="route('invoices.show', invoice.id)" target="_blank">
                        <FontAwesomeIcon icon="fa-solid fa-file-pdf" />
                    </a>
                </td>
                <td class="table-item table-item-link">
                    <Link v-if="invoice.payed == false" :href="route('invoices.edit', invoice.id)">
                        <FontAwesomeIcon icon="fa-solid fa-pen-to-square" />
                    </Link>
                </td>
                <td class="table-item table-item-link">
                    <Link :href="route('invoices.destroy', invoice.id)" method="delete">
                        <FontAwesomeIcon icon="fa-solid fa-trash" />
                    </Link>
                </td>
                <td class="table-item table-item-link">
                    <a href="#">
                        <FontAwesomeIcon icon="fa-solid fa-envelope" />
                    </a>
                </td>
            </tr>
        </template>
        <template #tbody v-else>
            <tr>
                <td colspan="10" class="text-center !text-gray-400">{{ $t('invoice.index.no_entries') }}</td>
            </tr>
        </template>
    </TableContainer>
</template>
<script setup lang="ts">
import TableContainer from '@/Pages/Partials/Tables/TableContainer.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { computed, defineProps } from 'vue';

interface Props {
    invoices: object;
    payed: boolean;
}

const props = defineProps<Props>();

const filteredInvoices = computed(() => {
    return props.invoices.data.filter((invoice: any) => {
        return props.payed ? invoice.payed == true : invoice.payed == false;
    });
});
</script>
