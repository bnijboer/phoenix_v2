<template>
    <div>
        <div v-for="(comment, index) in comments" :key="index">
            <comment-item :comment="comment"></comment-item>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import CommentItem from "./comment-item";

const props = defineProps({
    'postUuid': String
});

let comments = [];

axios
    .get(`/comments?postUuid=${props.postUuid}`)
    .then((response) => comments = response.data)
    .catch((error) => console.log(error.message));
</script>
