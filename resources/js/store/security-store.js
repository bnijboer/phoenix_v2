import {defineStore} from "pinia";
import axios from "axios";

export const useSecurityStore = defineStore('security', {
    state: () => ({
        user: null,
    }),

    actions: {
        async getUser() {
            if (!this.user) {
                const response = await axios.get('/user');

                this.user = await response.data;
            }

            return this.user;
        },

        async login(formData) {
            try {
                await axios.post('/login', formData);
            } catch (error) {
                console.log(error);
                return error;
            }
        },

        async register(formData) {
            try {
                await axios.post('/register', formData);
            } catch (error) {
                console.log(error);
                return error;
            }
        },

        async logout() {
            try {
                await axios.post('/logout');

                this.user = null;
            } catch(error) {
                console.log(error);
                return error;
            }
        },
    },
});
