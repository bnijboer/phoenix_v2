<template>
    <div>
        <div v-if="isLoggedIn">
            <comment-create></comment-create>

            <comment-index></comment-index>

            <button @click="logout">Uitloggen</button>
        </div>
        <div v-else>
            <login></login>
            <!--        <register></register>-->
        </div>

    </div>
</template>

<script setup>
    import Login from "../auth/login";
    import Register from "../auth/register";
    import AuthenticationService from "../../services/authentication-service";
    import CommentIndex from "./comment-index";
    import CommentCreate from "./comment-create";
    import {onBeforeMount, provide, ref} from 'vue'

    const props = defineProps({
        'postUuid': {
            type: String,
        }
    });

    provide('postUuid', props.postUuid);

    const isLoggedIn = ref(false);

    onBeforeMount(() => {
        AuthenticationService.getUser()
            .then(response => {
                isLoggedIn.value = true;
            })
            .catch(error => console.log(error.message));
    });

    function logout() {
        AuthenticationService.logout()
            .then(response => console.log(response));
    }
</script>
