<template>
    <div class="gradient-background md:gradient-background min-h-screen w-full">
        <nav class="flex border-b-2 bg-neutral-50 p-6 text-neutral-900">
            <p class="font-black">
                Pixelware<span class="text-red-600">.</span>
            </p>
            <ul class="flex w-full justify-end">
                <NavLink slug="dashboard" route-name="dashboard.index">
                    {{ $t("layout.admin.dashboard") }}
                </NavLink>
                <NavLink slug="invoices" route-name="invoices.index">
                    {{ $t("layout.admin.invoices") }}
                </NavLink>
                <NavLink slug="logs" route-name="logs.index">
                    {{ $t("layout.admin.logs") }}
                </NavLink>
                <NavLink slug="companies" route-name="companies.index">
                    {{ $t("layout.admin.companies") }}
                </NavLink>
                <NavLink slug="logout" route-name="logout" method="post">
                    {{ $t("layout.admin.logout") }}
                </NavLink>
            </ul>
        </nav>
        <div class="mt-12 flex items-center justify-center pb-12">
            <div class="w-full px-4">
                <slot />
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import NavLink from "@/Layouts/Partials/NavLink.vue";
</script>
<style scoped>
.gradient-background {
    @apply bg-neutral-50;
}
</style>
