<template>
    <div>
        <base-header />

        <div class="grid pt-2">
            <div class="col-12 md:col-9">
                <main class="px-8">
                    <slot />
                </main>
            </div>

            <div class="hidden md:block col-3">
                <base-sidebar />
            </div>
        </div>

        <base-footer class="mt-8" />

        <Toast
            position="bottom-right"
            group="flash"
        />
    </div>
</template>

<script setup>
    import Toast from 'primevue/toast';
    import BaseSidebar from "@/pages/layout/base-sidebar.vue";
    import BaseHeader from "@/pages/layout/base-header.vue";
    import BaseFooter from "@/pages/layout/base-footer.vue";
</script>
