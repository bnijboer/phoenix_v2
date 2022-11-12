<template>
    <div>
        {{ comment }}
    </div>
</template>

<script setup>
const props = defineProps({
    'comment': String
});
</script>
