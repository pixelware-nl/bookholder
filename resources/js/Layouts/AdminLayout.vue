<template>
    <div class="bg-muted/50 min-h-screen w-full">
        <nav class="flex p-6 bg-white text-neutral-900 border-b-2">
            <p class="font-black"> Pixelware<span class="text-red-600">.</span> </p>
            <ul class="flex justify-end w-full">
                <NavLink slug="dashboard" route-name="dashboard.index"> {{ $t('layout.admin.dashboard') }} </NavLink>
                <NavLink slug="invoices" route-name="invoices.index"> {{ $t('layout.admin.invoices') }} </NavLink>
                <NavLink slug="logs" route-name="logs.index"> {{ $t('layout.admin.logs') }} </NavLink>
                <NavLink slug="companies" route-name="companies.index"> {{ $t('layout.admin.companies') }} </NavLink>
                <NavLink slug="logout" route-name="logout" method="post"> {{ $t('layout.admin.logout') }} </NavLink>
            </ul>
        </nav>
        <slot />
    </div>
</template>
<script setup lang="ts">
import NavLink from "@/Layouts/Partials/NavLink.vue";
</script>
