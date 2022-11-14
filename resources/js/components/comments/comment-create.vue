<template>
    <div>
        <form @submit.prevent="onSubmit">
            <label for="body">Reactie:</label>
            <textarea v-model="body" id="body" name="body" autofocus></textarea>

            <button type="submit">Versturen</button>
        </form>
    </div>
</template>

<script setup>
import { inject } from 'vue'
import CommentService from "../../services/comment-service";

let body = '';
const postUuid = inject('postUuid');

async function onSubmit() {
    const commentRequest = {
        'body': body,
    }

    await CommentService.createComment(postUuid, commentRequest)
        .then((response) => console.log(response));
}
</script>
