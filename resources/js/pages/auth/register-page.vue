<template>
    <form-container>
        <form-card>
            <template #title>
                Account aanmaken
            </template>
            <template #content>
                <form
                    @submit.prevent="submit"
                    class="flex flex-column gap-1"
                >
                    <text-field
                        v-model="form.name"
                        type="test"
                        placeholder="Gebruikersnaam"
                        required
                        :error="form.errors.name"
                    />

                    <text-field
                        v-model="form.email"
                        type="email"
                        placeholder="E-mail"
                        required
                        :error="form.errors.email"
                    />

                    <text-field
                        v-model="form.password"
                        type="password"
                        placeholder="Wachtwoord"
                        required
                        :error="form.errors.password"
                    />

                    <text-field
                        v-model="form.password_confirmation"
                        type="password"
                        placeholder="Wachtwoord bevestigen"
                        required
                        :error="form.errors.password_confirmation"
                    />

                    <checkbox-single
                        v-model="form.remember"
                        id="remember"
                        label="Ingelogd blijven"
                    />

                    <checkbox-single
                        v-model="form.newsletter"
                        id="newsletter"
                        label="Hou mij op de hoogte bij nieuwe posts"
                    />

                    <button-primary
                        label="Registreren"
                        :loading="form.processing"
                        class="mx-auto mt-2"
                    />

                    <Link
                        :href="route('login')"
                        class="mx-auto underline text-sm text-gray-600 hover:text-gray-900 mt-4"
                    >
                        Heb je al een account?
                    </Link>
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
        newsletter: true,
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
