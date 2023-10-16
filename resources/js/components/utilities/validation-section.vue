<template>
    <p class="p-error text-sm">
        {{ error }}
    </p>
</template>

<script setup>
    const props = defineProps({
        error: String
    });
</script>
