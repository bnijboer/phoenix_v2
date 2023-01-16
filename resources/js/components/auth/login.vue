<template>
    <form-modal
        v-model="showModal"
        @confirm="login"
        @cancel="cancel"
        :actions="actions"
    >
        <template #title>Inloggen</template>

        <base-form :rules="rules" :request="request" @validate="login">
            <base-input
                v-model="request.email"
                type="email"
                name="email"
                autofocus
            >
                E-mail
            </base-input>

            <p v-if="errors.email" class="validation-error">
                {{ errors.email }}
            </p>

            <base-input
                v-model="request.password"
                type="password"
                name="password"
                class="mt-4"
            >
                Wachtwoord
            </base-input>

            <p v-if="errors.password" class="validation-error">
                {{ errors.password }}
            </p>

<!--            <div class="block mt-4">-->
<!--                <label class="flex items-center">-->
<!--                    <base-checkbox name="remember" v-model:checked="request.remember" />-->
<!--                    <span class="ml-2 text-sm text-gray-600">Onthoud mij</span>-->
<!--                </label>-->
<!--            </div>-->
        </base-form>
    </form-modal>

    <div class="flex justify-center">
        <button class="button button-success" @click="showModal = true">Inloggen</button>
    </div>
</template>

<script setup>
    import {useSecurityStore} from "../../store/security-store";
    import FormModal from "../modals/form-modal";
    import {reactive, ref} from "vue";
    import BaseCheckbox from "../utilities/base-checkbox";
    import BaseForm from "../utilities/base-form";
    import BaseInput from "../utilities/base-input";

    const props = defineProps({
        // canResetPassword: Boolean,
        status: String,
    });

    const userStore = useSecurityStore();

    const showModal = ref(false);
    const request = reactive({
        email: '',
        password: '',
        remember: false
    });

    const actions = {
        confirm: 'Log in',
        cancel: 'Annuleren',
    }

    const rules = {
        email: ['required', 'email'],
        password: ['required'],
    };

    let errors = ref({});

    async function login(form) {
        errors.value = form.errors;

        if (!form.validated) {
            return;
        }

        try {
            await userStore.login(request);

            showModal.value = false;
        } catch(error) {
            console.log(error.message);
        }
    }

    function cancel(close) {
        close();
    }
</script>
