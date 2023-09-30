<template>
    <form @submit.prevent="submit">
        <text-field
            v-model="form.email"
            type="email"
            placeholder="E-mail"
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

        <div class="mt-4">
            <checkbox-single
                v-model="form.remember"
                id="remember"
                label="Ingelogd blijven"
            />
        </div>

        <div class="flex align-items-center justify-content-end mt-4">
            <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="mr-4 underline text-sm text-gray-600 hover:text-gray-900"
            >
                Wachtwoord vergeten?
            </Link>

            <button-primary
                label="Inloggen"
                :loading="form.processing"
            />
        </div>
    </form>
</template>

<script setup>
    import {Link, useForm} from '@inertiajs/vue3';
    import CheckboxSingle from "@/components/utilities/checkbox-single.vue";
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
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
