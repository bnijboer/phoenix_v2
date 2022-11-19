<template>
    <button :type="type" :class="style">
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    'type': {
        type: String,
    }
})

const style = computed(() => {
    if (type === 'submit') {
        return 'bg-blue-200 rounded p-2 outline'
    }
})
</script>
