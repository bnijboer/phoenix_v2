<template>
    <form-modal
        v-model="showModal"
        @confirm="login"
        @cancel="cancel"
        :actions="actions"
    >
        <template #title>Account aanmaken</template>

        <form @submit.prevent>
            <input-component
                v-model="form.name"
                type="text"
                name="name"
                required
                autofocus
            >
                Gebruikersnaam
            </input-component>

            <ul v-if="errors.name.length" class="mt-1 text-xs text-red-600">
                <li v-for="(errorMessage, index) in errors.name" :key="index">
                    {{ errorMessage }}
                </li>
            </ul>

            <input-component
                v-model="form.email"
                type="email"
                name="email"
                required
                class="mt-4"
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

            <input-component
                v-model="form.password_confirmation"
                type="password"
                name="password_confirmation"
                required
                class="mt-4"
            >
                Wachtwoord bevestigen
            </input-component>

            <ul v-if="errors.password_confirmation.length" class="mt-1 text-xs text-red-600">
                <li v-for="(errorMessage, index) in errors.password_confirmation" :key="index">
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

    <div class="text-center">
        <div>Heb je nog geen account?</div>
        <div>Klik <a class="cursor-pointer underline text-center" @click="showModal = true">hier</a> om er een te maken.</div>
    </div>
</template>

<script setup>
    import Checkbox from "../utilities/checkbox";
    import {useSecurityStore} from "../../store/security-store";
    import FormModal from "../modals/form-modal";
    import {reactive, ref} from "vue";
    import InputComponent from "../utilities/input-component";

    const form = reactive({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        remember: false
    });

    const userStore = useSecurityStore();

    const showModal = ref(false);

    const actions = {
        confirm: 'Registreren',
        cancel: 'Annuleren',
    }

    const errors = reactive({
        'name': [],
        'email': [],
        'password': [],
        'password_confirmation': [],
    });

    async function login() {
        errors.email = [];
        errors.password = [];

        validate();

        if (errors.email.length) {
            return;
        }

        try {
            await userStore.register(form);

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
