<template>
    <nav>
        <ul class="flex">
            <li class="hover:text-indigo-400">Home</li>
            <li class="hover:text-indigo-400">About</li>
            <li class="hover:text-indigo-400">Blogs</li>
            <li class="hover:text-indigo-400">Contact Us</li>
        </ul>
    </nav>
</template>

<script setup>
import axios from "axios";

const postUuid = '1234-smth-6969-test';

axios
    .get(`/comments?postUuid=${postUuid}`)
    .then((response) => console.log(response.data));

</script>
