<template>
    <label :for="id" class="input-label">{{label}}</label>
</template>
<script setup lang="ts">
import {defineProps} from "vue";

interface Props {
    id: string,
    label: string,
}

const props = defineProps<Props>();
</script>
<style scoped>
.input-label {
    @apply block mb-2 text-sm font-medium text-gray-900
}
</style>
