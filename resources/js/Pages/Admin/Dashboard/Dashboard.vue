
<template>
    <Card class="col-span-1 md:col-span-2">
        <CardHeader>
            <CardTitle> Accumulated revenue </CardTitle>
        </CardHeader>
        <CardContent>
            <h4 class="font-bold text-2xl">{{ getCurrency(accumulatedRevenue) }}</h4>
            <span class="text-sm text-gray-500">+{{ accumulatedRevenueGrowth }}% from last month</span>
        </CardContent>
    </Card>
    <Card class="col-span-1 md:col-span-2">
        <CardHeader>
            <CardTitle> Hours worked</CardTitle>
        </CardHeader>
        <CardContent>
            <h4 class="font-bold text-2xl">{{ hoursWorked }}</h4>
            <span class="text-sm text-gray-500">+{{ hoursWorkedGrowth }}% from last month</span>
        </CardContent>
    </Card>
    <Card class="col-span-1 md:col-span-2">
        <CardHeader>
            <CardTitle> Until next month </CardTitle>
        </CardHeader>
        <CardContent>
            <h4 class="font-bold text-2xl">{{ daysLeft }} day(s) left</h4>
            <span class="text-sm text-gray-500">Automatic invoicing off</span>
        </CardContent>
    </Card>
    <Card class="col-span-1 md:col-span-2">
        <CardHeader>
            <CardTitle> Average hourly wage </CardTitle>
        </CardHeader>
        <CardContent>
            <h4 class="font-bold text-2xl">{{ getCurrency(averageFreelanceWage) }}/hr</h4>
            <span class="text-sm text-gray-500">+{{ averageFreelanceWageGrowth }}% since last month </span>
        </CardContent>
    </Card>
    <Card class="col-span-1 md:col-span-5">
        <CardHeader>
            <CardTitle> Overview </CardTitle>
        </CardHeader>
        <CardContent>
            <div class="mt-8">
                <BarChart
                    index="name"
                    :data="monthlyRevenue"
                    :categories="['revenue', 'profit']"
                    :y-formatter="(tick, i) => {
                      return typeof tick === 'number'
                        ? `€${new Intl.NumberFormat('nl').format(tick).toString()}`
                        : ''
                    }"
                    :type="'stacked'"
                    :rounded-corners="8"
                    :colors="['#38bdf8', '#272727']"
                />
            </div>
        </CardContent>
    </Card>
    <Card class="col-span-1 md:col-span-3">
        <CardHeader>
            <CardTitle> Logs </CardTitle>
        </CardHeader>
        <CardContent>
            <FakeTable :columns="columns" :data="tableData" />
        </CardContent>
    </Card>
</template>
<script setup lang="ts">
import {Card, CardContent, CardTitle, CardHeader} from "@/components/ui/card";
import {BarChart} from "@/components/ui/chart-bar";
import { columns } from '../../../../ts/columns'
import FakeTable from "@/Pages/Partials/Containers/FakeTable.vue";
import {defineProps, onBeforeMount} from "vue";

interface Props {
    logs: object,
    monthlyRevenue: Record<string, any>[],
    accumulatedRevenue: Number,
    accumulatedRevenueGrowth: Number,
    hoursWorked: Number,
    hoursWorkedGrowth: Number,
    daysLeft: Number,
    averageFreelanceWage: Number,
    averageFreelanceWageGrowth: Number,
}

const props = defineProps<Props>();

onBeforeMount(() => {
    props.monthlyRevenue.forEach((item) => {
        item.revenue = getCurrency(item.revenue);
        item.profit = getCurrency(item.profit);
    });
})

const tableData = [
    {
        hours: 16,
        rate: 60,
        company: 'Friva',
    },
    {
        hours: 8,
        rate: 60,
        company: 'Friva',
    },
    {
        hours: 4,
        rate: 60,
        company: 'Friva',
    },
    {
        hours: 7,
        rate: 60,
        company: 'Friva',
    },
    {
        hours: 2,
        rate: 60,
        company: 'Friva',
    },
]

function getCurrency(value) {
    let formatter = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 0
    });

    return formatter.format(<number>value);
}
</script>
