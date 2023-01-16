<template>
    <div class="flex justify-center">
        <div class="w-3/4">
            <section class="mb-16">
                <base-form v-if="user" :rules="rules" :request="request" @validate="submit">
                    <textarea
                        v-model="request.body"
                        id="body"
                        name="body"
                        placeholder="Wat vind je van deze post?"
                        class="block border border-primary outline-primary rounded-md w-full h-36 p-4"
                    ></textarea>

                    <p v-if="errors.body" class="validation-error">
                        {{ errors.body }}
                    </p>

                    <button class="button button-default block ml-auto mt-4">Reageren</button>
                </base-form>

                <div v-else class="flex justify-center">
                    <div class="space-y-4">
                        <div>Log in om te kunnen reageren.</div>

                        <login />

                        <register />
                    </div>
                </div>
            </section>

            <section>
                <div class="text-center mb-8">
                    <h3>Reacties:</h3>
                </div>

                <div v-if="comments.length" class="space-y-4">
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
</template>

<script setup>
    import {formatDutchDate} from "../../helpers/miscellaneous";
    import Login from "../auth/login";
    import Register from "../auth/register";
    import {onBeforeMount, reactive, ref} from 'vue'
    import {useSecurityStore} from "../../store/security-store";
    import CommentService from "../../services/comment-service";
    import BaseForm from "../utilities/base-form";

    const props = defineProps({
        'postUuid': {
            type: String,
        }
    });

    const securityStore = useSecurityStore();
    const user = ref(null);
    const showModal = ref(false);
    const comments = ref([]);

    const rules = {
        body: ['required', 'hasNoScriptTags'],
    };

    const request = reactive({
        body: '',
    });

    let errors = ref({});

    onBeforeMount(async () => {
        user.value = await securityStore.getUser();

        await getComments();
    });

    async function getComments() {
        try {
            comments.value = await CommentService.getComments(props.postUuid);
        } catch(error) {
            console.log(error.message);
        }
    }

    async function submit(form) {
        errors.value = form.errors;

        if (!form.validated) {
            return;
        }

        try {
            const comment = await CommentService.createComment(props.postUuid, request);

            request.body = '';

            comments.value.unshift(comment);
        } catch (error) {
            console.log(error.message);
        }
    }
</script>
