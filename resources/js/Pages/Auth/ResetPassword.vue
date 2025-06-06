<template>
    <AuthFormContainer :form-title="$t('auth.reset_password.title')" :logo-to-route="route('login')">
        <form @submit.prevent="form.post(route('password.update'))">
            <input type="hidden" name="token" :value="form.token" />
            <InputContainer>
                <TextInput
                    v-model="form.email"
                    id="email"
                    name="email"
                    :label="$t('auth.reset_password.email')"
                    :disabled="true"
                    aria-disabled="true"
                    :error="errors.email"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password"
                    id="password"
                    name="password"
                    :label="$t('auth.reset_password.password')"
                    placeholder="••••••••"
                    :error="errors.password"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password_confirmation"
                    id="password-confirmation"
                    name="password_confirmation"
                    :label="$t('auth.reset_password.password_confirmation')"
                    placeholder="••••••••"
                    :error="errors.password_confirmation"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('auth.reset_password.submit') }} </SubmitButton>
        </form>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { defineProps, onBeforeMount } from 'vue';
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
    token: null,
    email: null,
    password: null,
    password_confirmation: null,
});

onBeforeMount(() => {
    form.token = route().params.token;
    form.email = route().params.email;
});
</script>
