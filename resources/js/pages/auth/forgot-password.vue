<template>
    <template>
        <Card class="mx-4 mt-8">
            <template #title>
                <div v-if="status">
                    {{ status }}
                </div>

                <div class="text-gray-600 text-center">
                    Wachtwoord opnieuw instellen
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

                    <div class="flex align-items-center justify-content-end mt-4">
                        <Button
                            type="submit"
                            label="Stuur herstel link"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        />
                    </div>
                </form>
            </template>
        </Card>
    </template>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import TextField from "@/components/utilities/text-field.vue";

    defineProps({
        status: String,
    });

    const form = useForm({
        email: '',
    });

    const submit = () => {
        form.post(route('password.email'));
    };
</script>
