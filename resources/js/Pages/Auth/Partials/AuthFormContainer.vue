<template>
    <div class="container">
        <p v-if="logoToRoute" class="logo">
            <Link :href="logoToRoute">PIXELWARE<span class="text-red-600">.</span></Link>
        </p>
        <p v-else class="logo">PIXELWARE<span class="text-red-600">.</span></p>
        <h1 class="header-title">{{ formTitle }}</h1>
        <slot />
    </div>
</template>
<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

interface Props {
    formTitle: string;
    logoToRoute?: string;
}

const props = defineProps<Props>();
</script>
<style scoped>
.container {
    @apply rounded-lg bg-white px-8 pb-8 pt-12 sm:w-full sm:shadow-xl md:w-2/3 lg:w-2/3 xl:w-1/3;
}

.logo {
    @apply mb-2 select-none text-center text-4xl font-black sm:text-5xl;
}

.header-title {
    @apply mb-8 text-center text-xl font-medium uppercase;
}
</style>
