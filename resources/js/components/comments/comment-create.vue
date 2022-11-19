<template>
    <div>
        <form @submit.prevent="onSubmit">
            <label for="body">Reactie:</label>
            <textarea v-model="body" id="body" name="body" autofocus></textarea>

            <v-button :type="'submit'" @submit.prevent="onSubmit">Versturen</v-button>
        </form>
    </div>
</template>

<script setup>
import { inject, ref } from 'vue'
import CommentService from "../../services/comment-service";
import VButton from "../ui/v-button";

let body = '';
const postUuid = inject('postUuid');

async function onSubmit() {
    console.log('trst');

    const commentRequest = {
        'body': body,
    }

    await CommentService.createComment(postUuid, commentRequest)
        .then((response) => console.log(response));
}
</script>
