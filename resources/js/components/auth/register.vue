<template>
    <div>
        <form @submit.prevent="submit">
            <div>
                <input-label for="name" value="Gebruikersnaam" />
                <text-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <!--                <input-error class="mt-2" :message="form.errors.email" />-->
            </div>

            <div>
                <input-label for="email" value="E-mail" />
                <text-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                <!--                <input-error class="mt-2" :message="form.errors.email" />-->
            </div>

            <div class="mt-4">
                <input-label for="password" value="Wachtwoord" />
                <text-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required />
                <!--                <input-error class="mt-2" :message="form.errors.password" />-->
            </div>

            <div class="mt-4">
                <input-label for="password_confirmation" value="Wachtwoord bevestigen" />
                <text-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required />
                <!--                <input-error class="mt-2" :message="form.errors.password" />-->
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <primary-button class="ml-4">
                    Register
                </primary-button>
            </div>
        </form>
    </div>
</template>

<script setup>
import AuthenticationService from "../../services/authentication-service";
import Checkbox from "../utilities/checkbox"
import InputError from "../utilities/input-error";
import InputLabel from "../utilities/input-label";
import PrimaryButton from "../utilities/primary-buton"
import TextInput from "../utilities/text-input";

const form = {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    remember: false
};

const submit = () => {
    AuthenticationService.register(form)
        .then((response) => console.log(response));
};
</script>
