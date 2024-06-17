<template>
    <div class="w-100 bg-white px-48 py-12">
        <span class="flex w-3/4 float-left"> {{ company }} &copy; 2024, All rights reserved. </span>
        <ul class="flex w-1/4 justify-between">
            <li> Linkedin </li>
            <li> Youtube </li>
            <li> Instagram </li>
        </ul>
    </div>
</template>
<script setup lang="ts">
    interface Props {
        company: string,
    }

    const props = defineProps<Props>();
</script>
