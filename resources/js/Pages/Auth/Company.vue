<template>
    <AuthFormContainer :form-title="$t('auth.company.title')" :route-name="route('login')">
        <form @submit.prevent="form.post(route('register.set-company'))" class="border-b pb-10">
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    :label="$t('auth.company.company_name')"
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
                    :label="$t('auth.company.kvk')"
                    placeholder="12345678"
                    :error="errors.kvk"
                    :disabled="hasCompany"
                />
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="iban"
                    name="iban"
                    v-model="form.iban"
                    :label="$t('auth.company.iban')"
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
                        :label="$t('auth.company.street_address')"
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
                        :label="$t('auth.company.city')"
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
                        :label="$t('auth.company.postal_code')"
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
                        :label="$t('auth.company.country')"
                        placeholder="Netherlands"
                        :error="errors.country"
                        :disabled="hasCompany"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('auth.company.submit') }} </SubmitButton>
        </form>
        <p class="mt-6 text-center">
            {{ $t('auth.company.already_registered_question') }}
            <Link :href="route('login')" class="text-blue-600 hover:underline"> {{ $t('auth.company.already_registered_link') }} </Link>
        </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import DoubleInputContainer from '../Partials/Containers/DoubleInputContainer.vue';
import InputContainer from '../Partials/Containers/InputContainer.vue';
import SubmitButton from '../Partials/Inputs/SubmitButton.vue';
import TextInput from '../Partials/Inputs/TextInput.vue';
import AuthFormContainer from './Partials/AuthFormContainer.vue';

interface Props {
    errors?: object;
    company?: object;
    kvk?: string;
}

const props = defineProps<Props>();

const hasCompany = ref(false);
const showHasCompanyNotification = ref(false);

const form = useForm({
    name: props.company?.name,
    kvk: props.company?.kvk ?? props.kvk,
    iban: props.company?.iban,
    street_address: props.company?.street_address,
    city: props.company?.city,
    postal_code: props.company?.postal_code,
    country: props.company?.country,
});

onMounted(() => {
    showHasCompanyNotification.value = hasCompany.value = props.company != null;
});
</script>
