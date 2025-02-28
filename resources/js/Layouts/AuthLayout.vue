<template>
    <!-- sm:bg-neutral-100 bg-white -->
    <main class="sm:bg-[url('./../gfx/bg-city.jpg')] sm:bg-cover sm:bg-center bg-white backdrop-blur-sm w-full sm:flex sm:justify-center min-h-screen">
        <div class="absolute inset-0 sm:bg-black sm:bg-opacity-20 backdrop-blur-sm -z-10"></div>
        <div class="container md:w-4/5 flex flex-wrap justify-center items-center py-8">
            <slot />
        </div>
    </main>
</template>
