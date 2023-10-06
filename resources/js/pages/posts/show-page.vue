<template>
    <div>
        <Card style="box-shadow: none">
            <template #header>
                <div v-if="post.headerImageUrl" class="w-full">
                    <Image
                        :src="post.headerImageUrl"
                        alt="Blogpost preview afbeelding"
                        class="image-center w-full max-h-24rem"
                    />
                </div>

                <span class="capitalize">{{ post.createdAt }}</span>
            </template>

            <template #title>
                <h1>{{ post.title }}</h1>
            </template>

            <template #content>
                <div>
                    <div v-for="element in post.body">
                        <div
                            v-if="element.type === 'text'"
                            v-html="element.text"
                        />
                        <img
                            v-else-if="element.type === 'image'"
                            :src="element.image.url"
                            alt="Afbeelding niet gevonden"
                            class="image-center w-full max-h-24rem"
                        >
                        <div
                            v-else-if="element.type === 'video'"
                            class="flex justify-content-center"
                        >
                            <iframe
                                :src="getYouTubeEmbedUrl(element.video)"
                                width="420"
                                height="315"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            />
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <div>
                    <Button
                        v-for="(tag, index) in post.tags"
                        :key="index"
                        class="mr-2"
                        outlined
                        size="small"
                        @click="getPostsByTag(tag.slug)"
                        :label="`#${tag.title}`"
                    ></Button>
                </div>
            </template>
        </Card>

        <comment-section
            :entry-id="post.entryId"
            :comments="post.comments"
        />

        <div class="mt-4">
            <Link
                :href="props.meta.originUrl"
                :headers="{ viewIndex: props.meta.viewIndex  }"
                style="text-decoration: none;"
            >
                <button-secondary label="Terug naar overzicht"></button-secondary>
            </Link>
        </div>

        <Toast position="bottom-right" group="subscription-modal">
            <template #message="slotProps">
                <div class="flex flex-column align-items-center" style="flex: 1">
                    <div class="text-center mb-2">
                        <p class="font-semibold text-lg mb-2">
                            Op de hoogte blijven?
                        </p>
                        <p>Schrijf je in</p>
                    </div>
                    <form @submit.prevent="submit">
                        <text-field
                            v-model="form.email"
                            type="email"
                            placeholder="E-mail"
                            :error-bag="form.errors.email"
                        />
                    </form>
                </div>
            </template>
        </Toast>
    </div>
</template>

<script setup>
    import {onBeforeMount, onMounted, ref} from "vue";
    import {Link, router, useForm} from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast';
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import Image from 'primevue/image';
    import Toast from 'primevue/toast';
    import PostService from "@/services/post-service.vue";
    import CommentSection from "@/components/comments/comment-section.vue";
    import ButtonSecondary from "@/components/utilities/button-secondary.vue";
    import TextField from "@/components/utilities/text-field.vue";

    const props = defineProps({
        data: Object,
        meta: Object
    })

    const toast = useToast();

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const post = ref(null);

    onBeforeMount(() => {
        post.value = props.data.data;
    });

    onMounted(() => {
        setTimeout(() => {
            if (props.meta.showSubscriptionModal) {
                showSubscriptionModalPopUp();
            }

            updateReaderCount();
        }, 15000);
    });

    const submit = async () => {
        await axios.post(route('subscriptions.save_preferences'), form);

        toast.removeGroup('subscription-modal');
    };

    const showSubscriptionModalPopUp = () => {
        toast.add({
            severity: 'info',
            group: 'subscription-modal'
        });
    }

    const updateReaderCount = () => {
        PostService.updateReaderCount(post.value.entryId);
    }

    function getYouTubeEmbedUrl(videoUrl) {
        const urlSegments = videoUrl.split('/watch?v=');

        return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;
    }

    function getPostsByTag(tag){
        router.get(
            route('posts.index', { tag: tag })
        );
    }
</script>
