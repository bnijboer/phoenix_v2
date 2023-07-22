<template>
    <div>
        <div>{{ post.title }}</div>

        <div v-for="element in post.body">
            <div
                v-if="element.type === 'text'"
                v-html="element.text"
            ></div>
            <div v-else-if="element.type === 'image'">
                <img :src="element.image.url">
            </div>
            <div v-else-if="element.type === 'video'">
                <iframe
                    :src="getYouTubeEmbedUrl(element.video)"
                    width="420"
                    height="315"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                >
                </iframe>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {onMounted} from 'vue'

    const props = defineProps({
        'post': {
            type: Object,
        }
    });

    onMounted(() => {
        console.log(props.post);
    });

    function getYouTubeEmbedUrl(videoUrl) {
        const urlSegments = videoUrl.split('/watch?v=');

        return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;
    }
</script>
