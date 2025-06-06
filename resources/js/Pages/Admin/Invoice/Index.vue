<template>
    <Tabs default-value="pending" class="col-span-12">
        <TabsList>
            <TabsTrigger value="pending">
                {{ $t("vue.components.tabs.pending") }}
            </TabsTrigger>
            <TabsTrigger value="payed">
                {{ $t("vue.components.tabs.payed") }}
            </TabsTrigger>
        </TabsList>
        <TabsContent value="pending">
            <AdminContainer :form-title="$t('invoice.index.title')">
                <Link
                    :href="route('invoices.create')"
                    method="get"
                    class="link-button"
                >
                    {{ $t("invoice.index.add_invoice") }}
                </Link>
                <InvoiceTable :invoices="invoices" :payed="false" />
            </AdminContainer>
        </TabsContent>
        <TabsContent value="payed">
            <AdminContainer :form-title="$t('invoice.index.title')">
                <Link
                    :href="route('invoices.create')"
                    method="get"
                    class="link-button"
                >
                    {{ $t("invoice.index.add_invoice") }}
                </Link>
                <InvoiceTable :invoices="invoices" :payed="true" />
            </AdminContainer>
        </TabsContent>
    </Tabs>
</template>
<script setup lang="ts">
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import InvoiceTable from "@/Pages/Partials/Tables/InvoiceTable.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    invoices: object;
    currentTab: string;
}

defineProps<Props>();
</script>
<style scoped>
.link-button {
    @apply mb-4 inline-block rounded-lg bg-black px-5 py-3 text-white hover:bg-gray-800 hover:text-slate-200;
}
</style>
