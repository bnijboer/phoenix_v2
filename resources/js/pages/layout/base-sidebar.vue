<template>
    <div class="border-left-1 border-indigo-200">
        <div v-if="!loading">
            <img
                :src="about.image"
                alt="Over mij afbeelding"
                class="max-w-full"
            >

            <div class="p-4">
                <div
                    v-html="about.body"
                    class="overflow-hidden"
                />
            </div>
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
