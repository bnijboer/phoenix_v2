<script>
    export default {
        async createComment(entryId, formData) {
            return await axios.post(
                route('comments.store', {
                    entryId: entryId
                }),
                formData
            );
        }
    }
</script>
