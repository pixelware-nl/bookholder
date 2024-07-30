<template>
    <div class="w-1/3 px-8 py-12 rounded-lg shadow-xl h-[44rem] bg-white">
        <p class="text-5xl text-center font-black mb-2"> PIXELWARE<span class="text-red-600">.</span> </p>
        <h1 class="header-title text-center"> Register </h1>
        <form @submit.prevent="form.post(route('register.store'))" class="pb-10 border-b">
            <div class="input-container flex">
                <div class="input-two-inbetween">
                    <label for="firstname" class="input-label">Firstname</label>
                    <input
                        id="firstname"
                        type="text"
                        name="firstname"
                        v-model="form.firstname"
                        :class="{'input-field-error': errors.firstname}"
                        class="input"
                        placeholder="John"
                    />
                    <p class="input-error"> {{ errors.firstname }} </p>
                </div>
                <div class="input-two-inbetween">
                    <label for="lastname" class="input-label">Lastname</label>
                    <input
                        id="lastname"
                        type="text"
                        name="lastname"
                        v-model="form.lastname"
                        :class="{'input-field-error': errors.lastname}"
                        class="input"
                        placeholder="Doe"
                    />
                    <p class="input-error"> {{ errors.lastname }} </p>
                </div>
            </div>
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
            </div>
            <div class="input-container">
                <label for="password-confirmation" class="input-label">Confirm password</label>
                <input
                    id="password-confirmation"
                    type="password"
                    name="password_confirmation"
                    v-model="form.password_confirmation"
                    :class="{'input-field-error': errors.password_confirmation}"
                    class="input"
                    placeholder="••••••••"
                />
                <p class="input-error"> {{ errors.password_confirmation }} </p>
            </div>
            <button type="submit" :disabled="form.processing" class="input-submit">
                Login
            </button>
        </form>
        <p class="mt-6 text-center"> Already have an account? <Link :href="route('login')" class="text-blue-600 hover:underline"> Signin now </Link> </p>
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
    firstname: null,
    lastname: null,
    email: null,
    password: null,
    password_confirmation: null,
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

.input-two-inbetween {
    @apply w-[47.5%]
}

.input-two-inbetween:last-child {
    margin-left: 5%;
}
</style>
