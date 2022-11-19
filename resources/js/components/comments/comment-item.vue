<template>
    <div>
        {{ comment }}
    </div>
</template>

<script setup>
defineProps({
    'comment': {
        type: Object,
    }
});
</script>
