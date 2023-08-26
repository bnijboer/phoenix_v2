<template>
    <div v-if="posts.length">
        <div
            v-for="(post, index) in posts"
            :key="index"
        >
            <article class="px-0 lg:px-4 xl:px-8">
                <div class="p-8">
                    <Divider
                        v-if="index !== 0"
                        type="dashed"
                        align="center"
                    >
                        <i class="pi pi-star text-indigo-200" />
                    </Divider>
                </div>

                <a :id="post.id"></a>

                <PostPreview
                    :id="post.id"
                    :header-image-url="post.headerImageUrl"
                    :title="post.title"
                    :preview-text="post.previewText"
                    @click="expand(post.id)"
                ></PostPreview>

<!--                <post-item-->
<!--                    :id="post.id"-->
<!--                    :preview="post.id !== active"-->
<!--                    @click="expand(post.id)"-->
<!--                />-->
            </article>
        </div>
    </div>
    <div v-else class="text-center">
        Er zijn geen blogposts gevonden...
    </div>
</template>

<script setup>
    import {ref} from 'vue';
    import Divider from 'primevue/divider';
    import PostPreview from "@/components/posts/post-preview.vue";

    const props = defineProps({
        posts: {
            type: Array,
            default: [],
        },
    });

    const active = ref(null);

    function expand(postId) {
        active.value = postId;

        setTimeout(() => {
            document
                .getElementById(postId)
                .scrollIntoView({
                    behavior: "smooth"
                });
        }, 150)
    }
</script>
