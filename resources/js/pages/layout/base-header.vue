<template>
    <div class="sticky top-0 z-2 bg-white p-2 header">
        <Link
            :href="route('posts.index')"
            style="text-decoration: none;"
        >
            <img
                src="/assets/logo.png"
                alt="Logo"
                class="image-center max-w-5rem max-h-5rem"
            >
        </Link>

        <div class="flex justify-content-between my-4 px-2">
            <nav class="flex align-items-center">
                <Link
                    :href="route('posts.index')"
                    class="px-2 mr-2"
                    style="text-decoration: none;"
                >
                    Home
                </Link>

                <button-secondary
                    v-if="$page.props.auth.user"
                    class="px-2 mr-2"
                    @click="logout"
                    label="Uitloggen"
                ></button-secondary>
                <div v-else>
                    <Link
                        :href="'/login'"
                        class="px-2 mr-2"
                        style="text-decoration: none;"
                    >
                        Inloggen
                    </Link>

                    <Link
                        :href="'/register'"
                        class="px-2 mr-2"
                        style="text-decoration: none;"
                    >
                        Registeren
                    </Link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script setup>
    import {Link, router} from '@inertiajs/vue3'
    import ButtonSecondary from "@/components/utilities/button-secondary.vue";

    function logout() {
        router.post(route('logout'));
    }
</script>
