<template>
    <TableContainer>
        <template #thead>
            <tr>
                <th>{{ $t("log.index.company") }}</th>
                <th>{{ $t("log.index.rate") }}</th>
                <th>{{ $t("log.index.hours") }}</th>
                <th>{{ $t("log.index.name") }}</th>
                <th class="w-[50px]"></th>
                <th class="w-[50px]"></th>
                <th class="w-[50px]"></th>
            </tr>
        </template>
        <template #tbody v-if="filteredLogs.length > 0">
            <tr
                v-for="log in filteredLogs"
                :class="{ payed: log.payed }"
                v-bind:key="log.id"
            >
                <td>{{ log.company_name }}</td>
                <td>{{ log.rate }}</td>
                <td>
                    {{ log.hours.toString().padStart(2, "0") }}:{{
                        log.minutes.toString().padStart(2, "0")
                    }}
                </td>
                <td>{{ log.name }}</td>
                <td class="table-item table-item-link">
                    <Link :href="route('logs.show', log.id)">
                        <FontAwesomeIcon icon="fa-solid fa-eye" />
                    </Link>
                </td>
                <td class="table-item table-item-link">
                    <Link
                        v-if="log.payed == false"
                        :href="route('logs.edit', log.id)"
                    >
                        <FontAwesomeIcon icon="fa-solid fa-pen-to-square" />
                    </Link>
                </td>
                <td class="table-item table-item-link">
                    <Link :href="route('logs.destroy', log.id)" method="delete">
                        <FontAwesomeIcon icon="fa-solid fa-trash" />
                    </Link>
                </td>
            </tr>
            <tr :class="{ payed: payed }">
                <td class="font-bold">Total</td>
                <td class="font-bold">{{ sumTotalMoneyAsCurrency }}</td>
                <td class="font-bold">{{ sumTotalHours }}</td>
                <td colspan="4"></td>
            </tr>
        </template>
        <template #tbody v-else>
            <td colspan="7" class="text-center !text-gray-400">
                {{ $t("log.index.no_entries") }}
            </td>
        </template>
    </TableContainer>
</template>
<script setup lang="ts">
import TableContainer from "@/Pages/Partials/Tables/TableContainer.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { Link } from "@inertiajs/vue3";
import { computed, defineProps } from "vue";

interface Props {
    logs: object;
    payed: boolean;
}

const props = defineProps<Props>();

const filteredLogs = computed(() => {
    return props.logs.data.filter((logs: any) => {
        return props.payed ? logs.payed == true : logs.payed == false;
    });
});

const sumTotalHours = computed(() => {
    return filteredLogs.value.reduce((total, log) => {
        return total + log.hours;
    }, 0);
});

const sumTotalMoneyAsCurrency = computed(() => {
    return getCurrency(
        filteredLogs.value.reduce((total, log) => {
            return total + log.rate * log.hours;
        }, 0),
    );
});

function getCurrency(value) {
    const formatter = new Intl.NumberFormat("nl-NL", {
        style: "currency",
        currency: "EUR",
        minimumFractionDigits: 0,
    });

    return formatter.format(<number>value);
}
</script>
