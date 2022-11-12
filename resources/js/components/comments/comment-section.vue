<template>
    <div>
        <comment-index :post-uuid="props.postUuid"></comment-index>

        <comment-create :post-uuid="props.postUuid"></comment-create>
    </div>
</template>
<script setup>
import CommentIndex from "./comment-index";
import CommentCreate from "./comment-create";

const props = defineProps({
    'postUuid': String
});
</script>
