<template>
    <LabelField :id="id" :label="label" />
    <textarea
        rows="5"
        :id="id"
        :name="name"
        :class="{ 'input-field-error': error }"
        class="input"
        :placeholder="placeholder"
        :disabled="disabled"
        :aria-disabled="disabled"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import { defineProps } from "vue";
import ErrorField from "./ErrorField.vue";
import LabelField from "./LabelField.vue";

interface Props {
    modelValue?: string;
    id: string;
    name: string;
    label: string;
    placeholder?: string;
    error?: string;
    disabled?: boolean;
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
