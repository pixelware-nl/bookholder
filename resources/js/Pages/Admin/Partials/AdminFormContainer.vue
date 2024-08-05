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
    @apply sm:w-full md:w-2/3 lg:w-2/3 xl:w-1/3 px-8 pt-12 pb-8 rounded-lg sm:shadow-xl bg-white
}

.header-title {
    @apply font-medium text-xl mb-8 text-center mb-8
}
</style>
