<template>
    <AuthFormContainer :form-title="$t('auth.login.title')">
        <form @submit.prevent="form.post(route('login.authenticate'))" class="border-b pb-10">
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
                    <Link :href="route('password.request')" class="text-xs text-blue-600 hover:underline">
                        {{ $t('auth.login.forgot_password') }}
                    </Link>
                </div>
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('auth.login.submit') }} </SubmitButton>
        </form>
        <p class="mt-6 text-center">
            {{ $t('auth.login.not_registered_question') }}
            <Link :href="route('register.find')" class="text-blue-600 hover:underline"> {{ $t('auth.login.not_registered_link') }} </Link>
        </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import InputContainer from '../Partials/Containers/InputContainer.vue';
import PasswordInput from '../Partials/Inputs/PasswordInput.vue';
import SubmitButton from '../Partials/Inputs/SubmitButton.vue';
import TextInput from '../Partials/Inputs/TextInput.vue';
import AuthFormContainer from './Partials/AuthFormContainer.vue';

interface Props {
    errors: object;
}

defineProps<Props>();

const form = useForm({
    email: null,
    password: null,
});
</script>
<style scoped>
.header-title {
    @apply mb-8 text-2xl font-bold uppercase;
}

.input-container {
    @apply mb-6;
}

.input-submit {
    @apply w-full rounded-lg border border-gray-300 bg-slate-800 py-3 text-sm text-slate-50 hover:bg-slate-900 hover:text-slate-200;
}

.input-error {
    @apply mt-2 text-sm text-red-600;
}

.input-field-error {
    @apply !border-red-600;
}
</style>
