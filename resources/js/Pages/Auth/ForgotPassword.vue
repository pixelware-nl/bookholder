<template>
    <AuthFormContainer :form-title="$t('auth.forgot_password.title')" :logo-to-route="route('login')">
        <form @submit.prevent="form.post(route('password.email'))" class="border-b pb-8">
            <InputContainer>
                <TextInput
                    id="email"
                    name="email"
                    v-model="form.email"
                    :label="$t('auth.forgot_password.email')"
                    placeholder="j.doe@pixelware.nl"
                    :error="errors.email"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('auth.forgot_password.submit') }} </SubmitButton>
        </form>
        <p class="mt-6 text-center">
            {{ $t('auth.forgot_password.already_registered_question') }}
            <Link :href="route('login')" class="text-blue-600 hover:underline"> {{ $t('auth.forgot_password.already_registered_link') }} </Link>
        </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import InputContainer from '../Partials/Containers/InputContainer.vue';
import SubmitButton from '../Partials/Inputs/SubmitButton.vue';
import TextInput from '../Partials/Inputs/TextInput.vue';
import AuthFormContainer from './Partials/AuthFormContainer.vue';

interface Props {
    errors: object;
}

const props = defineProps<Props>();

const form = useForm({
    email: null,
});
</script>
