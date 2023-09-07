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
            <form @submit.prevent="submit" class="mt-8">
                <div class="text-center">
                    <h4>Wat vind je van deze post?</h4>
                </div>

                <span class="p-float-label mt-4">
                    <Textarea
                        v-model="body"
                        class="w-full h-8rem"
                    />
                    <label for="value">Reactie</label>
                </span>

                <div class="text-right mt-2">
                    <Button type="submit" label="Versturen" />
                </div>
            </form>
        </div>
        <div v-else class="text-center mt-8">
            <h5>Log in om te kunnen reageren</h5>

            <div class="flex justify-content-center">
<!--                <RegisterForm class="w-6" />-->
                <LoginForm class="w-6" />
            </div>
        </div>
    </Panel>
</template>

<script setup>
    import {formatDutchDate} from "@/helpers/miscellaneous";
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import Panel from 'primevue/panel';
    import Textarea from 'primevue/textarea';
    import {onBeforeMount, ref} from 'vue'
    import axios from "axios";
    import LoginForm from "@/components/security/login-form.vue";
    import RegisterForm from "@/components/security/register-form.vue";

    const props = defineProps({
        'entryId': String,
        'comments': Array
    });

    const comments = ref([]);
    const body = ref(null);

    onBeforeMount(() => {
        comments.value = props.comments;
    });

    async function submit() {
        const commentRequest = {
            'body': body.value,
            'entryId': props.entryId
        }

        try {
            const response = await axios.post(route('comments.index'), commentRequest);

            const comment = response.data.data;
            body.value = null;
            comments.value.unshift(comment);
        } catch {
            console.log('Error posting comment');
        }
    }
</script>
