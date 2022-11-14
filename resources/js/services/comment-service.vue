<script>
    import axios from "axios";

    export default {
        async getComments(postUuid) {
            return await axios.get(`/comments?postUuid=${postUuid}`)
                .then((response) => response.data)
                .catch((error) => console.log(error.message));
        },

        async createComment(postUuid, commentRequest) {
            return await axios.post(`/comments?postUuid=${postUuid}`, commentRequest)
                .then((response) => response.data)
                .catch((error) => console.log(error.message));
        }
    }
</script>
