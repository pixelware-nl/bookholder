<template>
    <table class="border-collapse w-full">
        <thead>
            <tr class="bg-slate-100">
                <th class="text-left py-[15px] pl-[15px]"> Ref nr. </th>
                <th class="text-left py-[15px]"> From </th>
                <th class="text-left py-[15px]"> To </th>
                <th class="text-left py-[15px]"> Date </th>
                <th class="text-left py-[15px]"> View </th>
                <th class="text-left py-[15px]"> Delete </th>
                <th class="text-left py-[15px]"> Mail </th>
            </tr>
        </thead>
        <tbody v-for="invoice in invoices">
            <tr v-for="data in invoice" class="border-b-[1px] ">
                <td class="py-[15px] pl-[15px]"> {{ data.id }} </td>
                <td class="py-[15px]"> {{ data.from_company }} </td>
                <td class="py-[15px]"> {{ data.to_company }}</td>
                <td class="py-[15px]"> {{ data.start_date }} t/m {{ data.end_date}}</td>
                <td class="py-[15px] text-blue-600 hover:text-blue-900"> <a :href="route('invoice.show', data.id)"> View </a> </td>
                <td class="py-[15px] text-blue-600 hover:text-blue-900"> <a href="#"> Delete </a> </td>
                <td class="py-[15px] text-blue-600 hover:text-blue-900"> <a href="#"> Send </a> </td>
            </tr>
        </tbody>
    </table>
    <div >

    </div>
</template>
<script setup lang="ts">
import {defineProps, onMounted} from "vue";

interface Props {
    invoices: object,
}

const props = defineProps<Props>();

onMounted(() => {
    console.log(props.invoices);
});
</script>
