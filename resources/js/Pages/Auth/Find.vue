<template>
    <AuthFormContainer :form-title="$t('auth.find.title')" :route-name="route('login')">
        <form @submit.prevent="kvkForm.post(route('register.found'))" class="pb-4 border-b">
            <InputContainer>
                <TextInput
                    id="kvk"
                    name="kvk_to_find"
                    v-model="kvkForm.kvk_to_find"
                    :label="$t('auth.find.kvk')"
                    placeholder="12345678"
                    :error="errors.kvk_to_find"
                />
            </InputContainer>

            <SubmitButton :form-processing="kvkForm.processing" class="mb-8"> {{ $t('auth.find.search_kvk') }} </SubmitButton>
            <div v-if="errors.kvk_to_find">
                <hr>
                <p class="w-full text-center mt-6 mb-2"> {{ $t('auth.find.manual_create_question') }} <Link :href="route('register.get-company', kvkForm.kvk_to_find)" class="text-blue-600 hover:underline">{{ $t('auth.find.manual_create_link') }}</Link> </p>
            </div>
        </form>
        <p class="mt-6 text-center"> {{ $t('auth.find.already_registered_question') }} <Link :href="route('login')" class="text-blue-600 hover:underline"> {{ $t('auth.find.already_registered_link') }} </Link> </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import InputContainer from "../Partials/Containers/InputContainer.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";
import {useForm, Link} from "@inertiajs/vue3";
import {defineProps} from "vue";
import AuthFormContainer from "./Partials/AuthFormContainer.vue";

interface Props {
    errors?: object,
}

const props = defineProps<Props>();

const kvkForm = useForm({
    kvk_to_find: null,
})
</script>
