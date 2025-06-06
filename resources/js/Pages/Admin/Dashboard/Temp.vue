<template>
    <div class="flex flex-row">
        <div class="flex w-1/3 flex-col">
            <div class="flex max-h-[300px] min-h-[300px] w-full flex-col items-center justify-center rounded-md bg-white shadow-md">
                <p class="text-lg text-gray-400">{{ $t('dashboard.expected_revenue') }}</p>
                <div class="flex items-center">
                    <span class="pe-2 text-4xl font-black">{{ sumUnpaidTotalCurrency }}</span>
                </div>
            </div>
            <div class="mt-8 flex max-h-[300px] min-h-[300px] w-full flex-col items-center justify-center rounded-md bg-white shadow-md">
                <p class="text-lg text-gray-400">{{ $t('dashboard.net_profit') }}</p>
                <div class="flex items-center">
                    <span class="pe-2 text-4xl font-black text-green-900">{{ sumPayedNet }}</span>
                </div>
            </div>
            <div class="mt-8 flex max-h-[300px] min-h-[300px] w-full flex-col items-center justify-center rounded-md bg-white shadow-md">
                <p class="text-lg text-gray-400">{{ $t('dashboard.new_month') }}</p>
                <div class="flex items-center">
                    <span class="pe-2 text-4xl font-black">{{ daysText }}</span>
                </div>
            </div>
        </div>
        <div class="flex w-2/3 flex-col">
            <TabContainer class="ms-8" :tabs="[$t('vue.components.tabs.pending'), $t('vue.components.tabs.payed')]" v-model="currentTab" />
            <div class="ml-8 flex min-h-[39.5em] flex-col items-center overflow-auto rounded-md bg-white pb-4 shadow-md">
                <div class="sticky top-0 w-full bg-white p-2.5"></div>
                <table class="w-[58rem] bg-white">
                    <tr class="sticky top-5 bg-white">
                        <th>{{ $t('dashboard.company') }}</th>
                        <th>{{ $t('dashboard.rate') }}</th>
                        <th>{{ $t('dashboard.hours') }}</th>
                        <th>{{ $t('dashboard.product') }}</th>
                        <th>{{ $t('dashboard.total') }}</th>
                    </tr>
                    <tbody>
                        <tr v-if="filteredLogs.length > 0" v-for="log in filteredLogs" :class="{ payed: log.payed }">
                            <td>{{ log.company_name }}</td>
                            <td>{{ getCurrency(log.rate) }}</td>
                            <td>{{ log.hours }}</td>
                            <td>{{ log.name }}</td>
                            <td class="font-bold">{{ rowTotalAsCurrency(log) }}</td>
                        </tr>
                        <tr v-else>
                            <td colspan="7" class="text-center !text-gray-400">{{ $t('log.index.no_entries') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import TabContainer from '@/Pages/Partials/Containers/TabContainer.vue';
import { trans } from 'laravel-vue-i18n';
import { computed, defineProps, onMounted, ref } from 'vue';

interface Props {
    logs: object;
    sumUnpaidTotal: number;
    sumUnpaidOwed: number;
    sumPayedTotal: number;
    daysUntilNewMonth: number;
    currentTab: string;
}

const props = defineProps<Props>();
const currentTab = ref('');

onMounted(() => {
    currentTab.value = props.currentTab;
});

const sumUnpaidTotalCurrency = computed(() => {
    return getCurrency(props.sumUnpaidTotal);
});

const sumPayedNet = computed(() => {
    return getCurrency(props.sumPayedTotal * 0.6);
});

const filteredLogs = computed(() => {
    return props.logs.data.filter((logs: any) => {
        return currentTab.value === trans('vue.components.tabs.pending') ? logs.payed == false : logs.payed;
    });
});

const daysText = computed(() => {
    if (props.daysUntilNewMonth === 0) {
        return trans('dashboard.tomorrow');
    }

    if (props.daysUntilNewMonth === 1) {
        return trans('dashboard.day_after_tomorrow');
    }

    return props.daysUntilNewMonth + ' ' + trans('dashboard.days').toLowerCase();
});

function rowTotalAsCurrency(data) {
    return getCurrency(data.rate * data.hours);
}

function getCurrency(value) {
    let formatter = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0,
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
</style>
