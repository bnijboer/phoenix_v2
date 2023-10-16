<template>
    <form
        @submit.prevent="submit"
        class="flex flex-column gap-1"
    >
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

        <checkbox-single
            v-model="form.remember"
            id="remember"
            label="Ingelogd blijven"
        />

        <button-primary
            label="Inloggen"
            :loading="form.processing"
            class="mx-auto mt-2"
        />

        <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="mx-auto underline text-sm text-gray-600 hover:text-gray-900 mt-4"
        >
            Wachtwoord vergeten?
        </Link>
    </form>
</template>

<script setup>
    import {Link, useForm} from '@inertiajs/vue3';
    import CheckboxSingle from "@/components/utilities/checkbox-single.vue";
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
    import TextField from "@/components/utilities/text-field.vue";
    import {useToast} from "primevue/usetoast";

    const props = defineProps({
        canResetPassword: Boolean
    });

    const toast = useToast();

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onSuccess: () => {
                toast.add({
                    severity: 'success',
                    summary: 'Je bent nu ingelogd',
                    group: 'flash',
                    life: 3000,
                    closable: false
                });
            },
            onFinish: () => {
                form.reset('password');
            }
        });
    };
</script>
