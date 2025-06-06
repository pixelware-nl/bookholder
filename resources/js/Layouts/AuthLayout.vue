<template>
    <!-- sm:bg-neutral-100 bg-white -->
    <main
        class="min-h-screen w-full bg-white backdrop-blur-sm sm:flex sm:justify-center sm:bg-[url('./../gfx/bg-city.jpg')] sm:bg-cover sm:bg-center"
    >
        <div class="absolute inset-0 -z-10 backdrop-blur-sm sm:bg-black sm:bg-opacity-20"></div>
        <div class="container flex flex-wrap items-center justify-center py-8 md:w-4/5">
            <slot />
        </div>
    </main>
</template>
