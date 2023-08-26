<template>
    <div>
        <div v-if="loading">
            <h1>Loading blogposts...</h1>
        </div>
        <div v-else>
            <post-collection :posts="posts"></post-collection>

            <Paginator
                v-model:first="page"
                :rows="limit"
                :totalRecords="total"
                template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
            ></Paginator>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref, watch} from 'vue';
import Paginator from 'primevue/paginator';
import PostService from "@/services/post-service.vue";

const loading = ref(true);

const posts = ref(null);

const page = ref(1);
const limit = ref(5);
const total = ref(0);

watch(page, (currentPage) => {
    page.value = currentPage;

    getPosts();
});

onMounted(() => {
    if (posts.value === null) {
        getPosts();
    }
});

async function getPosts() {
    loading.value = true;

    try {
        const response = await PostService.getPosts(page.value, limit.value);

        posts.value = response.collection;
        total.value = response.meta.total;
        page.value = response.meta.page;
    } catch(error) {
        console.log(error.message);
    }

    loading.value = false;
}
</script>
