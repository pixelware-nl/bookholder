<template>
    <div class="flex flex-row">
        <div class="flex flex-col w-1/3">
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px]">
                <p class="text-lg text-gray-400">Expected revenue</p>
                <h1 class="text-4xl font-black">{{ totalAsCurrency }}</h1>
            </div>
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px] mt-8">
                <p class="text-lg text-gray-400">New month in</p>
                <h1 class="text-4xl font-black">{{ daysUntilNewMonth }} day(s)</h1>
            </div>
        </div>
        <div class="bg-white w-2/3 flex rounded-md shadow-md flex-col items-center ml-8 pb-4 max-h-[39.5em] overflow-auto">
            <div class="p-2.5 w-full sticky top-0 bg-white"></div>
            <table class="w-[58rem] bg-white">
                <tr class="sticky top-5 bg-white">
                    <th> Company </th>
                    <th> Rate </th>
                    <th> Hours </th>
                    <th> Product </th>
                    <th> Type </th>
                </tr>
                <tbody v-for="log in logs">
                    <tr v-for="data in log">
                        <td> {{ data.company_name }} </td>
                        <td> {{ getCurrency(data.rate) }} </td>
                        <td> {{ data.hours }} </td>
                        <td> {{ data.name }} </td>
                        <td> {{ data.description }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup lang="ts">
import {computed, defineProps, onMounted} from "vue";

interface Props {
    logs: object,
    totalLogs: number
    daysUntilNewMonth: number
}

const props = defineProps<Props>();

const totalAsCurrency = computed(() => {
    return getCurrency(props.totalLogs);
})

function getCurrency(value) {
    let formatter = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0
    });

    return formatter.format(<number>value);
}

onMounted(() => {
    console.log(props.logs)
})
</script>
<style scoped>
::-webkit-scrollbar-thumb {
    background-color: #d6dee1;
    border-radius: 20px;
    border: 6px solid transparent;
    background-clip: content-box;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #a8bbbf;
}

::-webkit-scrollbar-track {
    background-color: transparent;
}

::-webkit-scrollbar {
    width: 20px;
}

.link-button {
    @apply inline-block bg-black text-white py-6 px-6 rounded-lg hover:bg-gray-800 hover:text-slate-200 mb-4
}

tbody tr:nth-child(even) {
    @apply bg-slate-50
}
</style>
