<template>
    <div class="my-4" @click="viewDetails()">
        <div class="bg-red-600 h-[16rem] rounded-md shadow-lg"> </div>
        <h1 class="mt-4 text-xl"> {{ title }} </h1>
        <p class="mt-2 text-gray-400"> {{ description }} </p>
    </div>
</template>
<script setup lang="ts">
    interface Props {
        title: string,
        description: string,
    }

    const props = defineProps<Props>();

    function viewDetails() {
        // @TODO add functionality here.
        console.log("Go to details page for " + props.title + ".")
    }
</script>
