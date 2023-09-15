<template>
    <Card class="mx-4">
        <template #title>
            <div class="text-gray-600 text-center">
                Log in
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <form
                @submit.prevent="login"
                class="mt-2"
            >
                <text-field
                    v-model="loginRequest.email"
                    type="email"
                    placeholder="E-mail"
                    :error-bag="validationErrors?.email"
                />

                <text-field
                    v-model="loginRequest.password"
                    type="password"
                    placeholder="Wachtwoord"
                    class="mt-4"
                    :error-bag="validationErrors?.password"
                />

                <div class="text-right mt-4">
                    <Button
                        type="submit"
                        label="Inloggen"
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

    const loginRequest = ref({
        'email': null,
        'password': null,
        'remember': true
    });

    const validationErrors = ref(null)

    function login() {
        SecurityService.login(loginRequest.value)
            .then(() => {
                router.get(route('pages.index'));
            })
            .catch(error => {
                validationErrors.value = error.response.data.errors;
            });
    }
</script>
