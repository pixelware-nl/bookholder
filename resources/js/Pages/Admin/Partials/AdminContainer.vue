<template>
    <Card class="container col-span-12">
        <CardHeader>
            <div class="flex mb-8 items-center justify-between">
                <h1 class="header-title">{{ formTitle }}</h1>
                <Link v-if="routeName != null" :href="routeName" class="font-bold pr-8 text-blue-600 hover:text-blue-900 select-none">
                    <FontIcon
                        icon="fa-backspace"
                        :size="iconSize.large"
                    />
                </Link>
            </div>
        </CardHeader>
        <CardContent>
            <slot />
        </CardContent>
    </Card>
</template>
<script setup lang="ts">
import {Card, CardContent, CardHeader} from "@/components/ui/card";
import {defineProps} from "vue";
import { Link } from '@inertiajs/vue3';
import FontIcon from "../../Partials/Externals/FontIcon.vue";
import {iconSize} from "../../../../ts/icon-size";

interface Props {
    formTitle: string,
    routeName?: string,
}

const props = defineProps<Props>();
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
    @apply sm:w-full px-8 pt-12 pb-8 rounded-lg bg-white max-h-[85vh] overflow-auto
}

.header-title {
    @apply font-black uppercase text-3xl text-left
}
</style>
