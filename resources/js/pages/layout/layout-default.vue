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

        <BaseFooter class="mt-8" />
    </div>
</template>

<script setup>
    import BaseSidebar from "@/pages/layout/base-sidebar.vue";
    import BaseHeader from "@/pages/layout/base-header.vue";
    import BaseFooter from "@/pages/layout/base-footer.vue";
</script>
