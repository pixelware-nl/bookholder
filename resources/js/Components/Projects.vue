<template>
    <h1 class="mt-24 text-4xl font-bold"> Portfolio title </h1>
    <p class="mt-6 text-gray-400">
        A subheading with a brief description of you, your<br>
        work, and what you’re all about—no biggie
    </p>
    <section class="mt-10 grid grid-cols-2 grid-rows-2 gap-12">
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
