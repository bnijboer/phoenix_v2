<template>
    <div class="border-left-1 border-indigo-200">
        <img
            :src="about.image.url"
            alt="Over mij afbeelding"
            class="max-w-full"
        >

        <div class="p-4">
            <div
                v-html="about.body"
                class="overflow-hidden"
            />
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        about: {
            type: Object
        },
        visible: {
            type: Boolean
        },
    });
</script>
