<template>
    <LabelField :id="id" :label="label" />
    <BaseInput
        :id="id"
        type="password"
        :name="name"
        :class="{'input-field-error': error}"
        class="input"
        :placeholder="placeholder"

        :model-value="modelValue"
        @update:modelValue="(value) => $emit('update:modelValue', value)"
    />
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import LabelField from "./LabelField.vue";
import ErrorField from "./ErrorField.vue";
import BaseInput from "./BaseInput.vue";

interface Props {
    modelValue: object,
    id: string,
    name: string,
    label: string,
    placeholder?: string,
    error?: string,
}

const props = defineProps<Props>();
</script>
<style scoped>
.input {
    @apply border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
}

.input-field-error {
    @apply !border-red-600
}
</style>
