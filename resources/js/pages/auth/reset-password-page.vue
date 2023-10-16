<template>
    <form-container>
        <form-card>
            <template #title>
                Nieuw wachtwoord instellen
            </template>
            <template #content>
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

                    <text-field
                        v-model="form.password_confirmation"
                        type="password"
                        placeholder="Wachtwoord herhaling"
                        required
                        :error="form.errors.password_confirmation"
                    />

                    <button-primary
                        label="Bevestigen"
                        :loading="form.processing"
                        class="mx-auto"
                    />
                </form>
            </template>
        </form-card>
    </form-container>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import {useToast} from "primevue/usetoast";
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
    import TextField from "@/components/utilities/text-field.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import FormCard from "@/components/utilities/form-card.vue";

    const props = defineProps({
        email: String,
        token: String,
    });

    const toast = useToast();

    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('password.store'), {
            onSuccess: () => {
                toast.add({
                    severity: 'success',
                    summary: 'Je wachtwoord is opnieuw ingesteld',
                    group: 'flash',
                    life: 3000,
                    closable: false
                });
            },
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
