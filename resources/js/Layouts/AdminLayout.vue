<template>
    <div class="min-h-screen sm:bg-slate-100 xs:bg-white">
        <nav class="flex p-6 bg-slate-900 text-slate-100">
            <p class="font-black"> Pixelware<span class="text-red-600">.</span> </p>
            <ul class="flex justify-end w-full">
                <NavLink slug="dashboard" route-name="dashboard.index"> {{ $t('layout.admin.dashboard') }} </NavLink>
                <NavLink slug="invoices" route-name="invoices.index"> {{ $t('layout.admin.invoices') }} </NavLink>
                <NavLink slug="logs" route-name="logs.index"> {{ $t('layout.admin.logs') }} </NavLink>
                <NavLink slug="companies" route-name="companies.index"> {{ $t('layout.admin.companies') }} </NavLink>
                <NavLink slug="logout" route-name="logout" method="post"> {{ $t('layout.admin.logout') }} </NavLink>
            </ul>
        </nav>
        <main class="w-full flex justify-center pt-12">
            <div class="container px-4 w-full">
                <slot />
            </div>
        </main>
    </div>
</template>
<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";
import NavLink from "./Partials/NavLink.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>
