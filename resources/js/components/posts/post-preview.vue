<template>
    <Card style="box-shadow: none">
        <template #header>
            <div v-if="headerImageUrl" class="w-full">
                <img
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
        id: String,
        headerImageUrl: String,
        title: String,
        previewText: String,
    });
</script>
