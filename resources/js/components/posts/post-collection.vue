<template>
    <div
        v-for="(post, index) in posts"
        :key="index"
    >
        <article class="px-0 lg:px-4 xl:px-8">
            <div class="p-8">
                <Divider
                    v-if="index !== 0"
                    type="dashed"
                    align="center"
                >
                    <i class="pi pi-star text-indigo-200" />
                </Divider>
            </div>

            <post-item
                :post="post"
                preview
                @click="visible = true"
            />
        </article>

        <Dialog
            v-model:visible="visible"
            :modal="false"
            :draggable="false"
            :style="{ 'min-width': '100vw', 'min-height': '100vw', 'box-shadow': 'none' }"
        >
            <post-item :post="post" />
        </Dialog>
    </div>
</template>

<script setup>
    import {ref} from 'vue';
    import Dialog from 'primevue/dialog';
    import Divider from 'primevue/divider';

    const props = defineProps({
        'posts': {
            type: Array,
        }
    });

    const visible = ref(false);
</script>
