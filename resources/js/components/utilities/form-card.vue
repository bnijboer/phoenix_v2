<template>
    <Card>
        <template #title>
            <div v-if="status">
                {{ status }}
            </div>

            <div class="text-gray-600 text-center">
                <slot name="title" />
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <div class="mt-2">
                <slot name="content" />
            </div>
        </template>
    </Card>
</template>

<script setup>
    import Card from 'primevue/card';

    const props = defineProps({
        status: String,
    });
</script>
