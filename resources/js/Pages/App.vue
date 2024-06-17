<template>
    <MainSection
        id="project"
    >
        <Navigation
            :company="company"
        />
        <Projects />
    </MainSection>
    <hr class="w-3/4 mx-auto bg-gray-400">
    <MainSection
        id="about"
        class="flex flex-row"
    >
        <SectionImage class="pr-36" />
        <About />
    </MainSection>
    <hr class="w-3/4 mx-auto bg-gray-400">
    <MainSection
        id="contact"
        class="flex flex-row"
    >
        <Contact />
        <SectionImage class="pl-36" />
    </MainSection>
</template>
<script setup lang="ts">
    import {onMounted, defineProps} from "vue";
    import MainSection from "../Components/MainSection.vue";
    import Navigation from "../Components/Navigation.vue";
    import SectionImage from "../Components/SectionImage.vue";
    import About from "../Components/About.vue";
    import Contact from "../Components/Contact.vue";
    import Projects from "../Components/Projects.vue";

    interface Props {
        company: string,
    };

    const props = defineProps<Props>();

    onMounted(() => {
    });
</script>
