<template>
    <AdminContainer
        :form-title="$t('company.edit.title')"
        :route-name="route('companies.index')"
    >
        <form @submit.prevent="form.put(route('companies.update', company.id))">
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    :label="$t('company.edit.name')"
                    placeholder="Pixelware"
                    :error="errors.name"
                    :disabled="true"
                />
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="kvk"
                    name="kvk"
                    v-model="form.kvk"
                    :label="$t('company.edit.kvk')"
                    placeholder="12345678"
                    :error="errors.kvk"
                    :disabled="true"
                />
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="iban"
                    name="iban"
                    v-model="form.iban"
                    :label="$t('company.edit.iban')"
                    placeholder="NL01 INGB 1234 5678 90"
                    :error="errors.iban"
                />
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="street_address"
                        name="street_address"
                        v-model="form.street_address"
                        :label="$t('company.edit.street_address')"
                        placeholder="Weena 4B"
                        :error="errors.street_address"
                        :disabled="true"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="city"
                        name="city"
                        v-model="form.city"
                        :label="$t('company.edit.city')"
                        placeholder="Rotterdam"
                        :error="errors.city"
                        :disabled="true"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="postal_code"
                        name="postal_code"
                        v-model="form.postal_code"
                        :label="$t('company.edit.postal_code')"
                        placeholder="4111KK"
                        :error="errors.postal_code"
                        :disabled="true"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="country"
                        name="country"
                        v-model="form.country"
                        :label="$t('company.edit.country')"
                        placeholder="Nederland"
                        :error="errors.country"
                        :disabled="true"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <SubmitButton :form-processing="form.processing">
                {{ $t("company.edit.submit") }}
            </SubmitButton>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { defineProps } from "vue/dist/vue";
import DoubleInputContainer from "../../Partials/Containers/DoubleInputContainer.vue";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import TextInput from "../../Partials/Inputs/TextInput.vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    errors?: object;
    company: object;
}

const props = defineProps<Props>();

const form = useForm({
    name: props.company.name,
    kvk: props.company.kvk,
    iban: props.company?.iban,
    street_address: props.company.street_address,
    city: props.company.city,
    postal_code: props.company.postal_code,
    country: props.company?.country ?? "Nederland",
});
</script>
