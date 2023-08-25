<template>
    <Card style="box-shadow: none">
        <template #header>
            <div class="w-full">
                <img
                    v-if="headerImageUrl"
                    :src="headerImageUrl"
                    alt="Blogpost preview afbeelding"
                    class="image-center w-full max-h-24rem"
                />
            </div>
        </template>

        <template #title>
            <h1>{{ title }}</h1>
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
        id: {
            type: String
        },
        headerImageUrl: {
            type: String
        },
        title: {
            type: String
        },
        previewText: {
            type: String
        },
    });
</script>
