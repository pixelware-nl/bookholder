<template>
    <div class="flex ms-8">
        <div
            v-for="(tab, index) in tabs"
            :key="tab"
            @click="toggleTab(tab)"
            :class="{
                'active-tab': modelValue === tab,
                'inactive-tab': modelValue !== tab,
                '-ms-1': index !== 0
            }"
        >
            {{ tab }}
        </div>
    </div>
</template>
<script setup lang="ts">

import {defineProps, defineEmits} from "vue";

interface Props {
    tabs: string[],
    modelValue: string,
}

const props = defineProps<Props>();
const emit = defineEmits(['update:modelValue']);

const toggleTab = (tab: string) => {
    emit('update:modelValue', tab);
}

</script>
<style scoped>
.active-tab {
    @apply bg-white -mb-1 pt-2 pb-3 px-6 rounded-tl-2xl rounded-tr-2xl z-10
}

.inactive-tab {
    @apply bg-slate-300 text-slate-800 py-2 px-6 rounded-tl-2xl rounded-tr-2xl z-0
}
</style>
