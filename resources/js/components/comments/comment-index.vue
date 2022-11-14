<template>
    <div>
        <h1>Comments</h1>

        <comment-item
            v-for="(comment, index) in comments"
            :key="index"
            :comment="comment"
        ></comment-item>
    </div>
</template>

<script setup>
import {inject, onBeforeMount, ref} from 'vue';
import CommentItem from "./comment-item";
import CommentService from "./../../services/comment-service"

const comments = ref({});
const postUuid = inject('postUuid');

async function getComments() {
    comments.value = await CommentService.getComments(postUuid);
}

onBeforeMount(async () => {
    getComments();
})
</script>
