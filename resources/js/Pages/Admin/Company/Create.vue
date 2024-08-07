<template>
    <AdminContainer form-title="Company settings">
        <form @submit.prevent="form.post(route('companies.store'))">
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    label="Company name"
                    placeholder="Pixelware"
                />
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="email"
                    name="email"
                    v-model="form.email"
                    label="Email"
                    placeholder="j.doe@pixelware.nl"
                />
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="phone"
                    name="phone"
                    v-model="form.phone"
                    label="Phone"
                    placeholder="+31 6 1234 5678"
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
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="city"
                        name="city"
                        v-model="form.city"
                        label="City"
                        placeholder="Rotterdam"
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
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="province"
                        name="province"
                        v-model="form.province"
                        label="Province"
                        placeholder="South-Holland"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="country"
                    name="country"
                    v-model="form.country"
                    label="Country"
                    placeholder="Netherlands"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> Create company </SubmitButton>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import AdminContainer from "../Partials/AdminContainer.vue";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import TextInput from "../../Partials/Inputs/TextInput.vue";
import DoubleInputContainer from "../../Partials/Containers/DoubleInputContainer.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import {defineProps} from "vue/dist/vue";
import {useForm} from "@inertiajs/vue3";

interface Props {
    errors: object,
}

const props = defineProps<Props>();

const form = useForm({
    name: null,
    street_address: null,
    city: null,
    province: null,
    postal_code: null,
    country: null,
    phone: null,
    email: null
});
</script>
