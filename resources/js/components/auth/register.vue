<template>
    <form-modal
        v-model="showModal"
        @confirm="register"
        @cancel="cancel"
        :actions="actions"
    >
        <template #title>Account aanmaken</template>

        <validator :rules="rules">
            <form @submit.prevent>
                <input-component
                    v-model="form.name"
                    type="text"
                    name="name"
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
        </validator>
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
    import {max, email, hasNoScriptTags, password, passwordEqual, required} from "../../config/validation-rules";
    import Validator from "../utilities/validator";

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

    const rules = {
        username: [required, (v) => max(v, 20), hasNoScriptTags],
        email: [required, email],
        password: [required, password],
        password_confirmation: [required, password, (v, otherPassword) => passwordEqual(v, otherPassword)],
    };

    const errors = reactive({
        'name': [],
        'email': [],
        'password': [],
        'password_confirmation': [],
    });

    async function register() {
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
</script>
