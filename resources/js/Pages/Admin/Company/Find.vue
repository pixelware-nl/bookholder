<template>
    <AdminContainer
        :form-title="$t('company.find.title')"
        :route-name="route('companies.index')"
    >
        <h2 class="mb-2 text-xl font-bold uppercase">
            {{ $t("company.find.search_kvk") }}
        </h2>
        <form @submit.prevent="kvkForm.post(route('companies.found'))">
            <InputContainer>
                <TextInput
                    id="kvk"
                    name="kvk_to_find"
                    v-model="kvkForm.kvk_to_find"
                    label="KVK"
                    placeholder="12345678"
                    :error="errors.kvk_to_find"
                />
            </InputContainer>

            <SubmitButton :form-processing="kvkForm.processing" class="mb-8">
                {{ $t("company.find.search_kvk") }}
            </SubmitButton>
            <div v-if="errors.kvk_to_find">
                <hr />
                <p class="mt-6 w-full text-center">
                    {{ $t("company.find.manual_create_question") }}
                    <Link
                        :href="route('companies.create', kvkForm.kvk_to_find)"
                        class="text-blue-600 hover:underline"
                        >{{ $t("company.find.manual_create_link") }}</Link
                    >
                </p>
            </div>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import { Link, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import TextInput from "../../Partials/Inputs/TextInput.vue";
import AdminContainer from "../Partials/AdminContainer.vue";

interface Props {
    errors?: object;
}

defineProps<Props>();

const kvkForm = useForm({
    kvk_to_find: null,
});
</script>
