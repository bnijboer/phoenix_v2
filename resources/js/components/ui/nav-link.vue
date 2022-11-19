<template>
    <a :href="url" class="p-2 uppercase border-b-4 border-purple-600 hover:text-indigo-400">
        <slot></slot>
    </a>
</template>

<script setup>
    defineProps({
        'url': {
            type: String,
        }
    })
</script>
