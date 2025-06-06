<template>
    <AdminContainer :form-title="$t('company.index.title')">
        <Link :href="route('companies.find')" method="get" class="link-button"> {{ $t('company.index.add_company') }} </Link>
        <TableContainer>
            <template #thead>
                <tr>
                    <th>{{ $t('company.index.name') }}</th>
                    <th>{{ $t('company.index.address') }}</th>
                    <th class="w-[50px]"></th>
                </tr>
            </template>
            <template #tbody>
                <tr class="text-slate-400">
                    <td>{{ userCompany.name }}</td>
                    <td>{{ userCompany.street_address }}, {{ userCompany.city }}</td>
                    <td class="table-item table-item-link">
                        <Link :href="route('companies.edit', userCompany.id)">
                            <font-awesome-icon icon="fa-solid fa-pen-to-square" class="text-slate-600 hover:text-slate-800" />
                        </Link>
                    </td>
                </tr>
                <tr v-for="company in companies" v-bind:key="company.id">
                    <td>{{ company.name }}</td>
                    <td>{{ company.street_address }}, {{ company.city }}</td>
                    <td class="table-item table-item-link">
                        <Link :href="route('companies.destroy', company.id)" method="delete">
                            <font-awesome-icon icon="fa-solid fa-trash" class="text-slate-600 hover:text-slate-800" />
                        </Link>
                    </td>
                </tr>
            </template>
        </TableContainer>
    </AdminContainer>
</template>
<script setup lang="ts">
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import TableContainer from '../../Partials/Tables/TableContainer.vue';
import AdminContainer from '../Partials/AdminContainer.vue';

interface Props {
    userCompany: object;
    companies: object;
}

defineProps<Props>();
</script>
<style scoped>
.header-title {
    @apply mb-8 text-2xl font-bold uppercase;
}

.link-button {
    @apply mb-4 inline-block rounded-lg bg-black px-5 py-3 text-white hover:bg-gray-800 hover:text-slate-200;
}

.table {
    @apply w-full border-collapse;
}

.table-header {
    @apply bg-slate-100;
}

.table-header-item {
    @apply py-[15px] text-left;
}

.table-item-first {
    @apply pl-[15px];
}

.table-item {
    @apply py-[15px];
}

.table-item-link {
    @apply select-none text-blue-600 hover:text-blue-900;
}
</style>
