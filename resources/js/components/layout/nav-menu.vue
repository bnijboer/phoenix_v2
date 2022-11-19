<template>
    <nav>
        <ul class="flex space">
            <li class="mx-2">
                <nav-link :url="'/'">Home</nav-link>
            </li>
            <li class="mx-2">
                <nav-link :url="'/about'">About</nav-link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import NavLink from "../ui/nav-link";
</script>
