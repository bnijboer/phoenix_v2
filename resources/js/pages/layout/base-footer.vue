<template>
    <footer class="bg-white flex justify-content-center">
        <div
            v-if="posts"
            class="max-w-screen p-4"
        >
            <h3 class="text-center mb-5">
                Bekijk ook
            </h3>

            <Carousel
                :value="posts"
                :numVisible="3"
                :numScroll="1"
                :responsiveOptions="responsiveOptions"
                :show-navigators="false"
                :show-indicators="false"
                circular
                :autoplayInterval="5000"
            >
                <template #item="slotProps">
                    <div class="flex justify-content-around pb-2">
                        <Link
                            :href="route('pages.show', slotProps.data.entryId)"
                            style="text-decoration: none;"
                            class="relative border-round-lg overflow-hidden"
                        >
                            <img
                                :src="slotProps.data.headerImageUrl ?? '/assets/small-preview-default.jpeg'"
                                alt="Blogpost suggestie afbeelding"
                                class="block bg-cover w-14rem h-12rem"
                            />

                            <div class="absolute bottom-0 left-0 px-3 w-14rem overlay">
                                <h5 class="ellipsis">
                                    {{ slotProps.data.title }}
                                </h5>
                            </div>
                        </Link>
                    </div>
                </template>
            </Carousel>
        </div>
    </footer>
</template>

<script setup>
    import {onMounted, ref} from "vue";
    import {Link} from '@inertiajs/vue3'
    import Carousel from 'primevue/carousel';
    import PostService from "@/services/post-service.vue";


    onMounted(() => {
        PostService.getPostSuggestions().then(response => {
            posts.value = response.data.data.slice(0, 9)
        });
    });

    const posts = ref();
    const responsiveOptions = ref([
        {
            breakpoint: '1199px',
            numVisible: 3,
            numScroll: 1
        },
        {
            breakpoint: '575px',
            numVisible: 1,
            numScroll: 1
        }
    ]);
</script>
