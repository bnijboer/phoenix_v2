<template>
    <Card class="mx-4">
        <template #title>
            <div class="text-gray-600 text-center">
                Account aanmaken
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <form
                @submit.prevent="register"
                class="mt-2"
            >
                <text-field
                    v-model="registerRequest.name"
                    type="text"
                    placeholder="Gebruikersnaam"
                    required
                    :error-bag="validationErrors?.username"
                />

                <text-field
                    v-model="registerRequest.email"
                    type="email"
                    placeholder="E-mail"
                    class="mt-5"
                    required
                    :error-bag="validationErrors?.email"
                />

                <text-field
                    v-model="registerRequest.password"
                    type="password"
                    placeholder="Wachtwoord"
                    class="mt-5"
                    required
                    :error-bag="validationErrors?.password"
                />

                <text-field
                    v-model="registerRequest.password_confirmation"
                    type="password"
                    placeholder="Wachtwoord bevestigen"
                    class="mt-5"
                    required
                    :error-bag="validationErrors?.password_confirmation"
                />

                <div class="text-right mt-5">
                    <Button
                        type="submit"
                        label="Registreren"
                    />
                </div>
            </form>
        </template>
    </Card>
</template>

<script setup>
    import {ref} from "vue";
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import SecurityService from "@/services/security-service.vue";
    import TextField from "@/components/utilities/text-field.vue";
    import {router} from "@inertiajs/vue3";
    import route from "ziggy-js";

    const registerRequest = ref({
        'name': null,
        'email': null,
        'password': null,
        'password_confirmation': null,
        'remember': true
    });

    const validationErrors = ref(null)

    function register() {
        SecurityService.register(registerRequest.value)
            .then(() => {
                router.get(route('pages.index'));
            })
            .catch(error => {
                validationErrors.value = error.response.data.errors;
            });
    }
</script>
