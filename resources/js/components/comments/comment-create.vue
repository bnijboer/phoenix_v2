<template>
    <div>
        <form @submit.prevent="onSubmit">
            <label for="comment">Reactie:</label>
            <textarea v-model="comment" id="comment" name="comment"></textarea>

            <button type="submit">Versturen</button>
        </form>
    </div>
</template>

<script setup>
import axios from "axios";

const props = defineProps({
    'postUuid': String
});

let comment = '';

const onSubmit = () => {
    const request = {
        'comment': comment,
        'postUuid': props.postUuid
    }

    axios
        .post(`/comments`, request)
        .then((response) => console.log(response.data))
        .catch((error) => console.log(error.message));
}
</script>
