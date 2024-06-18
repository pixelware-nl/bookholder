<template>
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
</template>
