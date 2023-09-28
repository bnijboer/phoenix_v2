<template>
    <Card class="mx-4 mt-8">
        <template #title>
            <div class="text-gray-600 text-center">
                Account aanmaken
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <form
                @submit.prevent="submit"
                class="mt-2"
            >
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

                    <Button
                        type="submit"
                        label="Registreren"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    />
                </div>
            </form>
        </template>
    </Card>
</template>

<script setup>
    import { Link, useForm } from '@inertiajs/vue3';
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import Checkbox from 'primevue/checkbox';
    import TextField from "@/components/utilities/text-field.vue";

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
