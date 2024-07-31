<template>
    <h1 class="header-title"> Invoice settings </h1>
    <form @submit.prevent="form.post(route('invoices.store'))">
        <div class="input-container">
            <label for="companies" class="input-label">Companies</label>
            <select
                id="companies"
                name="company_id"
                v-model="form.company_id"
                :class="{'input-field-error': errors.company_id}"
                class="input-select"
            >
                <option :value="null" selected>Choose a company</option>
                <option v-for="company in companies" :value="company.id">
                    {{ company.name }}
                </option>
            </select>
            <p class="input-error"> {{ errors.company_id }} </p>
        </div>
        <div class="input-container flex">
            <div class="input-two-inbetween">
                <label for="start-date" class="input-label">Start date</label>
                <input
                    id="start-date"
                    type="date"
                    name="start_date"
                    v-model="form.start_date"
                    :class="{'input-field-error': errors.start_date}"
                    class="input-date"
                />
                <p class="input-error"> {{ errors.start_date }} </p>
            </div>
            <div class="input-two-inbetween">
                <label for="end-date" class="input-label">End date</label>
                <input
                    id="end-date"
                    type="date"
                    name="end_date"
                    v-model="form.end_date"
                    :class="{'input-field-error': errors.end_date}"
                    class="input-date"
                />
                <p class="input-error"> {{ errors.end_date }} </p>
            </div>
        </div>
        <button type="submit" :disabled="form.processing" class="input-submit">
            Create PDF
        </button>
    </form>
</template>
<script setup lang="ts">
import {defineProps} from "vue";
import {useForm} from "@inertiajs/vue3";

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
