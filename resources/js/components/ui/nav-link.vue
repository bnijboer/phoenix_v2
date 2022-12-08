<template>
    <a :href="url" class="nav-link">
        <slot />
    </a>
</template>

<script setup>
    defineProps({
        'url': {
            type: String,
        }
    })
</script>
