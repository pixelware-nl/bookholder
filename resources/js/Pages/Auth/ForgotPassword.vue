<template>
    <FormContainer form-title="Forgot password" :logo-to-route="route('login')">
        <form @submit.prevent="form.post(route('password.email'))" class="pb-8 border-b">
            <InputContainer>
                <TextInput
                    id="email"
                    name="email"
                    v-model="form.email"
                    label="Email"
                    placeholder="j.doe@pixelware.nl"
                    :error="errors.email"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> Send email </SubmitButton>
        </form>
        <p class="mt-6 text-center"> Know your details? <Link :href="route('login')" class="text-blue-600 hover:underline"> Signin now </Link> </p>
    </FormContainer>
</template>
<script setup lang="ts">
import FormContainer from "./Partials/FormContainer.vue";
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
