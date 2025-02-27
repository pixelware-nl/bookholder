<script setup lang="ts">
import Card from "@/components/ui/card/Card.vue";
import CardDescription from "@/components/ui/card/CardDescription.vue";
import CardContent from "@/components/ui/card/CardContent.vue";
import CardTitle from "@/components/ui/card/CardTitle.vue";
import CardHeader from "@/components/ui/card/CardHeader.vue";
import {BarChart} from "@/components/ui/chart-bar";
import { columns } from '../../../../ts/columns'
import DataTable from '@/Pages/Partials/Containers/FakeTable.vue'
import {onMounted, ref} from "vue";
import FakeTable from "@/Pages/Partials/Containers/FakeTable.vue";
import {DonutChart} from "@/components/ui/chart-donut";
import FakeDonutChart from "@/Pages/Partials/Containers/FakeDonutChart.vue";
import {LineChart} from "@/components/ui/chart-line";

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

onMounted(async () => {
    data.value = await getData()
})
</script>
<template>
    <div class="mt-12 pb-12 flex justify-center items-center">
        <div class="w-11/12 md:w-4/6 grid grid-cols-1 gap-4 md:grid-cols-8">
            <Card class="col-span-1 md:col-span-2">
                <CardHeader>
                    <CardTitle> Accumulated revenue </CardTitle>
                </CardHeader>
                <CardContent>
                    <h4 class="font-bold text-2xl">$45.234,12</h4>
                    <span class="text-sm text-gray-500">+20% from last month</span>
                </CardContent>
            </Card>
            <Card class="col-span-1 md:col-span-2">
                <CardHeader>
                    <CardTitle> Hours worked</CardTitle>
                </CardHeader>
                <CardContent>
                    <h4 class="font-bold text-2xl">43</h4>
                    <span class="text-sm text-gray-500">+17% from last month</span>
                </CardContent>
            </Card>
            <Card class="col-span-1 md:col-span-2">
                <CardHeader>
                    <CardTitle> Until next month </CardTitle>
                </CardHeader>
                <CardContent>
                    <h4 class="font-bold text-2xl">4 days left</h4>
                    <span class="text-sm text-gray-500">Automatic invoicing is turned off</span>
                </CardContent>
            </Card>
            <Card class="col-span-1 md:col-span-2">
                <CardHeader>
                    <CardTitle> Freelance wage </CardTitle>
                </CardHeader>
                <CardContent>
                    <h4 class="font-bold text-2xl">$60/hr</h4>
                    <span class="text-sm text-gray-500">No increase from last month</span>
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
                            :data="data"
                            :categories="['total', 'predicted']"
                            :y-formatter="(tick, i) => {
                              return typeof tick === 'number'
                                ? `€${new Intl.NumberFormat('nl').format(tick).toString()}`
                                : ''
                            }"
                            :type="'stacked'"
                            :rounded-corners="8"
                            :colors="['#7bd38d', '#272727']"
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
            <Card class="col-span-1 md:col-span-2">
                <CardHeader>
                    <CardTitle> Revenue by companies</CardTitle>
                    <CardDescription>The amount of revenue earned per company</CardDescription>
                </CardHeader>
                <CardContent>
                    <table class="w-full mb-10">
                        <tbody>
                            <tr>
                                <td>Friva</td>
                                <td>$3.233,34</td>
                            </tr>
                            <tr>
                                <td>Rituals</td>
                                <td>$3.233,34</td>
                            </tr>
                        </tbody>
                    </table>
                    <FakeDonutChart />
                </CardContent>
            </Card>
            <Card class="col-span-1 md:col-span-6">
                <CardHeader>
                    <CardTitle> Overview </CardTitle>
                </CardHeader>
                <CardContent>
                    <LineChart
                        :data="data"
                        index="name"
                        :categories="['total', 'predicted']"
                        :y-formatter="(tick, i) => {
                            return typeof tick === 'number'
                                ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}`
                                : ''
                        }"
                        :custom-tooltip="CustomChartTooltip"
                    />
                </CardContent>
            </Card>

        </div>
    </div>

</template>
