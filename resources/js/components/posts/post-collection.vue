<template>
    <div>
        <ul
            v-for="post in props.posts"
            class="collapsible popout"
        >
            <li>
                <post-item
                    :post="post"
                ></post-item>
            </li>
        </ul>
    </div>
</template>

<script setup>
    const props = defineProps({
        'posts': {
            type: Array,
        }
    });
</script>
