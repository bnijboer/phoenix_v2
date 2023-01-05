<template>
    <form-modal
        v-model="showModal"
        @confirm="login"
        @cancel="cancel"
        :actions="actions"
    >
        <template #title>Inloggen</template>

        <form @submit.prevent>
            <input-component
                v-model="form.email"
                type="email"
                name="email"
                required
                autofocus
            >
                E-mail
            </input-component>

            <ul v-if="errors.email.length" class="mt-1 text-xs text-red-600">
                <li v-for="(errorMessage, index) in errors.email" :key="index">
                    {{ errorMessage }}
                </li>
            </ul>

            <input-component
                v-model="form.password"
                type="password"
                name="password"
                required
                class="mt-4"
            >
                Wachtwoord
            </input-component>

            <ul v-if="errors.password.length" class="mt-1 text-xs text-red-600">
                <li v-for="(errorMessage, index) in errors.password" :key="index">
                    {{ errorMessage }}
                </li>
            </ul>

<!--            <div class="block mt-4">-->
<!--                <label class="flex items-center">-->
<!--                    <checkbox name="remember" v-model:checked="form.remember" />-->
<!--                    <span class="ml-2 text-sm text-gray-600">Onthoud mij</span>-->
<!--                </label>-->
<!--            </div>-->
        </form>
    </form-modal>

    <div class="flex justify-center">
        <button class="btn-success" @click="showModal = true">Inloggen</button>
    </div>
</template>

<script setup>
    import Checkbox from "../utilities/checkbox";
    import {useSecurityStore} from "../../store/security-store";
    import FormModal from "../modals/form-modal";
    import {reactive, ref} from "vue";
    import InputComponent from "../utilities/input-component";

    const props = defineProps({
        // canResetPassword: Boolean,
        status: String,
    });

    const userStore = useSecurityStore();

    const showModal = ref(false);
    const form = reactive({
        email: '',
        password: '',
        remember: false
    });

    const actions = {
        confirm: 'Log in',
        cancel: 'Annuleren',
    }

    const errors = reactive({
        'email': [],
        'password': [],
    });

    async function login() {
        errors.email = [];
        errors.password = [];

        validate();

        if (errors.email.length) {
            return;
        }

        try {
            await userStore.login(form);

            showModal.value = false;
        } catch(error) {
            console.log(error.message);
        }
    }

    function cancel(close) {
        close();
    }

    function validate() {
        if (!required(form.email)) {
            errors.email.push('Dit veld is verplicht');
        }

        if (!isValidEmail(form.email)) {
            errors.email.push('Ongeldig e-mailadres');
        }

        if (!required(form.password)) {
            errors.password.push('Dit veld is verplicht');
        }
    }

    function required(v) {
        if (typeof v === 'object') {
            return false;
        }

        if (typeof v === 'boolean') {
            return false;
        }

        if (v === 0) {
            return false;
        }

        if (typeof v === 'string' && v.trim().length === 0) {
            return false;
        }

        return true;
    }

    function isValidEmail(v) {
        return (v ? /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) : true);
    }
</script>
