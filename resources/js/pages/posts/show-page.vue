<template>
    <div>
        <Card style="box-shadow: none">
            <template #header>
                <div v-if="headerImageUrl" class="w-full">
                    <Image
                        :src="headerImageUrl"
                        alt="Blogpost preview afbeelding"
                        class="image-center w-full max-h-24rem"
                    />
                </div>
            </template>

            <template #title>
                <h1>{{ title }}</h1>
            </template>

            <template #content>
                <div>
                    <div v-for="element in body">
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
                    <span
                        v-for="(tag, index) in tags"
                        :key="index"
                        class="mr-1"
                    >
                        <Tag :value="tag.title" />
                    </span>
                </div>
            </template>
        </Card>

        <CommentSection
            :post-id="id"
            :comments="comments.data"
        />

        <div class="mt-4">
            <Link
                :href="originUrl"
                :headers="{ viewIndex: viewIndex  }"
                style="text-decoration: none;"
            >
                <Button>
                    Terug naar overzicht
                </Button>
            </Link>
        </div>
    </div>
</template>

<script setup>
    import {Link} from '@inertiajs/vue3'
    import Button from 'primevue/button';
    import Card from 'primevue/card';
    import Image from 'primevue/image';
    import Tag from 'primevue/tag';
    import CommentSection from "@/components/comments/comment-section.vue";
    import {onMounted} from "vue";

    const props = defineProps({
        id: String,
        title: String,
        body: Object,
        headerImageUrl: String,
        originUrl: String,
        viewIndex: Number,
        tags: Array,
        comments: Object
    });

    onMounted(() => {
        console.log(props.tags);
    });

    function getYouTubeEmbedUrl(videoUrl) {
        const urlSegments = videoUrl.split('/watch?v=');

        return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;
    }
</script>
