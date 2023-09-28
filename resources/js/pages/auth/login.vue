<template>
    <Card class="mx-4 mt-8">
        <template #title>
            <div v-if="status">
                {{ status }}
            </div>

            <div class="text-gray-600 text-center">
                Log in
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <form
                @submit.prevent="submit"
                class="mt-2"
            >
                <text-field
                    v-model="form.email"
                    type="email"
                    placeholder="E-mail"
                    required
                />

                <text-field
                    v-model="form.password"
                    type="password"
                    placeholder="Wachtwoord"
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
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="mr-4 underline text-sm text-gray-600 hover:text-gray-900"
                    >
                        Wachtwoord vergeten?
                    </Link>

                    <Button
                        type="submit"
                        label="Inloggen"
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

    defineProps({
        canResetPassword: Boolean,
        status: String,
    });

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>
