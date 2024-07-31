<template>
    <div class="container">
        <p v-if="logoToRoute" class="logo">
            <Link :href="logoToRoute">PIXELWARE<span class="text-red-600">.</span></Link>
        </p>
        <p v-else class="logo">
            PIXELWARE<span class="text-red-600">.</span>
        </p>
        <h1 class="header-title">{{ formTitle }}</h1>
        <slot />
    </div>
</template>
<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {defineProps} from "vue";

interface Props {
    formTitle: string,
    logoToRoute?: string,
}

const props = defineProps<Props>();
</script>
<style scoped>
.container {
    @apply w-1/3 px-8 pt-12 pb-8 rounded-lg shadow-xl bg-white
}

.logo {
    @apply text-5xl text-center font-black mb-2 select-none
}

.header-title {
    @apply font-medium text-xl uppercase mb-8 text-center mb-8
}
</style>
