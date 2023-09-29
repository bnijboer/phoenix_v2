<template>
    <form-container>
        <form-card>
            <template #title>
                Nieuw wachtwoord instellen
            </template>
            <template #content>
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

                    <text-field
                        v-model="form.password_confirmation"
                        type="password"
                        placeholder="Wachtwoord herhaling"
                        class="mt-4"
                        required
                    />

                    <div class="flex align-items-center justify-content-end mt-4">
                        <confirm-button
                            label="Bevestigen"
                            :loading="form.processing"
                        />
                    </div>
                </form>
            </template>
        </form-card>
    </form-container>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import ConfirmButton from "@/components/utilities/confirm-button.vue";
    import TextField from "@/components/utilities/text-field.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import FormCard from "@/components/utilities/form-card.vue";

    const props = defineProps({
        email: String,
        token: String,
    });

    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('password.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
