<template>
    <div class="z-2">
        <Link
            href="/posts"
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
                    href="/posts"
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
                        href="/login"
                        class="px-2 mr-2"
                        style="text-decoration: none;"
                    >
                        Inloggen
                    </Link>

                    <Link
                        href="/register"
                        class="px-2 mr-2"
                        style="text-decoration: none;"
                    >
                        Registeren
                    </Link>
                </div>
            </nav>

            <InputText placeholder="Search" type="text" />
        </div>

<!--        <Menubar ref="menu" id="overlay_menu" :model="items" :popup="true">-->
<!--            <template #end>-->
<!--            </template>-->
<!--        </Menubar>-->
    </div>
</template>

<script setup>
    import {onBeforeMount, ref} from "vue";
    import {Link, router} from '@inertiajs/vue3'
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';

    function logout() {
        router.post('/logout');

        // securityStore.logout();

        // window.location.reload();
    }
</script>
