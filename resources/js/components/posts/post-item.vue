<template>
    <div>
        <div>{{ post.title }}</div>

        <div v-if="isExpanded">
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
        <div v-else>
            {{ post.description_text }}
        </div>

        <button
            @click="toggleExpand"
        >
            <span v-html="isExpanded ? 'Terug' : 'Meer lezen...'"></span>
        </button>
    </div>
</template>

<script setup>
    import {onMounted, ref} from 'vue'

    const props = defineProps({
        post: {
            type: Object
        },
    });

    const isExpanded = ref(false);

    // const props = withDefaults(defineProps({
    //     post: {
    //         type: Object
    //     },
    //     isExpanded: {
    //         type: Boolean
    //     }
    // }), {
    //     isExpanded: false
    // });

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
