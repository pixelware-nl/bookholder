<template>
    <AdminContainer :form-title="$t('log.edit.title')" :route-name="route('logs.index')">
        <form @submit.prevent="form.put(route('logs.update', log))">
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="companies"
                        name="company_id"
                        v-model="form.company_name"
                        :label="$t('log.edit.companies')"
                        :error="errors.company_id"
                        placeholder="Pixelware"
                        disabled
                    />
                </DoubleInputContainer>
                <DoubleInputContainer>
                    <DateInput
                        id="created-at"
                        name="created-at"
                        v-model="form.created_at"
                        :label="$t('log.edit.created_at')"
                        :error="errors.created_at"
                        disabled
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer class="flex">
                <DoubleInputContainer>
                    <TextInput
                        id="rate"
                        name="rate"
                        v-model="form.rate"
                        :label="$t('log.edit.rate')"
                        :error="errors.rate"
                        placeholder="60"
                        disabled
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
                        disabled
                    />
                    <TextInput
                        id="minutes"
                        name="minutes"
                        v-model="form.minutes"
                        :label="$t('log.create.minutes')"
                        :error="errors.minutes"
                        placeholder="10"
                        disabled
                    />
                </DoubleInputContainer>
            </InputContainer>
            <InputContainer>
                <TextInput
                    id="name"
                    name="name"
                    v-model="form.name"
                    :label="$t('log.edit.name')"
                    :placeholder="$t('log.edit.name_placeholder')"
                    disabled
                />
            </InputContainer>
            <InputContainer>
                <TextArea
                    id="description"
                    name="description"
                    v-model="form.description"
                    :label="$t('log.edit.description')"
                    :placeholder="$t('log.edit.description_placeholder')"
                    disabled
                />
            </InputContainer>
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
import AdminContainer from '../Partials/AdminContainer.vue';

interface Props {
    log: object;
    companies: object;
    errors: object;
}

const props = defineProps<Props>();

const form = useForm({
    company_name: props.log.data.company_name ?? null,
    rate: props.log.data.rate ?? null,
    hours: props.log.data.hours ?? null,
    name: props.log.data.name ?? null,
    description: props.log.data.description ?? null,
    created_at: new Date(props.log.data.created_at).toISOString().split('T')[0] ?? null,
});
</script>
