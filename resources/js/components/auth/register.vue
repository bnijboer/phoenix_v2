<template>
    <form-modal
        v-model="showModal"
        @confirm="register"
        @cancel="cancel"
        :actions="actions"
    >
        <template #title>Account aanmaken</template>

        <base-form :rules="rules" :request="request" @validate="register">
            <base-input
                v-model="request.name"
                type="text"
                name="name"
                autofocus
            >
                Gebruikersnaam
            </base-input>

            <p v-if="errors.name" class="validation-error">
                {{ errors.name }}
            </p>

            <base-input
                v-model="request.email"
                type="email"
                name="email"
                class="mt-4"
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

            <base-input
                v-model="request.password_confirmation"
                type="password"
                name="password_confirmation"
                class="mt-4"
            >
                Wachtwoord bevestigen
            </base-input>

            <p v-if="errors.password_confirmation" class="validation-error">
                {{ errors.password_confirmation }}
            </p>

            <!--            <div class="block mt-4">-->
            <!--                <label class="flex items-center">-->
            <!--                    <base-checkbox name="remember" v-model:checked="request.remember" />-->
            <!--                    <span class="ml-2 text-sm text-gray-600">Onthoud mij</span>-->
            <!--                </label>-->
            <!--            </div>-->
        </base-form>
    </form-modal>

    <div class="text-center">
        <div>Heb je nog geen account?</div>
        <div>Klik <a class="cursor-pointer underline text-center" @click="showModal = true">hier</a> om er een te maken.</div>
    </div>
</template>

<script setup>
    import {useSecurityStore} from "../../store/security-store";
    import FormModal from "../modals/form-modal.vue";
    import {reactive, ref} from "vue";
    import BaseCheckbox from "../utilities/base-checkbox.vue";
    import BaseForm from "../utilities/base-form.vue";
    import BaseInput from "../utilities/base-input.vue";

    const request = reactive({
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
        username: ['required', 'max:20', 'hasNoScriptTags'],
        email: ['required', 'email'],
        password: ['required', 'password'],
        password_confirmation: ['required', 'password', `passwordEqual:${request.password}`],
    };

    let errors = ref({});

    async function register(form) {
        // errors.value = form.errors;
        //
        // if (!form.validated) {
        //     return;
        // }

        await userStore.register(request);

        // showModal.value = false;

        window.location.reload();
    }

    function cancel(close) {
        close();
    }
</script>
