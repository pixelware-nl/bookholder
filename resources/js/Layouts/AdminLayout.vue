<template>
    <nav>
        <ul class="flex justify-end p-6 bg-slate-900 text-slate-100">
            <li class="px-4 font-bold hover:cursor-pointer"> <Link :href="route('invoices.index')" method="get"> Invoicing </Link> </li>
            <li class="px-4 text-slate-500 hover:cursor-not-allowed"> Logging </li>
            <li class="px-4 text-slate-100 hover:cursor-pointer hover:text-white hover:underline"> <Link :href="route('companies.index')"> Companies </Link> </li>
            <li class="px-4 text-slate-100 hover:cursor-pointer hover:text-white hover:underline"> <Link :href="route('logout')" method="post"> Logout </Link> </li>
        </ul>
    </nav>
    <main class="w-full flex justify-center pt-12 bg-slate-100 min-h-screen">
        <div class="container w-full">
            <slot />
        </div>
    </main>
</template>
<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const page = usePage();

const user = computed(() => page.props.auth.user)
</script>
