<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :class="{ 'input-field-error': error }"
        class="input"
    />
</template>
<script setup lang="ts">
import { defineProps } from "vue";

interface Props {
    modelValue?: object | string | number;
    error?: string;
}

defineProps<Props>();
</script>
<style scoped>
.input-field-error {
    @apply !border-red-600;
}

.input {
    @apply block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 disabled:select-none disabled:text-gray-500;
}
</style>
