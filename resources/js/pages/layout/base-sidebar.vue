<template>
    <div
        v-if="!loading"
        class="sidebar"
    >
        <img
            :src="image"
            alt="Over mij afbeelding"
            class="max-w-full"
        >

        <div class="sidebar-body p-4">
            <div
                v-html="body"
                class="overflow-hidden"
            />
        </div>
    </div>
</template>

<script setup>
    import {onMounted, ref} from "vue";

    const props = defineProps({
        visible: {
            type: Boolean
        },
    });

    const loading = ref(true);
    const image = ref(null);
    const body = ref(null);

    onMounted(async () => {
        const response = await axios.get(route('globals.about'));

        image.value = response.data.data.image;
        body.value = response.data.data.body;

        loading.value = false;
    });
</script>
