<template>
    <Tabs default-value="pending" class="col-span-12">
        <TabsList>
            <TabsTrigger value="pending">
                {{ $t('vue.components.tabs.pending') }}
            </TabsTrigger>
            <TabsTrigger value="payed">
                {{ $t('vue.components.tabs.payed') }}
            </TabsTrigger>
        </TabsList>
        <TabsContent value="pending">
            <AdminContainer :form-title="$t('log.index.title')">
                <Link :href="route('logs.create')" method="get" class="link-button"> {{ $t('log.index.add_log') }} </Link>
                <LogTable
                    :logs="logs"
                    :payed="false"
                />
            </AdminContainer>
        </TabsContent>
        <TabsContent value="payed">
            <AdminContainer :form-title="$t('log.index.title')">
                <Link :href="route('logs.create')" method="get" class="link-button"> {{ $t('log.index.add_log') }} </Link>
                <LogTable
                    :logs="logs"
                    :payed="true"
                />
            </AdminContainer>
        </TabsContent>
    </Tabs>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import { Link } from '@inertiajs/vue3'
import AdminContainer from "../Partials/AdminContainer.vue";
import {Tabs, TabsContent, TabsList, TabsTrigger} from "@/components/ui/tabs";
import LogTable from "@/Pages/Partials/Tables/LogTable.vue";

interface Props {
    logs: object,
}

const props = defineProps<Props>();
</script>
<style scoped>
.link-button {
    @apply inline-block bg-black text-white py-3 px-5 rounded-lg hover:bg-gray-800 hover:text-slate-200 mb-4
}
</style>
