<template>
    <Tabs default-value="pending">
        <TabsList>
            <TabsTrigger value="pending">
                {{ $t("vue.components.tabs.pending") }}
            </TabsTrigger>
            <TabsTrigger value="payed">
                {{ $t("vue.components.tabs.payed") }}
            </TabsTrigger>
        </TabsList>
        <TabsContent value="pending">
            <AdminContainer :form-title="$t('log.index.title')">
                <Link
                    :href="route('logs.create')"
                    method="get"
                    class="link-button"
                >
                    {{ $t("log.index.add_log") }}
                </Link>
                <LogTable :logs="logs" :payed="false" />
            </AdminContainer>
        </TabsContent>
        <TabsContent value="payed">
            <AdminContainer :form-title="$t('log.index.title')">
                <Link
                    :href="route('logs.create')"
                    method="get"
                    class="link-button"
                >
                    {{ $t("log.index.add_log") }}
                </Link>
                <LogTable :logs="logs" :payed="true" />
            </AdminContainer>
        </TabsContent>
    </Tabs>
</template>
<script setup lang="ts">
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import LogTable from "@/Pages/Partials/Tables/LogTable.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    logs: object;
}

defineProps<Props>();
</script>
<style scoped>
.link-button {
    @apply mb-4 inline-block rounded-lg bg-black px-5 py-3 text-white hover:bg-gray-800 hover:text-slate-200;
}
</style>
