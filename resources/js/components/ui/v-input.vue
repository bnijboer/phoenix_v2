<template>
    <input :type="type" v-model="model" :placeholder="placeholder">
</template>

<script setup>
const props = defineProps({
    'type': {
        type: String,
    },
    'model': {
        type: String,
    },
    'placeholder': {
        type: String,
    }
})
</script>
