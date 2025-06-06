<template>
    <p class="input-error">{{ error }}</p>
</template>
<script setup lang="ts">
import { defineProps } from 'vue';

interface Props {
    error?: string;
}

defineProps<Props>();
</script>
<style scoped>
.input-error {
    @apply mt-2 text-sm text-red-600;
}
</style>
