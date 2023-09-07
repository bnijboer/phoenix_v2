import {defineStore} from "pinia";
import axios from "axios";

export const useSecurityStore = defineStore('security', {
    state: () => ({
        user: null,
        isLoggedIn: false,
    }),

    actions: {
        async getUser() {
            try {
                const response = await axios.get('/user');

                this.user = response.data.data;
                this.isLoggedIn = true;

                return this.user;
            } catch (error) {
                return error;
            }
        },

        async login(formData) {
            try {
                await axios.post(route('/login'), formData, {
                    withCredentials: true
                });

                this.isLoggedIn = true;
            } catch (error) {
                return error;
            }
        },

        async register(formData) {
            try {
                await axios.post(route('/register'), formData);
            } catch (error) {
                return error;
            }
        },

        async logout() {
            try {
                await axios.post('/logout');

                this.user = null;
            } catch(error) {
                return error;
            }
        },
    },
});
