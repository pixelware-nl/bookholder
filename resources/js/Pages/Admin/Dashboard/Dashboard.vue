<template>
    <div class="flex flex-row">
        <div class="flex flex-col w-1/3">
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px]">
                <p class="text-lg text-gray-400">{{ $t('dashboard.expected_revenue') }}</p>
                <div class="flex items-center">
                    <span class="text-4xl font-black pe-2">{{ sumUnpaidTotalCurrency }}</span>
                </div>
            </div>
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px] mt-8">
                <p class="text-lg text-gray-400">{{ $t('dashboard.net_profit') }}</p>
                <div class="flex items-center">
                    <span class="text-4xl font-black pe-2">{{ sumPayedNet }}</span>
                </div>
            </div>
            <div class="bg-white w-full flex rounded-md shadow-md flex-col items-center justify-center min-h-[300px] max-h-[300px] mt-8">
                <p class="text-lg text-gray-400">{{ $t('dashboard.new_month') }}</p>
                <div class="flex items-center">
                    <span class="text-4xl font-black pe-2">{{ daysText }}</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-2/3">
            <TabContainer
                class="ms-8"
                :tabs="['pending', 'payed']"
                v-model="currentTab"
            />
            <div class="bg-white flex rounded-md shadow-md flex-col items-center ml-8 pb-4 min-h-[39.5em] overflow-auto">
                <div class="p-2.5 w-full sticky top-0 bg-white"></div>
                <table class="w-[58rem] bg-white">
                    <tr class="sticky top-5 bg-white">
                        <th> {{ $t('dashboard.company') }} </th>
                        <th> {{ $t('dashboard.rate') }} </th>
                        <th> {{ $t('dashboard.hours') }} </th>
                        <th> {{ $t('dashboard.product') }} </th>
                        <th> {{ $t('dashboard.total') }} </th>
                    </tr>
                    <tbody>
                        <tr
                            v-if="filteredLogs.length > 0"
                            v-for="log in filteredLogs"
                            :class="{'payed': log.payed}"
                        >
                            <td> {{ log.company_name }} </td>
                            <td> {{ getCurrency(log.rate) }} </td>
                            <td> {{ log.hours }} </td>
                            <td> {{ log.name }} </td>
                            <td class="font-bold"> {{ rowTotalAsCurrency(log) }} </td>
                        </tr>
                        <tr v-else>
                            <td colspan="7" class="text-center !text-gray-400"> {{ $t('log.index.no_entries') }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import {computed, defineProps, ref} from "vue";
import {trans} from "laravel-vue-i18n";
import TabContainer from "@/Pages/Partials/Containers/TabContainer.vue";

interface Props {
    logs: object,
    sumUnpaidTotal: number,
    sumUnpaidOwed: number,
    sumPayedTotal: number,
    daysUntilNewMonth: number
}

const props = defineProps<Props>();
const currentTab = ref('pending')

const sumUnpaidTotalCurrency = computed(() => {
    return getCurrency(props.sumUnpaidTotal);
})

const sumPayedNet = computed(() => {
    return getCurrency(props.sumPayedTotal * 0.6);
})

const sumPayedTotalCurrency = computed(() => {
    return getCurrency(props.sumPayedTotal);
})

const filteredLogs = computed(() => {
    return props.logs.data.filter((logs: any) => {
        return currentTab.value === 'pending'
            ? logs.payed == false
            : logs.payed;
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
</style>
