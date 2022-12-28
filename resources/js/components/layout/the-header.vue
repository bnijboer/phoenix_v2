<template>
    <header class="flex h-72">
        <a
            href="/"
        >
            <img
                alt="Logo"
                src="/assets/logo.png"
                class="logo"
            >
        </a>

        <div class="flex flex-col justify-end mx-auto lg:ml-96">
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
        </div>
    </header>
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
