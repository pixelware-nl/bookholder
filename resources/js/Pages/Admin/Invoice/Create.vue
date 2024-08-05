<template>
    <AdminFormContainer form-title="Invoice settings">
        <form @submit.prevent="form.post(route('invoices.store'))">
            <InputContainer>
                <SelectInput
                    id="companies"
                    :options="companies"
                    name="company_id"
                    v-model="form.company_id"
                    label="Companies"
                />
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <DateInput
                        id="start-date"
                        name="start_date"
                        v-model="form.start_date"
                        label="Start date"
                        placeholder="01-01-2024"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <DateInput
                        id="end-date"
                        name="end_date"
                        v-model="form.end_date"
                        label="End date"
                        placeholder="31-01-2024"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> Create PDF </SubmitButton>
        </form>
    </AdminFormContainer>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import {useForm} from "@inertiajs/vue3";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import DoubleInputContainer from "../../Partials/Containers/DoubleInputContainer.vue";
import DateInput from "../../Partials/Inputs/DateInput.vue";
import SelectInput from "../../Partials/Inputs/SelectInput.vue";
import AdminFormContainer from "../Partials/AdminFormContainer.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";

interface Props {
    companies: object,
    errors: object,
}

const props = defineProps<Props>();

const form = useForm({
    company_id: null,
    start_date: null,
    end_date: null,
});
</script>
<style scoped>
    .header-title {
        @apply font-bold text-2xl uppercase mb-8
    }

    .input-container {
        @apply mb-6
    }

    .input-two-inbetween {
        @apply w-[47.5%]
    }

    .input-two-inbetween:last-child {
        margin-left: 5%;
    }

    .input-label {
        @apply block mb-2 text-sm font-medium text-gray-900
    }

    .input-select {
        @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
    }

    .input-date {
        @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
    }

    .input-error {
        @apply text-red-600 text-sm mt-2
    }

    .input-field-error {
        @apply !border-red-600
    }

    .input-submit {
        @apply border bg-slate-800 border-gray-300 text-slate-50 text-sm rounded-lg py-3 w-full hover:bg-slate-900 hover:text-slate-200
    }
</style>
