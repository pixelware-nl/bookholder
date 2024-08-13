<template>
    <AuthFormContainer form-title="Register" :route-name="route('login')">
        <form @submit.prevent="kvkForm.post(route('register.found'))" class="pb-4 border-b">
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

            <SubmitButton :form-processing="kvkForm.processing" class="mb-8"> Search KVK </SubmitButton>
            <div v-if="errors.kvk_to_find">
                <hr>
                <p class="w-full text-center mt-6"> Sure that your company exists? <Link :href="route('register.get-company')" class="text-blue-600 hover:underline">Create it manually</Link> </p>
            </div>
        </form>
        <p class="mt-6 text-center"> Already have an account? <Link :href="route('login')" class="text-blue-600 hover:underline"> Signin now </Link> </p>
    </AuthFormContainer>
</template>
<script setup lang="ts">
import InputContainer from "../Partials/Containers/InputContainer.vue";
import TextInput from "../Partials/Inputs/TextInput.vue";
import SubmitButton from "../Partials/Inputs/SubmitButton.vue";
import {useForm, Link} from "@inertiajs/vue3";
import {defineProps, onMounted} from "vue";
import AuthFormContainer from "./Partials/AuthFormContainer.vue";

interface Props {
    errors?: object,
}

const props = defineProps<Props>();

const kvkForm = useForm({
    kvk_to_find: null,
})

onMounted(() => {
    console.log();
})
</script>
