<template>
    <div>
        <BaseHeader></BaseHeader>

        <div class="grid">
            <div class="col-12 md:col-9">
                <main class="pt-8 px-8">
                    <slot />
                </main>
            </div>

            <div class="hidden md:block col-3">
                <BaseSidebar></BaseSidebar>
            </div>
        </div>

        <footer class="flex justify-content-center">
            <div class="p-4">
                © Brendan Nijboer 2023
            </div>
        </footer>
    </div>
</template>

<script setup>
    import BaseSidebar from "@/pages/layout/base-sidebar.vue";
    import BaseHeader from "@/pages/layout/base-header.vue";
</script>
