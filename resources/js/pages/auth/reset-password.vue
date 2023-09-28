<template>
    <Card class="mx-4 mt-8">
        <template #title>
            <div class="text-gray-600 text-center">
                Nieuw wachtwoord instellen
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

                <text-field
                    v-model="form.password_confirmation"
                    type="password"
                    placeholder="Wachtwoord bevestigen"
                    class="mt-4"
                    required
                />

                <div class="flex align-items-center justify-content-end mt-4">
                    <Button
                        type="submit"
                        label="Instellen"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    />
                </div>
            </form>
        </template>
    </Card>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import TextField from "@/components/utilities/text-field.vue";

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
