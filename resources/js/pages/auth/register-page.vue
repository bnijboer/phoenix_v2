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
                        :error-bag="form.errors.name"
                    />

                    <text-field
                        v-model="form.email"
                        type="email"
                        placeholder="E-mail"
                        class="mt-4"
                        required
                        :error-bag="form.errors.email"
                    />

                    <text-field
                        v-model="form.password"
                        type="password"
                        placeholder="Wachtwoord"
                        class="mt-4"
                        required
                        :error-bag="form.errors.password"
                    />

                    <text-field
                        v-model="form.password_confirmation"
                        type="password"
                        placeholder="Wachtwoord bevestigen"
                        class="mt-4"
                        required
                        :error-bag="form.errors.password_confirmation"
                    />

                    <div class="mt-4">
                        <checkbox-single
                            v-model="form.remember"
                            id="remember"
                            label="Ingelogd blijven"
                        />
                    </div>

                    <div class="flex align-items-center justify-content-end mt-4">
                        <Link
                            :href="route('login')"
                            class="mr-4 underline text-sm text-gray-600 hover:text-gray-900"
                        >
                            Heb je al een account?
                        </Link>

                        <button-primary
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
    import CheckboxSingle from "@/components/utilities/checkbox-single.vue";
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
    import TextField from "@/components/utilities/text-field.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import FormCard from "@/components/utilities/form-card.vue";

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        remember: false,
        terms: false,
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
