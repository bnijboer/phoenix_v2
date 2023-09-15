<template>
    <section class="p-error text-sm ml-1">
        <p
            v-for="(message, index) in errorBag"
            :key="index"
        >
            {{ message }}
        </p>
    </section>
</template>

<script setup>
    const props = defineProps({
        errorBag: Array
    });
</script>
