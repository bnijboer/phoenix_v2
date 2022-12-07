<template>
    <div>
        <form @submit.prevent="onSubmit">
            <label for="body">Reactie:</label>
            <textarea v-model="body" id="body" name="body" autofocus></textarea>

            <v-button :type="'submit'" @submit.prevent="onSubmit">Versturen</v-button>
        </form>

        <login :status="'notLoggedIn'"></login>
<!--        <register></register>-->


        <button @click="logout">Uitloggen</button>
    </div>
</template>

<script setup>
import { inject, ref } from 'vue'
import CommentService from "../../services/comment-service";
import VButton from "../ui/v-button";
import Login from "../auth/login";
import Register from "../auth/register";
import AuthenticationService from "../../services/authentication-service";

let body = '';
const postUuid = inject('postUuid');


async function onSubmit() {
    const commentRequest = {
        'body': body,
    }

    await CommentService.createComment(postUuid, commentRequest)
        .then(response => console.log(response));
}

function logout() {
    AuthenticationService.logout()
        .then(response => console.log(response));
}
</script>
