<template>
    <AdminContainer
        :form-title="$t('invoice.edit.title')"
        :route-name="route('invoices.index')"
    >
        <form
            @submit.prevent="
                form.put(route('invoices.update', invoice.data.id))
            "
        >
            <InputContainer>
                <SelectInput
                    id="companies"
                    :options="companies"
                    name="company_id"
                    v-model="form.company_id"
                    :label="$t('invoice.edit.companies')"
                    :error="errors.company_id"
                />
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <DateInput
                        id="start-date"
                        name="start_date"
                        v-model="form.start_date"
                        :label="$t('invoice.edit.start_date')"
                        placeholder="01-01-2024"
                        :error="errors.start_date"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <DateInput
                        id="end-date"
                        name="end_date"
                        v-model="form.end_date"
                        :label="$t('invoice.edit.end_date')"
                        placeholder="31-01-2024"
                        :error="errors.end_date"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <SubmitButton :form-processing="form.processing">
                {{ $t("invoice.edit.submit") }}
            </SubmitButton>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";
import DoubleInputContainer from "../../Partials/Containers/DoubleInputContainer.vue";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import DateInput from "../../Partials/Inputs/DateInput.vue";
import SelectInput from "../../Partials/Inputs/SelectInput.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    invoice: object;
    companies: object;
    errors: object;
}

const props = defineProps<Props>();

const form = useForm({
    company_id: props.invoice.data.to_company_id ?? null,
    start_date: props.invoice.data.start_date ?? null,
    end_date: props.invoice.data.end_date ?? null,
});
</script>
