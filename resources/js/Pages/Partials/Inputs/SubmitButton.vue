<template>
    <button type="submit" :disabled="formProcessing" class="input-submit">
        <slot />
    </button>
</template>
<script setup lang="ts">
import { defineProps } from 'vue';

interface Props {
    formProcessing: boolean;
}

const props = defineProps<Props>();
</script>
<style scoped>
.input-submit {
    @apply w-full rounded-lg border border-gray-300 bg-slate-800 py-3 text-sm text-slate-50 hover:bg-slate-900 hover:text-slate-200;
}
</style>
