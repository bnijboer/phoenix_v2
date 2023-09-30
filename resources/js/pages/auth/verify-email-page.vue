<template>
    <form-container>
        <form-card :status="status">
            <template #title>
                Bedankt voor je aanmelding!
            </template>
            <template #content>
                <p class="mb-4 text-sm text-gray-600">
                    Klik op de link in de e-mail die net naar je is verzonden om je aanmelding te bevestigen.
                </p>

                <p
                    v-if="verificationLinkSent"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    Er is een nieuwe verificatielink naar je gemaild.
                </p>

                <form @submit.prevent="submit">
                    <div class="mt-4 flex align-items-center justify-content-between">
                        <button-secondary
                            label="Stuur link opnieuw"
                            :loading="form.processing"
                        />

                        <button-primary
                            label="Uitloggen"
                            @click="logout"
                        ></button-primary>
                    </div>
                </form>
            </template>
        </form-card>
    </form-container>
</template>

<script setup>
    import { computed } from 'vue';
    import {router, useForm} from '@inertiajs/vue3';
    import ButtonPrimary from "@/components/utilities/button-primary.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import FormCard from "@/components/utilities/form-card.vue";
    import ButtonSecondary from "@/components/utilities/button-secondary.vue";

    const props = defineProps({
        status: String,
    });

    const form = useForm({});

    const verificationLinkSent = computed(() => props.status === 'verification-link-sent');

    const submit = () => {
        form.post(route('verification.send'));
    };

    function logout() {
        router.post(route('logout'));
    }
</script>
