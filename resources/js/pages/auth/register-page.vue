<template>
    <form-container>
        <form-card>
            <template #title>
                Account aanmaken
            </template>
            <template #content>
                <form @submit.prevent="submit">
                    <text-field
                        v-model="form.name"
                        type="test"
                        placeholder="Gebruikersnaam"
                        required
                    />

                    <text-field
                        v-model="form.email"
                        type="email"
                        placeholder="E-mail"
                        class="mt-4"
                        required
                    />

                    <text-field
                        v-model="form.password"
                        type="password"
                        placeholder="Wachtwoord"
                        class="mt-4"
                        required
                    />

                    <text-field
                        v-model="form.password_confirmation"
                        type="password"
                        placeholder="Wachtwoord bevestigen"
                        class="mt-4"
                        required
                    />

                    <div class="mt-4">
                        <label class="flex align-items-center">
                            <Checkbox
                                v-model="form.remember"
                                name="remember"
                                inputId="remember"
                            />
                            <label
                                for="remember"
                                class="ml-2 text-sm text-gray-600"
                            >
                                Ingelogd blijven
                            </label>
                        </label>
                    </div>

                    <div class="flex align-items-center justify-content-end mt-4">
                        <Link
                            :href="route('login')"
                            class="mr-4 underline text-sm text-gray-600 hover:text-gray-900"
                        >
                            Heb je al een account?
                        </Link>

                        <confirm-button
                            label="Registreren"
                            :loading="form.processing"
                        />
                    </div>
                </form>
            </template>
        </form-card>
    </form-container>
</template>

<script setup>
    import { Link, useForm } from '@inertiajs/vue3';
    import Checkbox from 'primevue/checkbox';
    import ConfirmButton from "@/components/utilities/confirm-button.vue";
    import TextField from "@/components/utilities/text-field.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import FormCard from "@/components/utilities/form-card.vue";

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
