<script>
    import axios from "axios";

    export default {
        async getComments(entryId) {
            const response = await axios.get(
                route('comments.index', {
                    entryId: entryId
                })
            );

            return response.data.data;
        },

        async createComment(entryId, commentRequest) {
            const response = await axios.post(
                route('comments.store', {
                    entryId,
                    commentRequest
                })
            );

            return response.data.data;
        }
    }
</script>
