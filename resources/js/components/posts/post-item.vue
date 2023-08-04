<template>
    <div>
        <div class="card collapsible-header">
            <div
                v-if="post.header_image"
                class="card-image waves-effect waves-block waves-light"
            >
                <img
                    :src="post.header_image.url"
                    alt="Blogpost preview afbeelding"
                    class="preview-image"
                >
            </div>

            <div class="card-content">
                <p
                    class="activator grey-text text-darken-1"
                    style="margin-bottom: 2rem"
                >
                    {{ formatDutchDate(post.date) }}
                    <i class="material-icons right">expand_more</i>
                </p>

                <p
                    class="card-title grey-text text-darken-4"
                    style="margin-bottom: 1rem"
                >
                    {{ post.title }}
                </p>

                <p class="grey-text text-darken-1">
                    {{ post.description_text }}
                </p>
            </div>
        </div>
        <div class="collapsible-body">
            <div v-for="element in post.body">
                <div
                    v-if="element.type === 'text'"
                    v-html="element.text"
                ></div>
                <div v-else-if="element.type === 'image'">
                    <img
                        :src="element.image.url"
                        alt="Afbeelding niet gevonden"
                        class="responsive-img"
                    >
                </div>
                <div
                    v-else-if="element.type === 'video'"
                    class="video-container"
                >
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
    </div>
</template>

<script setup>
    import {onMounted, ref} from 'vue'
    import {formatDutchDate} from "@/helpers/miscellaneous";

    const props = defineProps({
        post: {
            type: Object
        },
    });

    const isExpanded = ref(false);

    onMounted(() => {
        console.log(props.post);
    });

    function toggleExpand() {
        isExpanded.value = !isExpanded.value;
    }

    function getYouTubeEmbedUrl(videoUrl) {
        const urlSegments = videoUrl.split('/watch?v=');

        return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;
    }
</script>
