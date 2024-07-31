<template>
    <button type="submit" :disabled="formProcessing" class="input-submit">
        <slot />
    </button>
</template>
<script setup lang="ts">
import {defineProps} from "vue";

interface Props {
    formProcessing: boolean,
}

const props = defineProps<Props>();
</script>
<style scoped>
.input-submit {
    @apply border bg-slate-800 border-gray-300 text-slate-50 text-sm rounded-lg py-3 w-full hover:bg-slate-900 hover:text-slate-200
}
</style>
