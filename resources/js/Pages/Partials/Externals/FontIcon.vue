<template>
    <font-awesome-icon
        :icon="jointIconString"
        class="text-slate-600 hover:text-slate-800"
        :class="sizeClass"
    />
</template>
<script setup lang="ts">
import { computed, defineProps, ref } from "vue";
import { iconSize } from "../../../../ts/icon-size";

interface Props {
    icon: string;
    size?: iconSize;
}

const props = defineProps<Props>();

const array = ref(["fa-solid", props.icon]);

const jointIconString = computed(() => {
    return array.value.join(" ");
});

const sizeClass = computed(() => {
    return props.size ?? iconSize.small;
});
</script>
