<template>
    <LabelField :id="id" :label="label" />
    <BaseInput
        :id="id"
        type="password"
        :name="name"
        :class="{ 'input-field-error': error }"
        class="input"
        :placeholder="placeholder"
        :model-value="modelValue"
        @update:modelValue="(value) => $emit('update:modelValue', value)"
    />
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import { defineProps } from 'vue';
import BaseInput from './BaseInput.vue';
import ErrorField from './ErrorField.vue';
import LabelField from './LabelField.vue';

interface Props {
    modelValue?: string;
    id: string;
    name: string;
    label: string;
    placeholder?: string;
    error?: string;
}

defineProps<Props>();
</script>
<style scoped>
.input {
    @apply block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500;
}

.input-field-error {
    @apply !border-red-600;
}
</style>
