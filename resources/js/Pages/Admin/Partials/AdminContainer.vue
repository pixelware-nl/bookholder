<template>
    <Card class="container w-full max-w-full">
        <CardHeader>
            <div class="mb-8 flex items-center justify-between">
                <h1 class="header-title">{{ formTitle }}</h1>
                <Link
                    v-if="routeName != null"
                    :href="routeName"
                    class="select-none pr-8 font-bold text-blue-600 hover:text-blue-900"
                >
                    <FontIcon icon="fa-backspace" :size="iconSize.large" />
                </Link>
            </div>
        </CardHeader>
        <CardContent>
            <slot />
        </CardContent>
    </Card>
</template>
<script setup lang="ts">
import { Card, CardContent, CardHeader } from "@/components/ui/card";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { iconSize } from "../../../../ts/icon-size";
import FontIcon from "../../Partials/Externals/FontIcon.vue";

interface Props {
    formTitle: string;
    routeName?: string;
}

defineProps<Props>();
</script>
<style scoped>
::-webkit-scrollbar-thumb {
    background-color: #d6dee1;
    border-radius: 20px;
    border: 6px solid transparent;
    background-clip: content-box;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #a8bbbf;
}

::-webkit-scrollbar-track {
    background-color: transparent;
}

::-webkit-scrollbar {
    width: 20px;
}

.container {
    @apply max-h-[85vh] overflow-auto rounded-lg bg-white px-8 pb-8 pt-12 sm:w-full;
}

.header-title {
    @apply text-left text-3xl font-black uppercase;
}
</style>
