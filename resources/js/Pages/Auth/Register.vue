<template>
    <AuthFormContainer form-title="Register" :logo-to-route="route('login')">
        <form @submit.prevent="form.post(route('register.store'))" class="pb-10 border-b">
            <input type="hidden" name="company_id" :value="form.company_id" />
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        v-model="form.firstname"
                        id="firstname"
                        name="firstname"
                        label="First name"
                        placeholder="John"
                        :error="errors.firstname"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        v-model="form.lastname"
                        id="lastname"
                        name="lastname"
                        label="Last name"
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
                    label="Email"
                    placeholder="j.doe@pixelware.nl"
                    :error="errors.email"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password"
                    id="password"
                    name="password"
                    label="Password"
                    placeholder="••••••••"
                    :error="errors.password"
                />
            </InputContainer>
            <InputContainer>
                <PasswordInput
                    v-model="form.password_confirmation"
                    id="password-confirmation"
                    name="password_confirmation"
                    label="Password"
                    placeholder="••••••••"
                    :error="errors.password_confirmation"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> Register </SubmitButton>
        </form>
        <p class="mt-6 text-center"> Already have an account? <Link :href="route('login')" class="text-blue-600 hover:underline"> Signin now </Link> </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import {useForm, Link} from "@inertiajs/vue3";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";
import AuthFormContainer from "./Partials/AuthFormContainer.vue";
import InputContainer from "../Partials/Containers/InputContainer.vue";
import DoubleInputContainer from "../Partials/Containers/DoubleInputContainer.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import PasswordInput from "../Partials/Inputs/PasswordInput.vue";

interface Props {
    company?: object,
    errors: object,
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
<style scoped>

</style>
