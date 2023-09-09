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

            <form @submit.prevent="onSubmit">
                <span class="p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText
                        v-model="query"
                        placeholder="Wat zoek je?"
                    />
                </span>

                <Button
                    type="submit"
                    label="Zoeken"
                    class="ml-2"
                />
            </form>
        </div>
    </div>
</template>

<script setup>
    import {Link, router} from '@inertiajs/vue3'
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';
    import route from "ziggy-js";
    import {ref} from "vue";

    const query = ref(null);

    function logout() {
        router.post('/logout');

        // securityStore.logout();

        // window.location.reload();
    }

    function onSubmit() {
        router.get(
            route('pages.index', { query: query.value })
        );
    }
</script>
