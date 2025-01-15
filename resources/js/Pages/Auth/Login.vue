<template>
    <AuthFormContainer :form-title="$t('auth.login.title')">
        <form @submit.prevent="form.post(route('login.authenticate'))" class="pb-10 border-b">
            <InputContainer>
                <TextInput
                    v-model="form.email"
                    id="email"
                    name="email"
                    :label="$t('auth.login.email')"
                    placeholder="j.doe@pixelware.nl"
                    :error="errors.email"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password"
                    id="password"
                    name="password"
                    :label="$t('auth.login.password')"
                    placeholder="••••••••"
                    :error="errors.password"
                />
                <div class="text-right">
                    <Link :href="route('password.request')" class="text-blue-600 hover:underline text-xs"> {{ $t('auth.login.forgot_password') }} </Link>
                </div>
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('auth.login.submit') }} </SubmitButton>
        </form>
        <p class="mt-6 text-center"> {{ $t('auth.login.not_registered_question') }} <Link :href="route('register.find')" class="text-blue-600 hover:underline"> {{ $t('auth.login.not_registered_link') }} </Link> </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import {useForm, Link} from "@inertiajs/vue3";
import AuthFormContainer from "./Partials/AuthFormContainer.vue";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";
import InputContainer from "../Partials/Containers/InputContainer.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import PasswordInput from "../Partials/Inputs/PasswordInput.vue";

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
