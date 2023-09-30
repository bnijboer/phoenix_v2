<template>
    <form-container>
        <form-card :status="status">
            <template #title>
                Wachtwoord opnieuw instellen
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
                        :error-bag="form.errors.email"
                    />

                    <button-primary
                        label="Stuur herstel link"
                        :loading="form.processing"
                        class="mx-auto mt-2"
                    />
                </form>
            </template>
        </form-card>
    </form-container>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import TextField from "@/components/utilities/text-field.vue";
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
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
