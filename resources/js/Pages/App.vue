<template>
    <header class="w-100 h-screen bg-black flex flex-col items-center text-center align-center justify-center">
        <h1 class="text-9xl text-white font-black"> PIXELWARE </h1>
        <p class="text-lg text-white font-bold"> A freelance development and design agency. </p>
    </header>
    <main>
        <section class="w-100 bg-white px-48 py-12">
            <nav class="w-100">
                <span class="flex w-3/4 float-left"> PIXELWARE </span>
                <ul class="flex w-1/4 justify-between">
                    <li> Projects </li>
                    <li> About </li>
                    <li> Contact </li>
                </ul>
            </nav>
            <h1 class="mt-24 text-4xl font-bold"> Portfolio title </h1>
            <p class="mt-6 text-gray-400">
                A subheading with a brief description of you, your<br>
                work, and what you’re all about—no biggie
            </p>
            <section class="mt-10 grid grid-cols-2 grid-rows-2 gap-12">
                <div class="my-4">
                    <div class="bg-red-600 h-[16rem] rounded-md shadow-lg"> </div>
                    <h1 class="mt-4 text-xl"> Project title </h1>
                    <p class="mt-2 text-gray-400"> Description of your first project </p>
                </div>
                <div class="my-4">
                    <div class="bg-red-600 h-[16rem] rounded-md shadow-lg"> </div>
                    <h1 class="mt-4 text-xl"> Project title </h1>
                    <p class="mt-2 text-gray-400"> Description of your first project </p>
                </div>
                <div class="my-4">
                    <div class="bg-red-600 h-[16rem] rounded-md shadow-lg"> </div>
                    <h1 class="mt-4 text-xl"> Project title </h1>
                    <p class="mt-2 text-gray-400"> Description of your first project </p>
                </div>
                <div class="my-4">
                    <div class="bg-red-600 h-[16rem] rounded-md shadow-lg"> </div>
                    <h1 class="mt-4 text-xl"> Project title </h1>
                    <p class="mt-2 text-gray-400"> Description of your first project </p>
                </div>
            </section>
        </section>
        <hr class="w-3/4 mx-auto bg-gray-400">
        <section class="w-100 bg-white px-48 py-12 flex">
            <div class="w-[100%]">
                <h1 class="text-5xl font-extrabold"> About </h1>
                <p class="mt-6 text-lg text-gray-400"> Subheading for description or instructions </p>
                <p class="mt-6">
                    Body text for your whole bio. We’ll put in some lorem ipsum to show how a filled-out page might look:<br><br>

                    Excepteur efficient emerging, minim veniam anim aute carefully curated Ginza conversation exquisite perfect
                    nostrud nisi intricate Content. Qui  international first-class nulla ut. Punctual adipisicing, essential lovely
                    queen tempor eiusmod irure. Exclusive izakaya charming Scandinavian impeccable aute quality of life soft power
                    pariatur Melbourne occaecat discerning. Qui wardrobe aliquip, et Porter destination Toto remarkable officia
                    Helsinki excepteur Basset hound. Zürich sleepy perfect consectetur.
                </p>
            </div>
            <div class="w-[100%] h-[36rem] pl-36">
                <div class="bg-blue-600 w-[100%] h-[100%] rounded-md shadow-lg">

                </div>
            </div>
        </section>
        <hr class="w-3/4 mx-auto bg-gray-400">
        <section class="w-100 bg-white px-48 py-12 flex">
            <div class="w-[100%]">
                <h1 class="text-5xl font-extrabold"> Contact me </h1>
                <p class="mt-6 text-lg text-gray-400"> Subheading for description or instructions </p>
                <form class="mt-6">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-black">First name</label>
                            <input type="text" id="first_name" class="border shadow-sm border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="John" required />
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-black">Last name</label>
                            <input type="text" id="last_name" class="border shadow-sm border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Doe" required />
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-black">Email address</label>
                        <input type="email" id="email" class="border shadow-sm border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="john.doe@company.com" required />
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-black">Your message</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                    </div>
                    <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full px-5 py-4 text-center dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
            <div class="w-[100%] h-100 pl-36">
                <div class="bg-orange-600 w-[100%] h-[100%] rounded-md shadow-lg">

                </div>
            </div>
        </section>
    </main>
    <hr class="w-3/4 mx-auto bg-gray-400">
    <footer class="w-100 bg-white px-48 py-12">
        <div>
            <span class="flex w-3/4 float-left"> PIXELWARE &copy; 2024, All rights reserved. </span>
            <ul class="flex w-1/4 justify-between">
                <li> Linkedin </li>
                <li> Youtube </li>
                <li> Instagram </li>
            </ul>
        </div>
    </footer>
</template>
<script setup>
    import {onMounted} from "vue";

    onMounted(() => {
    });
</script>
