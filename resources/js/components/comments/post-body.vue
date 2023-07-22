<template>
    <div>
        <div :class="showFull ? '' : 'h-32 overflow-hidden'">
            <slot></slot>
        </div>

        <button class="button button-default" @click="toggle">
            Meer lezen
        </button>
    </div>
</template>

<script setup>
    import {ref } from 'vue'

    const showFull = ref(false);

    function toggle () {
        showFull.value = !showFull.value;
        // console.log(showFull.value);
    }
</script>
