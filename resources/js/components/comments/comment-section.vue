<template>
    <div v-if="user" class="flex justify-center">
        <div class="w-3/4">
            <section>
                <form @submit.prevent>
                    <textarea
                        v-model="comment.body"
                        id="body"
                        name="body"
                        placeholder="Reageren..."
                        required
                        class="block border border-primary outline-primary rounded-md w-full h-36 p-4"
                    ></textarea>

                    <button class="btn-default block ml-auto mt-4" @click="submitComment">Versturen</button>
                </form>
            </section>

            <section>
                <h3 class="mb-8">Reacties:</h3>

                <div v-if="comment.length" class="space-y-4">
                    <div
                        v-for="(comment, index) in comments"
                        :key="index"
                        class="comment"
                    >
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>

                                <div class="ml-2">{{ comment.user.name }}</div>
                            </div>

                            <div>
                                {{ formatDutchDate(comment.createdAt) }}
                            </div>
                        </div>

                        <div class="mt-4">
                            {{ comment.body }}
                        </div>
                    </div>
                </div>
                <div v-else class="text-center">
                    Er zijn nog geen reacties.
                </div>
            </section>
        </div>
    </div>
    <div v-else>
        <div class="w-3/4">
            <login></login>

            Geen account? Klik hier om er een aan te maken:
            <register></register>
        </div>
    </div>
</template>

<script setup>
    import {formatDutchDate} from "../../helpers/miscellaneous";
    import Login from "../auth/login";
    import Register from "../auth/register";
    import {computed, onBeforeMount, reactive, ref} from 'vue'
    import {useSecurityStore} from "../../store/security-store";
    import CommentService from "../../services/comment-service";

    const props = defineProps({
        'postUuid': {
            type: String,
        }
    });

    const securityStore = useSecurityStore();

    const user = computed(() => securityStore.getUser());

    const showModal = ref(false);
    const comments = ref({});
    const comment = reactive({
        body: '',
        createdAt: ''
    });

    onBeforeMount(() => {
        if (user) {
            getComments();
        }
    })

    async function getComments() {
        try {
            comments.value = await CommentService.getComments(props.postUuid);
            console.log(comments.value);
        } catch(error) {
            console.log(error.message);
        }
    }

    function confirm() {
        showModal.value = false
    }

    function cancel(close) {
        close();
    }

    async function submitComment() {
        try {
            await CommentService.createComment(props.postUuid, comment);

            comment.body = '';
        } catch (error) {
            console.log(error.message);
        }
    }
</script>
