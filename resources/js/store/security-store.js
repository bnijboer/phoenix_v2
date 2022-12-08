import {defineStore} from "pinia";
import axios from "axios";

export const useSecurityStore = defineStore("security", {
    state: () => ({
        user: null,
    }),

    actions: {
        async getUser() {
            try {
                const response = await axios.get('/user');

                this.user = await response.data;
            } catch(error) {
                console.log(error.message);
            }
        },

        async login(formData) {
            try {
                const response = await axios.post('/login', formData);

                this.user = await response.data;
            } catch(error) {
                console.log(error.message);
            }
        },

        async register(formData) {
            try {
                const response = await axios.post('/register', formData);

                this.user = await response.data;
            } catch(error) {
                console.log(error.message);
            }
        },

        async logout() {
            try {
                await axios.post('/logout');

                this.user = null;
            } catch(error) {
                console.log(error.message);
            }
        },
    },
});
