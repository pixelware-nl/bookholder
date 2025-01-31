<template>
    <TabContainer
        :tabs="['pending', 'payed']"
        v-model="currentTab"
    />
    <AdminContainer :form-title="$t('log.index.title')">
        <Link :href="route('logs.create')" method="get" class="link-button"> {{ $t('log.index.add_log') }} </Link>
        <TableContainer>
            <template #thead>
                <tr>
                    <th> {{ $t('log.index.company') }} </th>
                    <th> {{ $t('log.index.rate') }} </th>
                    <th> {{ $t('log.index.hours') }} </th>
                    <th> {{ $t('log.index.name') }} </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                    <th class="w-[50px]"> </th>
                </tr>
            </template>
            <template #tbody>
                <tr v-if="filteredLogs.length > 0" v-for="log in filteredLogs" :class="{'payed': log.payed}">
                    <td> {{ log.company_name }} </td>
                    <td> {{ log.rate }} </td>
                    <td> {{ log.hours }} </td>
                    <td> {{ log.name }} </td>
                    <td class="table-item table-item-link">
                        <Link :href="route('logs.show', log.id)">
                            <FontAwesomeIcon icon="fa-solid fa-eye"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <Link v-if="log.payed == false" :href="route('logs.edit', log.id)">
                            <FontAwesomeIcon icon="fa-solid fa-pen-to-square"/>
                        </Link>
                    </td>
                    <td class="table-item table-item-link">
                        <Link :href="route('logs.destroy', log.id)" method="delete">
                            <FontAwesomeIcon icon="fa-solid fa-trash"/>
                        </Link>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="7" class="text-center !text-gray-400"> {{ $t('log.index.no_entries') }} </td>
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

interface Props {
    logs: object,
}

const props = defineProps<Props>();

const currentTab = ref('pending')

const filteredLogs = computed(() => {
    return props.logs.data.filter((invoice: any) => {
        return currentTab.value === 'pending'
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
