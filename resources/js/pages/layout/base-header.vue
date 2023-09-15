<template>
    <div class="sticky top-0 z-2 bg-white p-2">
        <Link
            :href="route('pages.index')"
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
                    :href="route('pages.index')"
                    class="px-2 mr-2"
                    style="text-decoration: none;"
                >
                    Home
                </Link>

                <span v-if="$page.props.auth.user">
                    <Button
                        class="px-2 mr-2"
                        @click="logout"
                    >
                        Uitloggen
                    </Button>
                </span>
                <div v-else>
                    <Link
                        :href="route('pages.login')"
                        class="px-2 mr-2"
                        style="text-decoration: none;"
                    >
                        Inloggen
                    </Link>

                    <Link
                        :href="route('pages.register')"
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
    import Button from 'primevue/button';
    import route from "ziggy-js";

    function logout() {
        router.post(route('logout'));
    }
</script>
