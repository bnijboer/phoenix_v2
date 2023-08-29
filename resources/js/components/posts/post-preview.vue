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
                <span>{{ formatDutchDate(date) }}</span>

                <span>
                    <i class="pi pi-comment" />
                </span>
            </div>
        </template>

        <template #subtitle>
            <h1 class="post-title">{{ title }}</h1>
        </template>

        <template #content>
            <div>
                {{ previewText }}
            </div>
        </template>
    </Card>
</template>

<script setup>
    import {formatDutchDate} from "@/helpers/miscellaneous";
    import Card from 'primevue/card';

    const props = defineProps({
        id: String,
        headerImageUrl: String,
        date: String,
        title: String,
        previewText: String,
    });
</script>
