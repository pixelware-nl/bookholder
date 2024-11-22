<template>
    <div class="min-h-screen sm:bg-slate-100 xs:bg-white">
        <nav>
            <ul class="flex justify-end p-6 bg-slate-900 text-slate-100">
                <NavLink slug="dashboard" route-name="dashboard.index"> Dashboard </NavLink>
                <NavLink slug="invoices" route-name="invoices.index"> Invoicing </NavLink>
                <li class="px-4 text-slate-500 hover:cursor-not-allowed"> Logging </li>
                <NavLink slug="companies" route-name="companies.index"> Companies </NavLink>
                <NavLink slug="logout" route-name="logout" method="post"> Logout </NavLink>
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
