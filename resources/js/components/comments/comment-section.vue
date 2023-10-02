<template>
    <div
        ref="overview"
        class="scroll-margin"
    >
        <Panel header="Reacties">
            <div v-if="comments.length">
                <div
                    v-for="(comment, index) in comments"
                    :key="index"
                    class="mb-2"
                    :class="{'highlight': highlightFirst === true && index === 0}"
                >

                    <!--                    :class="(highlightFirst === true && index === 0) ? 'highlight' : ''"-->
                    <Card>
                        <template #subtitle>
                            <div class="flex justify-content-between">
                                <div>
                                    <i class="pi pi-user" />

                                    <span class="ml-2">
                                        {{ comment.user.name }}
                                    </span>
                                </div>

                                <span>
                                    {{ formatDutchDate(comment.createdAt) }}
                                </span>
                            </div>
                        </template>
                        <template #content>
                            <p>
                                {{ comment.body }}
                            </p>
                        </template>
                    </Card>
                </div>
            </div>
            <div
                v-else
                class="text-center"
            >
                Er zijn nog geen reacties.
            </div>

            <form
                v-if="$page.props.auth.user"
                id="form"
                @submit.prevent="submit"
                class="mt-8"
            >
                <text-area
                    v-model="form.body"
                    id="comment-body"
                    label="Wat vind je van deze post?"
                    :error-message="form.errors.body"
                />

                <div class="text-right mt-4">
                    <button-primary
                        label="Versturen"
                        :loading="form.processing"
                    />
                </div>
            </form>
            <div
                v-else
                class="text-center mt-8"
            >
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
    </div>
</template>

<script setup>
    import {Link, useForm} from '@inertiajs/vue3';
    import {formatDutchDate} from "@/helpers/miscellaneous";
    import Card from 'primevue/card';
    import Panel from 'primevue/panel';
    import {onBeforeMount, ref} from 'vue'
    import CommentService from "@/services/comment-service.vue";
    import LoginForm from "@/components/auth/login-form.vue";
    import TextArea from "@/components/utilities/text-area.vue";
    import ButtonPrimary from "@/components/utilities/button-primary.vue";

    const props = defineProps({
        'entryId': String,
        'comments': Array
    });


    const form = useForm({
        'body': ''
    });

    const overview = ref(null);
    const highlightFirst = ref(false);
    const comments = ref([]);

    onBeforeMount(() => {
        comments.value = props.comments;
    });

    function submit() {
        highlightFirst.value = false;

        CommentService.createComment(props.entryId, form)
            .then(response => {
                form.reset();
                form.clearErrors();

                comments.value.unshift(response.data.data);
                highlightFirst.value = true;
                overview.value.scrollIntoView({ behavior: 'smooth' });

            })
            .catch(error => {
                form.setError(error.response.data.errors);
            });
    }
</script>
