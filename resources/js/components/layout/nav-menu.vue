<template>
    <nav class="py-4">
        <ul class="flex space-x-8">
            <li class="flex items-center">
                <nav-link :url="'/'">
                    Home
                </nav-link>
            </li>
            <li v-if="user" class="flex items-center">
                <button class="btn-default" @click="logout">Uitloggen</button>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import NavLink from "../ui/nav-link";
import {useSecurityStore} from "../../store/security-store";
import {computed} from "vue";

const user = computed(() => useSecurityStore().user);

function logout() {
    useSecurityStore().logout();
}
</script>
