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
        <option :value="null" selected>Choose an option</option>
        <option v-for="option in options" :value="option.id">
            {{ option.name }}
        </option>
    </select>
    <ErrorField :error="error" />
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import LabelField from "./LabelField.vue";
import ErrorField from "./ErrorField.vue";
import BaseInput from "./BaseInput.vue";

interface Props {
    modelValue: object,
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
