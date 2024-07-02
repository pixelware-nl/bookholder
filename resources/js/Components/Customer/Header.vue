<template>
    <div class="w-100 h-screen bg-black flex flex-col items-center text-center align-center justify-center">
        <h1 class="text-9xl text-white font-black uppercase">{{ company }}</h1>
        <p class="text-lg text-white font-bold">{{ slogan }}</p>
    </div>
</template>
<script setup lang="ts">
    interface Props {
        company: string,
        slogan: string,
    }

    const props = defineProps<Props>();
</script>
