<template>
    <label :for="id" class="input-label">{{ label }}</label>
</template>
<script setup lang="ts">
import { defineProps } from 'vue';

interface Props {
    id: string;
    label: string;
}

defineProps<Props>();
</script>
<style scoped>
.input-label {
    @apply mb-2 block text-sm font-medium text-gray-900;
}
</style>
