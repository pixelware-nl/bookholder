<script setup lang="ts">
import type { HTMLAttributes } from "vue";
import { cn } from "@/lib/utils";

const props = defineProps<{
    class?: HTMLAttributes["class"];
}>();
</script>

<template>
    <div
        class="mx-2 md:mx-0 md:border"
        :class="
            cn(
                'rounded-xl border bg-card text-card-foreground shadow',
                props.class,
            )
        "
    >
        <slot />
    </div>
</template>
