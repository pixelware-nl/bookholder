<template>
    <LabelField :id="id" :label="label" />
    <select
        id="companies"
        name="company_id"
        :value="modelValue"
        :class="{'input-field-error': error}"
        class="input-select"

        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option value="" selected>Choose an option</option>
        <option v-for="option in options" :value="option.id">
            {{ option.name }}
        </option>
    </select>
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import {defineProps, onMounted} from "vue";
import LabelField from "./LabelField.vue";
import ErrorField from "./ErrorField.vue";

interface Props {
    modelValue?: string|number,
    options: object,
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

.input-select {
    @apply border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:text-gray-500 disabled:select-none
}
</style>
