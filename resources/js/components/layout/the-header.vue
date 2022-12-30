<template>
    <header>
        <nav class="absolute flex justify-end w-screen top-0 p-4">
<!--            <ul class="flex space-x-8">-->
<!--                <li class="flex items-center">-->
<!--                    <nav-link :url="'/'">-->
<!--                        Home-->
<!--                    </nav-link>-->
<!--                </li>-->
<!--            </ul>-->

            <button
                v-if="user"
                class="btn-default"
                @click="logout"
            >
                Uitloggen
            </button>
        </nav>

        <div class="flex">
            <a href="/">
                <img
                    alt="Logo"
                    src="/assets/logo.png"
                    class="logo"
                >
            </a>

            <div class="grow flex items-center">
                <span class="blog-title ml-8">The Goddess In Me</span>
            </div>
        </div>
    </header>
</template>

<script setup>
    import NavLink from "../ui/nav-link";
    import {useSecurityStore} from "../../store/security-store";
    import {onBeforeMount, ref} from "vue";

    const securityStore = useSecurityStore();

    const user = ref(null);

    onBeforeMount(async () => {
        user.value = await securityStore.getUser();
    });

    function logout() {
        securityStore.logout();
    }
</script>
