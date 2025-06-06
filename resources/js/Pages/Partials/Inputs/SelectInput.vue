<template>
    <LabelField :id="id" :label="label" />
    <select
        id="companies"
        name="company_id"
        :value="modelValue"
        :class="{ 'input-field-error': error }"
        class="input-select"
        :disabled="disabled"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option value="" selected>Kies een optie</option>
        <option v-for="option in options" :value="option.id">
            {{ option.name }}
        </option>
    </select>
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import { defineProps } from 'vue';
import ErrorField from './ErrorField.vue';
import LabelField from './LabelField.vue';

interface Props {
    modelValue?: string | number;
    options: object;
    id: string;
    name: string;
    label: string;
    placeholder?: string;
    error?: string;
    disabled?: boolean;
}

const props = defineProps<Props>();
</script>
<style scoped>
.input-field-error {
    @apply !border-red-600;
}

.input-select {
    @apply block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 disabled:select-none disabled:text-gray-500;
}
</style>
