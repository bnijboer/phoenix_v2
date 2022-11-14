<template>
    <div>
        {{ comment.body }}
    </div>
</template>

<script setup>
const props = defineProps({
    'comment': {
        type: Object,
    }
});
</script>
