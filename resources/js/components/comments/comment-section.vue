<template>
    <Panel header="Reacties">
        <div v-if="comments.length">
            <Card
                v-for="(comment, index) in comments"
                :key="index"
                class="mb-2"
            >
                <template #subtitle>
                    <div class="flex justify-content-between">
                        <div>
                            <i class="pi pi-user" />

                            <span class="ml-2">
                                {{ comment.user.name }}
                            </span>
                        </div>

                        <span>{{ formatDutchDate(comment.createdAt) }}</span>
                    </div>
                </template>
                <template #content>
                    <p>
                        {{ comment.body }}
                    </p>
                </template>
            </Card>
        </div>
        <div v-else class="text-center">
            Er zijn nog geen reacties.
        </div>

        <div v-if="$page.props.auth.user">
            <form @submit.prevent="onSubmit" class="mt-8">
                <div class="text-center">
                    <h4>Wat vind je van deze post?</h4>
                </div>

                <span class="p-float-label mt-4">
                    <Textarea
                        id="comment-body"
                        v-model="commentRequest.body"
                        :class="{ 'p-invalid': !!validationErrors?.body }"
                        class="w-full h-8rem"
                        required
                    />
                    <label for="comment-body">Reactie</label>
                </span>
                <validation-section :error-bag="validationErrors?.body" />

                <div class="text-right mt-2">
                    <Button type="submit" label="Versturen" />
                </div>
            </form>
        </div>
        <div v-else class="text-center mt-8">
            <h5>Log in om te kunnen reageren</h5>

            <login-form class="mx-auto max-w-24rem mt-4" />

            <div class="mt-4">
                <Link
                    :href="route('register')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Heb je nog geen account?
                </Link>
            </div>
        </div>
    </Panel>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import {formatDutchDate} from "@/helpers/miscellaneous";
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import Panel from 'primevue/panel';
    import Textarea from 'primevue/textarea';
    import {onBeforeMount, ref} from 'vue'
    import CommentService from "@/services/comment-service.vue";
    import ValidationSection from "@/components/utilities/validation-section.vue";
    import LoginForm from "@/components/auth/login-form.vue";

    const props = defineProps({
        'entryId': String,
        'comments': Array
    });

    const comments = ref([]);
    const commentRequest = ref({
        'body': null
    });
    const validationErrors = ref(null);

    onBeforeMount(() => {
        comments.value = props.comments;
    });

    function onSubmit() {
        CommentService.createComment(props.entryId, commentRequest.value)
            .then(response => {
                commentRequest.value.body = null;
                validationErrors.value = null;
                comments.value.unshift(response.data.data);
            })
            .catch(error => {
                validationErrors.value = error.response.data.errors;
            });
    }
</script>
