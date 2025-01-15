<template>
    <AdminContainer :form-title="$t('company.find.title')" :route-name="route('companies.index')">
        <h2 class="text-xl font-bold mb-2 uppercase"> {{ $t('company.find.search_kvk') }} </h2>
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

            <SubmitButton :form-processing="kvkForm.processing" class="mb-8"> {{ $t('company.find.search_kvk') }} </SubmitButton>
            <div v-if="errors.kvk_to_find">
                <hr>
                <p class="w-full text-center mt-6"> {{ $t('company.find.manual_create_question') }} <Link :href="route('companies.create', kvkForm.kvk_to_find)" class="text-blue-600 hover:underline">{{ $t('company.find.manual_create_link') }}</Link> </p>
            </div>
        </form>
    </AdminContainer>
</template>
<script setup lang="ts">
import AdminContainer from "../Partials/AdminContainer.vue";
import InputContainer from "../../Partials/Containers/InputContainer.vue";
import TextInput from "../../Partials/Inputs/TextInput.vue";
import SubmitButton from "../../Partials/Inputs/SubmitButton.vue";
import {useForm, Link} from "@inertiajs/vue3";
import {defineProps} from "vue";

interface Props {
    errors?: object,
}

const props = defineProps<Props>();

const kvkForm = useForm({
    kvk_to_find: null,
})
</script>
