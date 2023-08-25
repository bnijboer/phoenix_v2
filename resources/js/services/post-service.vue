<script>
import axios from "axios";

export default {
    async getPosts(page, limit) {
        const response = await axios.get(`/posts?page=${page}&limit=${limit}`);

        return response.data;
    },

    async getPost(postUuid) {
        const response = await axios.get(`/posts/${postUuid}`);

        return response.data.data;
    },
}
</script>
