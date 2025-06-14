<template>
    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
        <Card>
            <CardHeader>
                <CardTitle> Accumulated revenue </CardTitle>
            </CardHeader>
            <CardContent>
                <h4 class="text-2xl font-bold">
                    {{ getCurrency(accumulatedRevenue.current) }}
                </h4>
                <span class="text-sm text-gray-500"
                    >+{{ accumulatedRevenue.growth }}% from last month</span
                >
            </CardContent>
        </Card>
        <Card>
            <CardHeader>
                <CardTitle> Hours worked</CardTitle>
            </CardHeader>
            <CardContent>
                <h4 class="text-2xl font-bold">{{ hoursWorked.current }}</h4>
                <span class="text-sm text-gray-500"
                    >+{{ hoursWorked.growth }}% from last month</span
                >
            </CardContent>
        </Card>
        <Card>
            <CardHeader>
                <CardTitle> Until next month </CardTitle>
            </CardHeader>
            <CardContent>
                <h4 class="text-2xl font-bold">{{ daysLeft }} day(s) left</h4>
                <span class="text-sm text-gray-500"
                    >Automatic invoicing off</span
                >
            </CardContent>
        </Card>
        <Card>
            <CardHeader>
                <CardTitle> Average hourly wage </CardTitle>
            </CardHeader>
            <CardContent>
                <h4 class="text-2xl font-bold">
                    {{ getCurrency(freelanceWage.current) }}/hr
                </h4>
                <span class="text-sm text-gray-500"
                    >+{{ freelanceWage.growth }}% since last month
                </span>
            </CardContent>
        </Card>
    </div>
    <Card class="col-span-1 mb-4 md:col-span-5">
        <CardHeader>
            <CardTitle> Overview </CardTitle>
        </CardHeader>
        <CardContent>
            <div class="mt-8">
                <BarChart
                    index="name"
                    :data="monthlyRevenue"
                    :categories="['profit', 'tax']"
                    :y-formatter="
                        (tick, i) => {
                            return typeof tick === 'number'
                                ? `€${new Intl.NumberFormat('nl').format(tick).toString()}`
                                : '';
                        }
                    "
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
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { BarChart } from "@/components/ui/chart-bar";
import FakeTable from "@/Pages/Partials/Containers/FakeTable.vue";
import { defineProps } from "vue";
import { columns } from "../../../../ts/columns";

interface Props {
    logs: object;
    monthlyRevenue: Record<string, any>[];
    accumulatedRevenue: object;
    hoursWorked: object;
    freelanceWage: object;
    daysLeft: number;
}

defineProps<Props>();

const tableData = [
    {
        hours: 16,
        rate: 60,
        company: "Friva",
    },
    {
        hours: 8,
        rate: 60,
        company: "Friva",
    },
    {
        hours: 4,
        rate: 60,
        company: "Friva",
    },
    {
        hours: 7,
        rate: 60,
        company: "Friva",
    },
    {
        hours: 2,
        rate: 60,
        company: "Friva",
    },
];

function getCurrency(value) {
    const formatter = new Intl.NumberFormat("nl-NL", {
        style: "currency",
        currency: "EUR",
        minimumFractionDigits: 0,
    });

    return formatter.format(<number>value);
}
</script>
