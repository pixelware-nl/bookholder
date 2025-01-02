<template>
    <AdminContainer :form-title="$t('log.create.title')" :route-name="route('logs.index')">
        <form @submit.prevent="form.post(route('logs.store'))">
            <InputContainer>
                <SelectInput
                    id="companies"
                    :options="companies"
                    name="company_id"
                    v-model="form.company_id"
                    :label="$t('log.create.companies')"
                    :error="errors.company_id"
                />
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="rate"
                        name="rate"
                        v-model="form.rate"
                        :label="$t('log.create.rate')"
                        :error="errors.rate"
                        placeholder="60"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput
                        id="hours"
                        name="hours"
                        v-model="form.hours"
                        :label="$t('log.create.hours')"
                        :error="errors.hours"
                        placeholder="10"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    :label="$t('log.create.name')"
                    :error="errors.name"
                    placeholder="API koppeling aangemaakt"
                />
            </InputContainer>
            <InputContainer>
                <TextArea
                    id="description"
                    name="description"
                    v-model="form.description"
                    :label="$t('log.create.description')"
                    :error="errors.description"
                    placeholder="Uitleg over het specifieke API koppeling"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('log.create.submit') }} </SubmitButton>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import {useForm} from "@inertiajs/vue3";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import DoubleInputContainer from "../../Partials/Containers/DoubleInputContainer.vue";
import SelectInput from "../../Partials/Inputs/SelectInput.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import AdminContainer from "../Partials/AdminContainer.vue";
import TextInput from "@/Pages/Partials/Inputs/TextInput.vue";
import TextArea from "@/Pages/Partials/Inputs/TextArea.vue";

interface Props {
    companies: object,
    errors: object,
}

const props = defineProps<Props>();

const form = useForm({
    company_id: null,
    rate: null,
    hours: null,
    name: null,
    description: null,
});
</script>
