<template>
    <AdminContainer :form-title="$t('log.create.title')" :route-name="route('logs.index')">
        <form @submit.prevent="form.post(route('logs.store'))">
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <SelectInput
                        id="companies"
                        :options="companies"
                        name="company_id"
                        v-model="form.company_id"
                        :label="$t('log.create.companies')"
                        :error="errors.company_id"
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <DateInput
                        id="created-at"
                        name="created-at"
                        v-model="form.created_at"
                        :label="$t('log.create.created_at')"
                        :error="errors.created_at"
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput id="rate" name="rate" v-model="form.rate" :label="$t('log.create.rate')" :error="errors.rate" placeholder="60" />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <TextInput id="hours" name="hours" v-model="form.hours" :label="$t('log.create.hours')" :error="errors.hours" placeholder="10" />
                    <TextInput
                        id="minutes"
                        name="minutes"
                        v-model="form.minutes"
                        :label="$t('log.create.minutes')"
                        :error="errors.minutes"
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
                    :placeholder="$t('log.create.name_placeholder')"
                />
            </InputContainer>
            <InputContainer>
                <TextArea
                    id="description"
                    name="description"
                    v-model="form.description"
                    :label="$t('log.create.description')"
                    :error="errors.description"
                    :placeholder="$t('log.create.description_placeholder')"
                />
            </InputContainer>
            <SubmitButton :form-processing="form.processing"> {{ $t('log.create.submit') }} </SubmitButton>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import DateInput from '@/Pages/Partials/Inputs/DateInput.vue';
import TextArea from '@/Pages/Partials/Inputs/TextArea.vue';
import TextInput from '@/Pages/Partials/Inputs/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import DoubleInputContainer from '../../Partials/Containers/DoubleInputContainer.vue';
import InputContainer from '../../Partials/Containers/InputContainer.vue';
import SelectInput from '../../Partials/Inputs/SelectInput.vue';
import SubmitButton from '../../Partials/Inputs/SubmitButton.vue';
import AdminContainer from '../Partials/AdminContainer.vue';

interface Props {
    companies: object;
    errors: object;
}

defineProps<Props>();

const form = useForm({
    company_id: null,
    created_at: new Date().toISOString().split('T')[0],
    rate: null,
    hours: null,
    minutes: null,
    name: null,
    description: null,
});
</script>
