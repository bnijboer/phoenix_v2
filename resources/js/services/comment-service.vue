<script>
    import axios from "axios";


    export default {
        async createComment(entryId, commentRequest) {
            return await axios.post(
                route('comments.store', {
                    entryId: entryId
                }),
                commentRequest
            );
        }
    }
</script>
