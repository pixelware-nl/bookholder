<template>
    <SidebarProvider>
        <AdminSidebar
            :user="user"
        />
        <SidebarInset>
            <slot />
        </SidebarInset>
    </SidebarProvider>
</template>
<script setup lang="ts">
import {SidebarInset, SidebarProvider} from "@/registry/new-york/ui/sidebar";
import AdminSidebar from "@/Pages/Partials/Containers/AdminSidebar.vue";
import {usePage} from "@inertiajs/vue3";
import {computed, onMounted} from "vue";



onMounted(() => {
    console.log(user.value);
})
</script>
