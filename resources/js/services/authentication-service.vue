<script>
import axios from "axios";

export default {
    async login(formData) {
        return await axios.post('/login', formData)
            .then(response => response.data)
            .catch(error => console.log(error.message));
    },

    async register(formData) {
        return await axios.post('/register', formData)
            .then(response => response.data)
            .catch(error => console.log(error.message));
    },

    async logout() {
        return await axios.post('/logout')
            .then(response => response.data)
            .catch(error => console.log(error.message));
    }
}
</script>
