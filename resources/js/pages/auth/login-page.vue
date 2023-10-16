<template>
    <div>
        <form-container>
            <form-card>
                <template #title>
                    Inloggen
                </template>
                <template #content>
                    <login-form
                        :status="status"
                        :can-reset-password="canResetPassword"
                    />
                </template>
            </form-card>
        </form-container>
    </div>
</template>

<script setup>
    import FormCard from "@/components/utilities/form-card.vue";
    import FormContainer from "@/components/utilities/form-container.vue";
    import LoginForm from "@/components/auth/login-form.vue";

    const props = defineProps({
        canResetPassword: Boolean,
        status: String,
    });
</script>
