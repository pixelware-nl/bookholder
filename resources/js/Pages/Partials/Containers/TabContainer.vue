<template>
    <div class="flex">
        <div
            v-for="(tab, index) in tabs"
            :key="tab"
            @click="toggleTab(tab)"
            :class="{
                'active-tab': modelValue === tab,
                'inactive-tab': modelValue !== tab,
                '-ms-1': index !== 0,
            }"
        >
            {{ tab }}
        </div>
    </div>
</template>
<script setup lang="ts">
import { defineEmits, defineProps } from 'vue';

interface Props {
    tabs: string[];
    modelValue: string;
}

defineProps<Props>();
const emit = defineEmits(['update:modelValue']);

const toggleTab = (tab: string) => {
    emit('update:modelValue', tab);
};
</script>
<style scoped>
.active-tab {
    @apply z-10 -mb-1 rounded-tl-2xl rounded-tr-2xl bg-white px-6 pb-3 pt-2;
}

.inactive-tab {
    @apply z-0 rounded-tl-2xl rounded-tr-2xl bg-slate-300 px-6 py-2 text-slate-800;
}
</style>
