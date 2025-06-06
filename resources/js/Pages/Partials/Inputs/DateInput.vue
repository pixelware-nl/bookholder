<template>
    <LabelField :id="id" :label="label" />
    <BaseInput
        :id="id"
        type="date"
        :name="name"
        :class="{ 'input-field-error': error }"
        class="input"
        :placeholder="placeholder"
        :disabled="disabled"
        :aria-disabled="disabled"
        :model-value="modelValue"
        @update:modelValue="(value) => $emit('update:modelValue', value)"
    />
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import { defineProps } from "vue";
import BaseInput from "./BaseInput.vue";
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
