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
                <Button
                    @click="router.get(route('pages.index'))"
                    class="mx-auto"
                    label="Terug naar overzicht"
                ></Button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {router} from "@inertiajs/vue3";
    import route from "ziggy-js";
    import Button from 'primevue/button';
    import Image from 'primevue/image';
</script>
