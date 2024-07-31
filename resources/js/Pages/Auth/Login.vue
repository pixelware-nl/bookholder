<template>
    <div class="w-1/3 px-8 pt-12 pb-6 rounded-lg shadow-xl bg-white">
        <p class="text-5xl text-center font-black mb-2"> PIXELWARE<span class="text-red-600">.</span> </p>
        <h1 class="header-title text-center"> Login </h1>
        <form @submit.prevent="form.post(route('login.authenticate'))" class="pb-10 border-b">
            <div class="input-container">
                <label for="email" class="input-label">Email</label>
                <input
                    id="email"
                    type="text"
                    name="email"
                    v-model="form.email"
                    :class="{'input-field-error': errors.email}"
                    class="input"
                    placeholder="john@doe.com"
                />
                <p class="input-error"> {{ errors.email }} </p>
            </div>
            <div class="input-container">
                <label for="password" class="input-label">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    v-model="form.password"
                    :class="{'input-field-error': errors.password}"
                    class="input"
                    placeholder="••••••••"
                />
                <p class="input-error"> {{ errors.password }} </p>
                <div class="text-right">
                    <Link :href="route('invoices.index')" class="text-blue-600 hover:underline text-xs"> Forgot password? </Link>
                </div>

            </div>
            <button type="submit" :disabled="form.processing" class="input-submit">
                Login
            </button>
        </form>
        <p class="mt-6 text-center"> Don't have an account? <Link :href="route('register')" class="text-blue-600 hover:underline"> Signup now </Link> </p>
    </div>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import {useForm, Link} from "@inertiajs/vue3";

interface Props {
    errors: object,
}

const props = defineProps<Props>();

const form = useForm({
    email: null,
    password: null,
});
</script>
<style scoped>
.header-title {
    @apply font-bold text-2xl uppercase mb-8
}

.input {
    @apply border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
}

.input-label {
    @apply block mb-2 text-sm font-medium text-gray-900
}

.input-container {
    @apply mb-6
}

.input-submit {
    @apply border bg-slate-800 border-gray-300 text-slate-50 text-sm rounded-lg py-3 w-full hover:bg-slate-900 hover:text-slate-200
}

.input-error {
    @apply text-red-600 text-sm mt-2
}

.input-field-error {
    @apply !border-red-600
}
</style>
