<template>
    <Button
        type="submit"
        :label="label"
        :class="{ 'opacity-25': loading }"
        :disabled="isDisabled"
        text
    />
</template>

<script setup>
    import Button from 'primevue/button';
    import {computed} from "vue";

    const props = defineProps({
        label: String,
        disabled: {
            type: Boolean,
            default: false
        },
        loading: {
            type: Boolean,
            default: false
        },
    });

    const isDisabled = computed(() => props.disabled || props.loading);
</script>
