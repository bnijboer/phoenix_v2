<template>
    <button :class="style">
        <slot></slot>
    </button>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    'type': {
        type: String,
    }
});

const style = computed(() => {
    if (props.type === 'submit') {
        return 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full';
    }
});
</script>
