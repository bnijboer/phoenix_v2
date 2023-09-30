<template>
    <div class="flex justify-content-center w-full">
        <div>
            <Image
                src="/assets/error-default.jpeg"
                alt="Foutmelding"
                width="500"
            />

            <h1 class="color-primary">
                Oeps...
            </h1>

            <p class="color-text">
                Er is iets misgegaan.
            </p>

            <div class="flex mt-6">
                <button-secondary
                    label="Terug naar overzicht"
                    @click="router.get(route('posts.index'))"
                    class="mx-auto"
                ></button-secondary>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {router} from "@inertiajs/vue3";
    import Image from 'primevue/image';
    import ButtonSecondary from "@/components/utilities/button-secondary.vue";
</script>
