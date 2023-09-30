<template>
    <form-container>
        <form-card>
            <template #title>
                Bedankt voor je aanmelding!
            </template>
            <template #content>
                <div class="flex flex-column gap-1">
                    <InlineMessage
                        v-if="verificationLinkSent"
                        severity="success"
                        class="mb-2"
                    >
                        <div class="ml-2">
                            Er is een nieuwe bevestigingslink naar je verzonden
                        </div>
                    </InlineMessage>

                    <p>
                        Klik op de link in de e-mail die net naar je is verzonden om je aanmelding te bevestigen.
                    </p>

                    <form
                        @submit.prevent="submit"
                        class="text-center mt-2"
                    >
                        <button-secondary
                            label="Geen e-mail ontvangen?"
                            :loading="form.processing"
                        />
                    </form>
                </div>
            </template>
        </form-card>
    </form-container>
</template>

<script setup>
    import { computed } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import InlineMessage from 'primevue/inlinemessage';
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
</script>
