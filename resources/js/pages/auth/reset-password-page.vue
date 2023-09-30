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
                        placeholder="Wachtwoord herhaling"
                        class="mt-4"
                        required
                        :error-bag="form.errors.password_confirmation"
                    />

                    <div class="flex align-items-center justify-content-end mt-4">
                        <button-primary
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
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
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
