<template>
    <p class="input-error"> {{ error }} </p>
</template>
<script setup lang="ts">
import {defineProps} from "vue";

interface Props {
    error?: string,
}

const props = defineProps<Props>();
</script>
<style scoped>
.input-error {
    @apply text-red-600 text-sm mt-2
}
</style>
