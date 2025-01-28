<template>
    <div class="flex flex-row">
        <div class="flex flex-col w-1/3">
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px]">
                <p class="text-lg text-gray-400">{{ $t('dashboard.expected_revenue') }}</p>
                <div class="flex items-center">
                    <span class="text-4xl font-black pe-2">{{ totalAsCurrency }}</span>
                    <span class="text-red-600 text-lg font-bold">(-{{ owedAsCurrency }})</span>
                </div>
                <p class="text-2xl font-bold text-gray-200 mt-2">{{ getCurrency((props.totalLogs - props.totalOwed) * 0.7) }}</p>
            </div>
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px] mt-8">
                <p class="text-lg text-gray-400">{{ $t('dashboard.new_month') }}</p>
                <h1 class="text-4xl font-black">{{ daysText }}</h1>
            </div>
        </div>
        <div class="bg-white w-2/3 flex rounded-md shadow-md flex-col items-center ml-8 pb-4 max-h-[39.5em] overflow-auto">
            <div class="p-2.5 w-full sticky top-0 bg-white"></div>
            <table class="w-[58rem] bg-white">
                <tr class="sticky top-5 bg-white">
                    <th> {{ $t('dashboard.company') }} </th>
                    <th> {{ $t('dashboard.rate') }} </th>
                    <th> {{ $t('dashboard.hours') }} </th>
                    <th> {{ $t('dashboard.product') }} </th>
                    <th> {{ $t('dashboard.total') }} </th>
                </tr>
                <tbody v-for="log in logs">
                    <tr v-for="data in log">
                        <td> {{ data.company_name }} </td>
                        <td> {{ getCurrency(data.rate) }} </td>
                        <td> {{ data.hours }} </td>
                        <td> {{ data.name }} </td>
                        <td class="font-bold"> {{ rowTotalAsCurrency(data) }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup lang="ts">
import {computed, defineProps, onMounted} from "vue";
import {trans} from "laravel-vue-i18n";

interface Props {
    logs: object,
    totalLogs: number,
    totalOwed: number,
    daysUntilNewMonth: number
}

const props = defineProps<Props>();

const totalAsCurrency = computed(() => {
    return getCurrency(props.totalLogs);
})

const owedAsCurrency = computed(() => {
    return getCurrency(props.totalOwed);
})

const daysText = computed(() => {
    if (props.daysUntilNewMonth === 0) {
        return trans('dashboard.tomorrow');
    }

    if (props.daysUntilNewMonth === 1) {
        return trans('dashboard.day_after_tomorrow');
    }

    return props.daysUntilNewMonth + ' ' + trans('dashboard.days').toLowerCase();
})

function rowTotalAsCurrency(data) {
    return getCurrency(data.rate * data.hours);
}

function getCurrency(value) {
    let formatter = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0
    });

    return formatter.format(<number>value);
}
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
