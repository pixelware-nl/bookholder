<template>
    <TabContainer
        :tabs="[$t('vue.components.tabs.pending'), $t('vue.components.tabs.payed')]"
        v-model="currentTab"
    />
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
            <template #tbody>
                <tr v-if="filteredInvoices.length > 0" v-for="invoice in filteredInvoices" :class="{'payed': invoice.payed}">
                    <td> {{ invoice.id }} </td>
                    <td> {{ invoice.from_company }} </td>
                    <td> {{ invoice.to_company }} </td>
                    <td> {{ invoice.start_date }} t/m {{ invoice.end_date }}</td>
                    <td> {{ invoice.created_at }} </td>
                    <td class="table-item table-item-link">
                        <Link v-if="invoice.payed == false" :href="route('invoices.payed', invoice.id)" method="post">
                            <FontAwesomeIcon icon="fa-solid fa-circle-check" class="text-slate-600 hover:text-slate-800"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <a :href="route('invoices.show', invoice.id)" target="_blank">
                            <FontAwesomeIcon icon="fa-solid fa-file-pdf"/>
                        </a>
                    </td>
                    <td class="table-item table-item-link">
                        <Link v-if="invoice.payed == false" :href="route('invoices.edit', invoice.id)">
                            <FontAwesomeIcon icon="fa-solid fa-pen-to-square"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <Link :href="route('invoices.destroy', invoice.id)" method="delete">
                            <FontAwesomeIcon icon="fa-solid fa-trash"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <a href="#">
                            <FontAwesomeIcon icon="fa-solid fa-envelope"/>
                        </a>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="10" class="text-center !text-gray-400"> {{ $t('invoice.index.no_entries') }} </td>
                </tr>
            </template>
        </TableContainer>
    </AdminContainer>
</template>
<script setup lang="ts">
import {computed, defineProps, onMounted, ref} from "vue";
import { Link } from '@inertiajs/vue3'
import TableContainer from "../../Partials/Tables/TableContainer.vue";
import AdminContainer from "../Partials/AdminContainer.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import TabContainer from "../../Partials/Containers/TabContainer.vue";
import {trans} from "laravel-vue-i18n";

interface Props {
    invoices: object,
    currentTab: string,
}

const props = defineProps<Props>();
const currentTab = ref('')

onMounted(() => {
    currentTab.value = props.currentTab;
})

const filteredInvoices = computed(() => {
    return props.invoices.data.filter((invoice: any) => {
        return currentTab.value === trans('vue.components.tabs.pending')
            ? invoice.payed == false
            : invoice.payed;
    });
});
</script>
<style scoped>
.link-button {
    @apply inline-block bg-black text-white py-3 px-5 rounded-lg hover:bg-gray-800 hover:text-slate-200 mb-4
}
</style>
