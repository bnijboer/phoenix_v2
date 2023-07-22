<template>
    <div>
        <div
            v-for="post in props.posts"
        >
            <post-item
                :post="post"
            ></post-item>

            <hr>
        </div>
    </div>
</template>

<script setup>
    import {onMounted} from 'vue'

    const props = defineProps({
        'posts': {
            type: Array,
        }
    });

    // onMounted(() => {
    //     console.log(props.posts);
    // });
</script>
