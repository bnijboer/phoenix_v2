<template>
    <Card>
        <template #header>
            <div v-if="headerImageUrl" class="w-full">
                <img
                    :src="headerImageUrl"
                    alt="Blogpost preview afbeelding"
                    class="image-center w-full max-h-24rem"
                />
            </div>

            <div class="flex justify-content-between px-3 pt-3">
                <span class="capitalize">{{ createdAt }}</span>

                <span>
                    <i class="pi pi-comment" />
                    {{ commentCount }}
                </span>
            </div>
        </template>

        <template #subtitle>
            <h1 class="color-primary">{{ title }}</h1>
        </template>

        <template #content>
            <div>
                {{ previewText }}
            </div>
        </template>
    </Card>
</template>

<script setup>
    import Card from 'primevue/card';

    const props = defineProps({
        headerImageUrl: String,
        title: String,
        previewText: String,
        createdAt: String,
        commentCount: Number
    });
</script>
