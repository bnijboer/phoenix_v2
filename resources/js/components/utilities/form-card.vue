<template>
    <Card>
        <template #title>
            <div class="color-primary text-center">
                <slot name="title" />
            </div>

            <hr class="hr-1 mx-8">
        </template>

        <template #content>
            <div class="color-text px-4">
                <slot name="content" />
            </div>
        </template>
    </Card>
</template>

<script setup>
    import Card from 'primevue/card';
</script>
