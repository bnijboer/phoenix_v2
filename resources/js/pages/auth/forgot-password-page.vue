<template>
    <form-container>
        <form-card :status="status">
            <template #title>
                Wachtwoord opnieuw instellen
            </template>
            <template #content>
                <form @submit.prevent="submit">
                    <text-field
                        v-model="form.email"
                        type="email"
                        placeholder="E-mail"
                        required
                    />

                    <div class="flex align-items-center justify-content-end mt-4">
                        <confirm-button
                            label="Stuur herstel link"
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
    import TextField from "@/components/utilities/text-field.vue";
    import ConfirmButton from "@/components/utilities/confirm-button.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import FormCard from "@/components/utilities/form-card.vue";

    const props = defineProps({
        status: String,
    });

    const form = useForm({
        email: '',
    });

    const submit = () => {
        form.post(route('password.email'));
    };
</script>
