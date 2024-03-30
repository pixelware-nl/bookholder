<template>
    <h1 class="text-xs"> Hello world </h1>
</template>
<script setup>
    import {onMounted} from "vue";

    onMounted(() => {
        console.log("Hello World!");
    });
</script>
