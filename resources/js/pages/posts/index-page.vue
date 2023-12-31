<template>
    <div class="px-0 lg:px-4 xl:px-8">
        <div
            v-for="(post, index) in posts"
            :key="index"
            :ref="(el) => (postRefs[index] = el)"
            class="scroll-margin pb-6"
        >
            <Link
                :href="route('posts.show', post.entryId)"
                :headers="{ viewIndex: index }"
                style="text-decoration: none;"
            >
                <PostPreview
                    :header-image-url="post.headerImageUrl"
                    :title="post.title"
                    :preview-text="post.previewText"
                    :created-at="post.createdAt"
                    :comment-count="post.commentCount"
                ></PostPreview>
            </Link>
        </div>

        <div class="flex align-items-center justify-content-center">
            <Button
                @click="previous"
                :disabled="page === 1"
                icon="pi pi-arrow-left"
                text
                rounded
            />

            <span class="mx-2">
                Pagina {{ page }} van {{ totalPages }}
            </span>

            <Button
                @click="next"
                :disabled="page >= totalPages"
                icon="pi pi-arrow-right"
                text
                rounded
            />
        </div>
    </div>
</template>

<script setup>
    import {computed, onBeforeMount, onMounted, ref} from 'vue';
    import Button from 'primevue/button';
    import PostPreview from "@/components/posts/post-preview.vue";
    import {Link, router} from '@inertiajs/vue3'

    const props = defineProps({
        data: Object,
        meta: Object
    })

    const postRefs = ref([])

    const posts = ref([]);

    const page = ref(1);
    const limit = ref(10);
    const total = ref(0);

    const totalPages = computed(() => Math.ceil(props.meta.total / limit.value))

    const currentPage = computed(() => route('posts.index', {
        page: page.value,
        limit: limit.value
    }));

    onBeforeMount(() => {
        page.value = props.meta.page;
        posts.value = props.data.data;
    });

    onMounted(() => {
        if (props.meta.viewIndex !== null) {
            setTimeout(() => {
                postRefs.value[props.meta.viewIndex].scrollIntoView({ behavior: 'smooth' });
            }, 1000);
        }
    });

    function previous() {
        page.value--;

        router.get(currentPage.value);
    }

    function next() {
        page.value++;

        router.get(currentPage.value);
    }
</script>
