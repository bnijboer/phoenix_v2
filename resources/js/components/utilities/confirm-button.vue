<template>
    <Button
        type="submit"
        :label="label"
        :class="{ 'opacity-25': loading }"
        :disabled="loading"
    />
</template>

<script setup>
    import Button from 'primevue/button';

    const props = defineProps({
        label: String,
        loading: Boolean,
    });
</script>
