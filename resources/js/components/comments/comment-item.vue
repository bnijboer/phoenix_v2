<template>
    <div>
        {{ comment.body }}
    </div>
</template>

<script setup>
defineProps({
    'comment': {
        type: Object,
    }
});
</script>
