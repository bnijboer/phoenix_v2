<template>
    <header>
        <nav class="nav-bar">
<!--            <ul class="flex space-x-8">-->
<!--                <li class="flex items-center">-->
<!--                    <nav-link :url="'/'">-->
<!--                        Home-->
<!--                    </nav-link>-->
<!--                </li>-->
<!--            </ul>-->

            <button
                v-if="user"
                class="btn-success"
                @click="logout"
            >
                Uitloggen
            </button>
        </nav>

        <div>
            <a class="inline-flex" href="/">
                <img
                    alt="Logo"
                    src="/assets/logo.png"
                    class="logo"
                >

                <div class="banner">
                    <div class="banner-text">The Goddess In Me</div>
                </div>
            </a>
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
