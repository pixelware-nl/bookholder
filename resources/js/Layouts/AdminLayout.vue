<template>
    <nav>
        <ul class="flex justify-end p-6 bg-slate-100">
            <li class="px-4 font-bold hover:cursor-pointer"> Invoicing </li>
            <li class="px-4 text-slate-400 hover:cursor-not-allowed"> Logging </li>
            <li class="px-4 text-slate-400 hover:cursor-not-allowed"> Companies </li>
            <li class="px-4 text-slate-400 hover:cursor-not-allowed"> Login/Logout </li>
        </ul>
    </nav>
    <main class="w-full flex justify-center mt-12">
        <div class="container w-3/5">
            <slot />
        </div>
    </main>
</template>
<script setup lang="ts">

</script>
