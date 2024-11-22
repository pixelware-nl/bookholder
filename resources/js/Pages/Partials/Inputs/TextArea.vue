<template>
    <LabelField :id="id" :label="label" />
    <textarea
        rows="5"
        :id="id"
        :name="name"
        :class="{'input-field-error': error}"
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
import {defineProps, onMounted} from "vue";
import LabelField from "./LabelField.vue";
import ErrorField from "./ErrorField.vue";
import BaseInput from "./BaseInput.vue";

interface Props {
    modelValue?: string,
    id: string,
    name: string,
    label: string,
    placeholder?: string,
    error?: string,
    disabled?: boolean,
}

const props = defineProps<Props>();
</script>
<style scoped>
.input-field-error {
    @apply !border-red-600
}

.input {
    @apply border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:text-gray-500 disabled:select-none
}
</style>
