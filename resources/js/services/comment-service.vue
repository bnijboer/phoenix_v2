<script>
    import axios from "axios";

    export default {
        async getComments(postUuid) {
            const response = await axios.get(`/comments?postUuid=${postUuid}`);

            return response.data.data;
        },

        async createComment(postUuid, commentRequest) {
            const response = await axios.post(`/comments?postUuid=${postUuid}`, commentRequest);

            return response.data.data;
        }
    }
</script>
