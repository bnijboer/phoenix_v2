<script>
    import axios from "axios";

    export default {
        async getComments(postUuid) {
            const response = await axios.get(`/comments?postUuid=${postUuid}`);

            return response.data.data;
        },

        async createComment(postUuid, commentRequest) {
            await axios.post(`/comments?postUuid=${postUuid}`, commentRequest);
        }
    }
</script>
