<template>
    <AuthFormContainer :form-title="$t('auth.forgot_password.title')" :logo-to-route="route('login')">
        <form @submit.prevent="form.post(route('password.email'))" class="pb-8 border-b">
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
        <p class="mt-6 text-center"> {{ $t('auth.forgot_password.already_registered_question') }} <Link :href="route('login')" class="text-blue-600 hover:underline"> {{ $t('auth.forgot_password.already_registered_link') }} </Link> </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import AuthFormContainer from "./Partials/AuthFormContainer.vue";
import InputContainer from "../Partials/Containers/InputContainer.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import {Link, useForm} from "@inertiajs/vue3";
import {defineProps} from "vue";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";

interface Props {
    errors: object,
}

const props = defineProps<Props>();

const form = useForm({
    email: null,
})
</script>
