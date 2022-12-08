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
                <h3>Reacties:</h3>

                <div
                    v-for="(comment, index) in comments"
                    :key="index"
                >
                    {{ comment.body }}
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
        body: ''
    });

    onBeforeMount(() => {
        if (user) {
            getComments();
        }
    })

    async function getComments() {
        try {
            comments.value = await CommentService.getComments(props.postUuid);
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
