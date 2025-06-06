<template>
    <div
        v-if="showHasCompanyNotification"
        @click="showHasCompanyNotification = false"
        class="mb-8 flex w-full justify-between rounded-lg bg-emerald-200 p-8 text-emerald-900 shadow-lg hover:cursor-pointer"
    >
        <p>{{ $t("company.create.found") }}</p>
    </div>
    <AdminContainer
        :form-title="$t('company.create.found')"
        :route-name="route('companies.find')"
    >
        <h2 class="mb-2 text-xl font-bold uppercase">
            {{ $t("company.create.description") }}
        </h2>
        <form @submit.prevent="form.post(route('companies.store'))">
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    :label="$t('company.create.name')"
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
                    :label="$t('company.create.kvk')"
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
                        :label="$t('company.create.street_address')"
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
                        :label="$t('company.create.city')"
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
                        :label="$t('company.create.postal_code')"
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
                        :label="$t('company.create.country')"
                        placeholder="Nederland"
                        :error="errors.country"
                        :disabled="hasCompany"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <SubmitButton :form-processing="form.processing">
                {{ $t("company.create.submit") }}
            </SubmitButton>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import DoubleInputContainer from "../../Partials/Containers/DoubleInputContainer.vue";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import TextInput from "../../Partials/Inputs/TextInput.vue";
import AdminContainer from "../Partials/AdminContainer.vue";
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
    street_address: props.company?.street_address,
    city: props.company?.city,
    postal_code: props.company?.postal_code,
    country: props.company?.country ?? "Nederland",
});

onMounted(() => {
    showHasCompanyNotification.value = hasCompany.value = props.company != null;
});
</script>
