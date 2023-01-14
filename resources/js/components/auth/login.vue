<template>
    <form-modal
        v-model="showModal"
        @confirm="login"
        @cancel="cancel"
        :actions="actions"
    >
        <template #title>Inloggen</template>

        <validator :rules="rules">
            <form @submit.prevent>
                <input-component
                    v-model="form.email"
                    type="email"
                    name="email"
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
        </validator>
    </form-modal>

    <div class="flex justify-center">
        <button class="button button-success" @click="showModal = true">Inloggen</button>
    </div>
</template>

<script setup>
    import Checkbox from "../utilities/checkbox";
    import {useSecurityStore} from "../../store/security-store";
    import FormModal from "../modals/form-modal";
    import {reactive, ref} from "vue";
    import InputComponent from "../utilities/input-component";
    import Validator from "../utilities/validator";
    import {required, email} from "../../config/validation-rules";

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

    const rules = {
        email: [required, email],
        password: [required],
    };

    const errors = reactive({
        'email': [],
        'password': [],
    });

    async function login() {
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
</script>
