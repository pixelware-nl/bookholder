<template>
    <div class="w-[100%]">
        <h1 class="header"> Contact me </h1>
        <p class="subheader"> Subheading for description or instructions </p>
        <form class="mt-6">
            <div class="form-grid">
                <div>
                    <label for="first_name" class="label">First name</label>
                    <input type="text" id="first_name" class="input-field" placeholder="John" required />
                </div>
                <div>
                    <label for="last_name" class="label">Last name</label>
                    <input type="text" id="last_name" class="input-field" placeholder="Doe" required />
                </div>
            </div>
            <div class="mb-6">
                <label for="email" class="label">Email address</label>
                <input type="email" id="email" class="input-field" placeholder="john.doe@company.com" required />
            </div>
            <div class="mb-6">
                <label for="message" class="label">Your message</label>
                <textarea id="message" rows="4" class="textarea" placeholder="Write your thoughts here..."></textarea>
            </div>
            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>
</template>
<style scoped>
    .header {
        @apply text-5xl font-extrabold
    }

    .subheader {
        @apply mt-6 text-lg text-gray-400
    }

    .form-grid {
        @apply grid gap-6 mb-6 md:grid-cols-2
    }

    .label {
        @apply block mb-2 text-sm font-medium text-black
    }

    .input-field {
        @apply border shadow-sm border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
    }

    .textarea {
        @apply block p-2.5 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500
    }

    .form-button {
        @apply text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full px-5 py-4 text-center dark:focus:ring-blue-800
    }
</style>
