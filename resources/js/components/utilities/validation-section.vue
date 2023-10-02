<template>
    <p class=" p-error text-left text-sm ml-1">
        {{ message }}
    </p>
</template>

<script setup>
    const props = defineProps({
        message: Array
    });
</script>
