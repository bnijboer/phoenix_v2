<template>
    <div>
        <comment-create></comment-create>

        <comment-index></comment-index>
    </div>
</template>

<script setup>
import CommentIndex from "./comment-index";
import CommentCreate from "./comment-create";
import { provide } from 'vue'

const props = defineProps({
    'postUuid': {
        type: String,
    }
});

provide('postUuid', props.postUuid);

</script>
