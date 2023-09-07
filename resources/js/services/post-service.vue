<script>
    import axios from "axios";

    export default {
        async getPostSuggestions() {
            const response = await axios.get(
                route('posts.suggestions')
            );

            return response.data.data;
        },

        async updateReaderCount(entryId) {
            const response = await axios.post(
                route('posts.update-reader-count', entryId)
            );

            return response.data.data;
        }
    }
</script>
