
<template>
    <Card class="col-span-1 md:col-span-2">
        <CardHeader>
            <CardTitle> Accumulated revenue </CardTitle>
        </CardHeader>
        <CardContent>
            <h4 class="font-bold text-2xl">€{{ accumulatedRevenue }}</h4>
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
            <h4 class="font-bold text-2xl">€{{ averageFreelanceWage }}/hr</h4>
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
import {defineProps, onMounted} from "vue";

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

onMounted(() => {
    console.log(props.monthlyRevenue);
    console.log(typeof data)
})

const data = [
    { name: 'Jan', total: Math.floor(Math.random() * 2000) + 500, predicted: 2000 },
    { name: 'Feb', total: Math.floor(Math.random() * 2000) + 500, predicted: 1900 },
    { name: 'Mar', total: Math.floor(Math.random() * 2000) + 500, predicted: 1800 },
    { name: 'Apr', total: Math.floor(Math.random() * 2000) + 500, predicted: 1700 },
    { name: 'May', total: Math.floor(Math.random() * 2000) + 500, predicted: 1600 },
    { name: 'Jun', total: Math.floor(Math.random() * 2000) + 500, predicted: 1500 },
    { name: 'Jul', total: Math.floor(Math.random() * 2000) + 500, predicted: 1400 },
    { name: 'Aug', total: Math.floor(Math.random() * 2000) + 500, predicted: 1300 },
    { name: 'Sep', total: Math.floor(Math.random() * 2000) + 500, predicted: 1200 },
    { name: 'Oct', total: Math.floor(Math.random() * 2000) + 500, predicted: 1100 },
    { name: 'Nov', total: Math.floor(Math.random() * 2000) + 500, predicted: 1000 },
    { name: 'Dec', total: Math.floor(Math.random() * 2000) + 500, predicted: 900 },
]

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
</script>
