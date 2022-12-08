<template>
    <div>
        <form @submit.prevent>
            <label for="body">Reactie:</label>
            <textarea v-model="comment.body" id="body" name="body" autofocus required></textarea>

            <button @click="submit">Versturen</button>
        </form>
    </div>
</template>

<script setup>
    import {inject, reactive} from 'vue'
    import CommentService from "../../services/comment-service";

    const postUuid = inject('postUuid');

    const comment = reactive({
        body: null
    });

    async function submit() {
        try {
            await CommentService.createComment(postUuid, comment);

            comment.body = null;
        } catch (error) {
            console.log(error.message);
        }
    }
</script>
