<template>
    <nav>

        <ul class="flex justify-end p-6 bg-slate-100">
            <li class="px-4 font-bold hover:cursor-pointer"> <Link :href="route('invoice.index')" method="get"> Invoicing </Link> </li>
            <li class="px-4 text-slate-400 hover:cursor-not-allowed"> Logging </li>
            <li class="px-4 text-slate-400 hover:cursor-not-allowed"> Companies </li>
            <li class="px-4 text-slate-950 hover:cursor-pointer"> <Link :href="route('logout')" method="post"> Logout </Link> </li>
        </ul>
    </nav>
    <main class="w-full flex justify-center mt-12">
        <div class="container w-3/5">
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
