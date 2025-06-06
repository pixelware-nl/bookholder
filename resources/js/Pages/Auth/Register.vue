<template>
    <AuthFormContainer
        :form-title="$t('auth.register.title')"
        :logo-to-route="route('login')"
    >
        <form
            @submit.prevent="form.post(route('register.store'))"
            class="border-b pb-10"
        >
            <input type="hidden" name="company_id" :value="form.company_id" />
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        v-model="form.firstname"
                        id="firstname"
                        name="firstname"
                        :label="$t('auth.register.first_name')"
                        placeholder="John"
                        :error="errors.firstname"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        v-model="form.lastname"
                        id="lastname"
                        name="lastname"
                        :label="$t('auth.register.last_name')"
                        placeholder="Doe"
                        :error="errors.lastname"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer>
                <TextInput
                    v-model="form.email"
                    id="email"
                    name="email"
                    :label="$t('auth.register.email')"
                    placeholder="j.doe@pixelware.nl"
                    :error="errors.email"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password"
                    id="password"
                    name="password"
                    :label="$t('auth.register.password')"
                    placeholder="••••••••"
                    :error="errors.password"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password_confirmation"
                    id="password-confirmation"
                    name="password_confirmation"
                    :label="$t('auth.register.password_confirmation')"
                    placeholder="••••••••"
                    :error="errors.password_confirmation"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing">
                {{ $t("auth.register.submit") }}
            </SubmitButton>
        </form>
        <p class="mt-6 text-center">
            {{ $t("auth.register.already_registered_question") }}
            <Link :href="route('login')" class="text-blue-600 hover:underline">
                {{ $t("auth.register.already_registered_link") }}
            </Link>
        </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import { Link, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";
import DoubleInputContainer from "../Partials/Containers/DoubleInputContainer.vue";
import InputContainer from "../Partials/Containers/InputContainer.vue";
import PasswordInput from "../Partials/Inputs/PasswordInput.vue";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import AuthFormContainer from "./Partials/AuthFormContainer.vue";

interface Props {
    company?: object;
    errors: object;
}

const props = defineProps<Props>();

const form = useForm({
    company_id: props.company?.id,
    firstname: null,
    lastname: null,
    email: null,
    password: null,
    password_confirmation: null,
});
</script>
<style scoped></style>
