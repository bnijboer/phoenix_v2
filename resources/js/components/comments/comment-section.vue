<template>
    <div>
        <div v-if="state.user">
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
    import {computed, onBeforeMount, provide, reactive, ref} from 'vue'
    import {useSecurityStore} from "../../store/security-store";

    const props = defineProps({
        'postUuid': {
            type: String,
        }
    });

    provide('postUuid', props.postUuid);

    const userStore = useSecurityStore();
    const state = reactive({
        user: null
    });

    onBeforeMount(() => {
        if (!userStore.user) {
            getUser();
        }
    });

    async function getUser() {
        await userStore.getUser();
        state.user = userStore.user;

        console.log(state.user);
    }

    async function logout() {
        await userStore.logout();
    }
</script>
