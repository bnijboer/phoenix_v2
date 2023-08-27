<template>
    <div class="px-0 lg:px-4 xl:px-8">
        <div
            v-for="(post, index) in posts"
            :key="index"
            :ref="(el) => (postRefs[index] = el)"
        >
            <div class="p-8">
                <Divider
                    v-if="index !== 0"
                    type="dashed"
                    align="center"
                >
                    <i class="pi pi-star text-indigo-200" />
                </Divider>
            </div>

            <Link
                :href="`/posts/${post.id}`"
                :headers="{ originUrl: currentPage, viewIndex: index }"
                style="text-decoration: none;"
            >
                <PostPreview
                    :id="post.id"
                    :header-image-url="post.headerImageUrl"
                    :title="post.title"
                    :preview-text="post.previewText"
                ></PostPreview>
            </Link>
        </div>

        <div class="flex align-items-center justify-content-center">
            <Button @click="previous" :disabled="page === 1">
                Volgende pagina
            </Button>

            <span class="mx-2">
                Pagina {{ page }} van {{ totalPages }}
            </span>

            <Button @click="next" :disabled="page >= totalPages">
                Volgende pagina
            </Button>
        </div>
    </div>
</template>

<script setup>
    import {computed, onBeforeMount, onMounted, ref} from 'vue';
    import Button from 'primevue/button';
    import Divider from 'primevue/divider';
    import PostPreview from "@/components/posts/post-preview.vue";
    import {Link, router} from '@inertiajs/vue3'

    const props = defineProps({
        posts: Object,
        meta: Object
    })

    const postRefs = ref([])

    const posts = ref([]);
    const loading = ref(false);
    const page = ref(1);
    const limit = ref(5);
    const total = ref(0);

    const totalPages = computed(() => Math.ceil(props.meta.total / 5))

    const currentPage = computed(() => {
        return route('posts.index', {
            page: page.value,
            limit: limit.value
        })
    })

    onBeforeMount(() => {
        page.value = props.meta.page;
        posts.value = props.posts.data;
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
