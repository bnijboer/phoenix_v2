<template>
    <Card>
        <template #title>Account aanmaken</template>

        <template #content>
            <form @submit.prevent="register" class="mt-4">
                <span class="p-float-label">
                    <InputText id="username" type="text" v-model="username" class="w-full block mb-4" />
                    <label for="username">Gebruikersnaam</label>
                </span>

                <span class="p-float-label">
                    <InputText id="email" type="email" v-model="email" class="w-full block mb-4" />
                    <label for="email">E-mail</label>
                </span>

                <span class="p-float-label">
                    <InputText id="password" type="password" v-model="password" class="w-full block mb-4" />
                    <label for="password">Wachtwoord</label>
                </span>

                <span class="p-float-label">
                    <InputText id="passwordConfirm" type="password" v-model="passwordConfirm" class="w-full block mb-4" />
                    <label for="passwordConfirm">Wachtwoord bevestigen</label>
                </span>

                <div class="text-right mt-4">
                    <Button type="submit" label="Registreren" />
                </div>
            </form>
        </template>
    </Card>
</template>

<script setup>
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import InputText from 'primevue/inputtext';
    import {ref} from "vue";
    import {useSecurityStore} from "@/store/security-store";
    import axios from "axios";

    const securityStore = useSecurityStore();

    const username = ref(null);
    const email = ref(null);
    const password = ref(null);
    const passwordConfirm = ref(null);

    async function register() {
        const formData = {
            name: username.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordConfirm.value,
            remember: false
        }

        await axios.post('/register', formData);

        window.location.reload();
    }
</script>
