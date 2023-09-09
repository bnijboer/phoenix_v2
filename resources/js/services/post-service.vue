<script>
    import axios from "axios";
    import route from "ziggy-js";

    export default {
        async getPostSuggestions() {
            const response = await axios.get(
                route('posts.suggestions')
            );

            return response.data.data;
        },

        async updateReaderCount(entryId) {
            const response = await axios.post(
                route('posts.update_reader_count', entryId)
            );

            return response.data.data;
        }
    }
</script>
