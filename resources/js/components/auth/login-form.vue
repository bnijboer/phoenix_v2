<template>
    <form @submit.prevent="submit">
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

            <confirm-button
                label="Inloggen"
                :loading="form.processing"
            />
        </div>
    </form>
</template>

<script setup>
    import {Link, useForm} from '@inertiajs/vue3';
    import Checkbox from 'primevue/checkbox';
    import ConfirmButton from "@/components/utilities/confirm-button.vue";
    import TextField from "@/components/utilities/text-field.vue";

    const props = defineProps({
        canResetPassword: Boolean
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
