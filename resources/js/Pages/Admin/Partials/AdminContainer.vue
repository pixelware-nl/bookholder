<template>
    <div class="container">
        <h1 class="header-title">{{ formTitle }}</h1>
        <slot />
    </div>
</template>
<script setup lang="ts">
import {defineProps} from "vue";

interface Props {
    formTitle: string,
}

const props = defineProps<Props>();
</script>
<style scoped>
.container {
    @apply sm:w-full px-8 pt-12 pb-8 rounded-lg sm:shadow-xl bg-white
}

.header-title {
    @apply font-black uppercase text-3xl mb-8 text-left mb-8
}
</style>
