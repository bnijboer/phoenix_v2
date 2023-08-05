<template>
    <Card style="box-shadow: none">
        <template #header>
            <div class="w-full">
                <img
                    v-if="post.header_image?.url"
                    :src="post.header_image.url"
                    alt="Blogpost preview afbeelding"
                    class="image-center w-full max-h-24rem"
                />
            </div>
        </template>

        <template #title>
            <h1>{{ post.title }}</h1>
        </template>

        <template #content>
            <div :class="contentBodyClass">
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
    </Card>
</template>

<script setup>
    import {computed, onMounted} from 'vue'
    import {formatDutchDate} from "@/helpers/miscellaneous";
    import Card from 'primevue/card';

    const props = defineProps({
        post: {
            type: Object
        },
        preview: {
            type: Boolean
        },
    });

    const contentBodyClass = computed(() => props.preview ? 'hidden' : '');

    onMounted(() => {
        console.log(props.post);
    });

    function getYouTubeEmbedUrl(videoUrl) {
        const urlSegments = videoUrl.split('/watch?v=');

        return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;
    }
</script>
