<template>
    <div class="container">
        <div class="flex mb-8 items-center justify-between">
            <h1 class="header-title">{{ formTitle }}</h1>
            <Link v-if="routeName != null" :href="routeName" class="font-bold pr-8 text-blue-600 hover:text-blue-900 select-none"> Return </Link>
        </div>
        <slot />
    </div>
</template>
<script setup lang="ts">
import {defineProps, onMounted} from "vue";
import { Link } from '@inertiajs/vue3'

interface Props {
    formTitle: string,
    routeName?: string,
}

const props = defineProps<Props>();

onMounted(() => {
    console.log(props.routeName);
})
</script>
<style scoped>
.container {
    @apply sm:w-full px-8 pt-12 pb-8 rounded-lg sm:shadow-xl bg-white
}

.header-title {
    @apply font-black uppercase text-3xl text-left
}
</style>
