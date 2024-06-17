<template>
    <nav class="w-100">
        <span class="flex w-3/4 float-left font-bold"> {{ company }} </span>
        <ul class="flex w-1/4 justify-between">
            <li> <a href="#project"> Projects </a> </li>
            <li> <a href="#about"> About </a> </li>
            <li> <a href="#contact"> Contact </a> </li>
        </ul>
    </nav>
</template>
<script setup lang="ts">
    interface Props {
        company: string
    }

    const props = defineProps<Props>();
</script>
