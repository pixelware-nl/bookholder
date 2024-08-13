
<template>
    <AuthFormContainer form-title="Register" :route-name="route('login')">
        <form @submit.prevent="form.post(route('register.set-company'))" class="pb-10 border-b">
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    label="Company name"
                    placeholder="Pixelware"
                    :error="errors.name"
                    :disabled="hasCompany"
                />
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="kvk"
                    name="kvk"
                    v-model="form.kvk"
                    label="KVK number"
                    placeholder="12345678"
                    :error="errors.kvk"
                    :disabled="hasCompany"
                />
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="street_address"
                        name="street_address"
                        v-model="form.street_address"
                        label="Street address"
                        placeholder="Weena 4B"
                        :error="errors.street_address"
                        :disabled="hasCompany"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="city"
                        name="city"
                        v-model="form.city"
                        label="City"
                        placeholder="Rotterdam"
                        :error="errors.city"
                        :disabled="hasCompany"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="postal_code"
                        name="postal_code"
                        v-model="form.postal_code"
                        label="Postal code"
                        placeholder="4111KK"
                        :error="errors.postal_code"
                        :disabled="hasCompany"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="country"
                        name="country"
                        v-model="form.country"
                        label="Country"
                        placeholder="Netherlands"
                        :error="errors.country"
                        :disabled="hasCompany"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> Continue </SubmitButton>
        </form>
        <p class="mt-6 text-center"> Already have an account? <Link :href="route('login')" class="text-blue-600 hover:underline"> Signin now </Link> </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import InputContainer from "../Partials/Containers/InputContainer.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import DoubleInputContainer from "../Partials/Containers/DoubleInputContainer.vue";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";
import {defineProps} from "vue/dist/vue";
import {Link, useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import AuthFormContainer from "./Partials/AuthFormContainer.vue";

interface Props {
    errors?: object,
    company?: object,
}

const props = defineProps<Props>();

const hasCompany = ref(false);
const showHasCompanyNotification = ref(false);

const form = useForm({
    name: props.company?.name,
    kvk: props.company?.kvk,
    street_address: props.company?.street_address,
    city: props.company?.city,
    postal_code: props.company?.postal_code,
    country: props.company?.country,
});

onMounted(() => {
    console.log(props.company.name);

    showHasCompanyNotification.value = hasCompany.value = (props.company != null);
})
</script>
