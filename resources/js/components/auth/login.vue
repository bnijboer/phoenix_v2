<template>
    <div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <input-label for="email" value="E-mail" />
                <text-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
<!--                <input-error class="mt-2" :message="form.errors.email" />-->
            </div>

            <div class="mt-4">
                <input-label for="password" value="Wachtwoord" />
                <text-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
<!--                <input-error class="mt-2" :message="form.errors.password" />-->
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Onthoud mij</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!--            <a v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
                <!--                Forgot your password?-->
                <!--            </a>-->

<!--                <primary-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                    Log in-->
<!--                </primary-button>-->

                <primary-button class="ml-4">
                    Inloggen
                </primary-button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import Checkbox from "../utilities/checkbox"
    import InputError from "../utilities/input-error";
    import InputLabel from "../utilities/input-label";
    import PrimaryButton from "../utilities/primary-buton"
    import TextInput from "../utilities/text-input";
    import {useSecurityStore} from "../../store/security-store";

    defineProps({
        // canResetPassword: Boolean,
        status: String,
    });

    const userStore = useSecurityStore();

    const form = {
        email: '',
        password: '',
        remember: false
    };

    const submit = () => {
        userStore.login(form);
    };
</script>
