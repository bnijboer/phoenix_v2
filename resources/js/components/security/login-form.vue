<template>
    <Card>
        <template #title>Log in</template>

        <template #content>
            <form @submit.prevent="login">
                <span class="p-float-label">
                    <InputText id="email" type="email" v-model="email" class="w-full block mb-4" />
                    <label for="email">E-mail</label>
                </span>

                <span class="p-float-label">
                    <InputText id="password" type="password" v-model="password" class="w-full block mb-4" />
                    <label for="password">Wachtwoord</label>
                </span>

                <div class="text-right mt-4">
                    <Button type="submit" label="Inloggen" />
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

    const email = ref(null);
    const password = ref(null);

    async function login() {
        const formData = {
            email: email.value,
            password: password.value
        }

        await axios.post('/login', formData, {
            withCredentials: true
        });

        window.location.reload();
    }
</script>
