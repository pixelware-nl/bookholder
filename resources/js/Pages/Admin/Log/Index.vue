<template>
    <AdminContainer form-title="Logboek">
        <Link :href="route('logs.create')" method="get" class="link-button"> Log toevoegen </Link>
        <TableContainer>
            <template #thead>
                <tr>
                    <th> Bedrijf </th>
                    <th> Tarief </th>
                    <th> Uren </th>
                    <th> Naam </th>
                    <th> Beschrijving </th>
                    <th class="w-[50px]"> </th>
                </tr>
            </template>
            <template #tbody>
                <tr v-for="log in logs.data">
                    <td> {{ log.company_name }} </td>
                    <td> {{ log.rate }} </td>
                    <td> {{ log.hours }} </td>
                    <td> {{ log.name }} </td>
                    <td> {{ log.description }} </td>
                    <td class="table-item table-item-link ">
                        <Link :href="route('logs.destroy', log.id)" method="delete">
                            <font-awesome-icon icon="fa-solid fa-trash" class="text-slate-600 hover:text-slate-800"/>
                        </Link>
                    </td>
                </tr>
            </template>
        </TableContainer>
    </AdminContainer>
</template>
<script setup lang="ts">
import {defineProps, onMounted} from "vue";
import { Link } from '@inertiajs/vue3'
import TableContainer from "../../Partials/Tables/TableContainer.vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    logs: object,
}

const props = defineProps<Props>();
</script>
<style scoped>
.link-button {
    @apply inline-block bg-black text-white py-3 px-5 rounded-lg hover:bg-gray-800 hover:text-slate-200 mb-4
}
</style>
