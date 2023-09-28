<template>
    <Card class="mx-4 mt-8">
        <template #title>
            <div class="text-gray-600 text-center">
                Bedankt voor je aanmelding!
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <p class="mb-4 text-sm text-gray-600">
                Klik op de link in de e-mail die net naar je is verzonden om je aanmelding te bevestigen.
            </p>

            <p class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
                Er is een nieuwe verificatielink naar je gemaild.
            </p>

            <form @submit.prevent="submit">
                <div class="mt-4 flex align-items-center justify-content-between">
                    <Button
                        type="submit"
                        label="Stuur link opnieuw"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    />

                    <Button
                        @click="logout"
                        label="Uitloggen"
                    ></Button>
                </div>
            </form>
        </template>
    </Card>
</template>

<script setup>
    import { computed } from 'vue';
    import {router, useForm} from '@inertiajs/vue3';
    import Button from 'primevue/button';
    import Card from 'primevue/card';

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
