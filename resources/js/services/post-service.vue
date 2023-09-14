<script>
    import axios from "axios";
    import route from "ziggy-js";

    export default {
        async getPostSuggestions() {
            return await axios.get(
                route('posts.suggestions')
            );
        },

        async updateReaderCount(entryId) {
            return await axios.post(
                route('posts.update_reader_count', entryId)
            );
        }
    }
</script>
