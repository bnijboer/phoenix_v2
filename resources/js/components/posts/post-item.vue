<template>
    <Card v-if="!loading" style="box-shadow: none">
        <template #header>
            <div class="w-full">
                <img
                    v-if="post.headerImageUrl"
                    :src="post.headerImageUrl"
                    alt="Blogpost preview afbeelding"
                    class="image-center w-full max-h-24rem"
                />
            </div>
        </template>

        <template #title>
            <h1>{{ post.title }}</h1>
        </template>

        <template #content>
            <div v-if="preview">
                {{ post.previewText }}
            </div>

            <Transition>
                <div v-if="!preview">
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
            </Transition>
        </template>
    </Card>
</template>

<script setup>
import {computed, onMounted, ref} from 'vue'
import {formatDutchDate} from "@/helpers/miscellaneous";
import Card from 'primevue/card';
import PostService from "@/services/post-service.vue";


const props = defineProps({
    id: {
        type: String
    },
    preview: {
        type: Boolean
    },
});

const loading = ref(true);
const post = ref(null);

onMounted(() => {
    getPost(props.id);
});

async function getPost(id) {
    loading.value = true;

    try {
        post.value = await PostService.getPost(id);
    } catch(error) {
        console.log(error.message);
    }

    loading.value = false;
}

function getYouTubeEmbedUrl(videoUrl) {
    const urlSegments = videoUrl.split('/watch?v=');

    return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;
}
</script>

<style>
.v-enter-active,
.v-leave-active {
    transition: 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    height: 0;
}
</style>


<!--<template>-->
<!--    <Card style="box-shadow: none">-->
<!--        <template #header>-->
<!--            <div class="w-full">-->
<!--                <img-->
<!--                    v-if="post.header_image?.url"-->
<!--                    :src="post.header_image.url"-->
<!--                    alt="Blogpost preview afbeelding"-->
<!--                    class="image-center w-full max-h-24rem"-->
<!--                />-->
<!--            </div>-->
<!--        </template>-->

<!--        <template #title>-->
<!--            <h1>{{ post.fiets }}</h1>-->
<!--        </template>-->

<!--        <template #content>-->
<!--            <div v-if="preview">-->
<!--                {{ post.description_text }}-->
<!--            </div>-->

<!--            <Transition>-->
<!--                <div v-if="!preview">-->
<!--                    <div v-for="element in post.body">-->
<!--                        <div-->
<!--                            v-if="element.type === 'text'"-->
<!--                            v-html="element.text"-->
<!--                        />-->
<!--                        <img-->
<!--                            v-else-if="element.type === 'image'"-->
<!--                            :src="element.image.url"-->
<!--                            alt="Afbeelding niet gevonden"-->
<!--                            class="image-center w-full max-h-24rem"-->
<!--                        >-->
<!--                        <div-->
<!--                            v-else-if="element.type === 'video'"-->
<!--                            class="flex justify-content-center"-->
<!--                        >-->
<!--                            <iframe-->
<!--                                :src="getYouTubeEmbedUrl(element.video)"-->
<!--                                width="420"-->
<!--                                height="315"-->
<!--                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"-->
<!--                                allowfullscreen-->
<!--                            />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </Transition>-->
<!--        </template>-->
<!--    </Card>-->
<!--</template>-->

<!--<script setup>-->
<!--    import {computed, onMounted} from 'vue'-->
<!--    import {formatDutchDate} from "@/helpers/miscellaneous";-->
<!--    import Card from 'primevue/card';-->

<!--    const props = defineProps({-->
<!--        post: {-->
<!--            type: Object-->
<!--        },-->
<!--        preview: {-->
<!--            type: Boolean-->
<!--        },-->
<!--    });-->

<!--    onMounted(() => {-->
<!--        console.log(props.post);-->
<!--    });-->

<!--    function getYouTubeEmbedUrl(videoUrl) {-->
<!--        const urlSegments = videoUrl.split('/watch?v=');-->

<!--        return `${urlSegments[0]}/embed/${urlSegments[urlSegments.length - 1]}`;-->
<!--    }-->
<!--</script>-->

<!--<style>-->
<!--    .v-enter-active,-->
<!--    .v-leave-active {-->
<!--        transition: 0.5s ease;-->
<!--    }-->

<!--    .v-enter-from,-->
<!--    .v-leave-to {-->
<!--        opacity: 0;-->
<!--        height: 0;-->
<!--    }-->
<!--</style>-->
