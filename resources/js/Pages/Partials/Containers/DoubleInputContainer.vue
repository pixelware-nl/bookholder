<template>
    <div class="input-two-inbetween">
        <slot />
    </div>
</template>
<style scoped>
.input-two-inbetween {
    @apply w-[47.5%]
}

.input-two-inbetween:last-child {
    margin-left: 5%;
}
</style>
