<template>
    <h1 class="header"> Portfolio title </h1>
    <p class="subheader">
        A subheading with a brief description of you, your<br>
        work, and what you’re all about—no biggie
    </p>
    <section class="portfolio-container">
        <PortfolioCard
            title="Project title"
            description="Description of your first project"
        />
        <PortfolioCard
            title="Project title"
            description="Description of your first project"
        />
        <PortfolioCard
            title="Project title"
            description="Description of your first project"
        />
        <PortfolioCard
            title="Project title"
            description="Description of your first project"
        />
    </section>
</template>
<script setup lang="ts">
    import PortfolioCard from "./PortfolioCard.vue";
</script>
<style scoped>
    .header {
        @apply mt-24 text-4xl font-bold
    }

    .subheader {
        @apply mt-6 text-gray-400
    }

    .portfolio-container {
        @apply mt-10 grid grid-cols-2 grid-rows-2 gap-12
    }
</style>
