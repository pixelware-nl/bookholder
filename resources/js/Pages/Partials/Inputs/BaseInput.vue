<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :class="{'input-field-error': error}"
        class="input"
    />
</template>
<script setup lang="ts">
import {defineProps} from "vue";

interface Props {
    modelValue?: object|string|number,
    error?: string,
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
