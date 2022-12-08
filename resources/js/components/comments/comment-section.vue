<template>
    <div>
        <div v-if="user">
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
    import CommentIndex from "./comment-index";
    import CommentCreate from "./comment-create";
    import {computed, provide} from 'vue'
    import {useSecurityStore} from "../../store/security-store";

    const props = defineProps({
        'postUuid': {
            type: String,
        }
    });

    const userStore = useSecurityStore();

    provide('postUuid', props.postUuid);

    const user = computed(() => {
        return userStore.user;
    });

    function logout() {
        userStore.logout();
    }
</script>
