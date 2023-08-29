<template>
    <div
        v-if="!loading"
        class="sidebar"
    >
        <img
            :src="about.image"
            alt="Over mij afbeelding"
            class="max-w-full"
        >

        <div class="sidebar-body p-4">
            <div
                v-html="about.body"
                class="overflow-hidden"
            />
        </div>
    </div>
</template>

<script setup>
    import {onMounted, ref} from "vue";
    import axios from "axios";

    const props = defineProps({
        visible: {
            type: Boolean
        },
    });

    const loading = ref(true);
    const about = ref(null);

    onMounted(async () => {
        const response = await axios.get(`/about`);

        about.value = response.data.about;

        loading.value = false;
    });
</script>
