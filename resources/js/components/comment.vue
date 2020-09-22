<template>
    <h3>Comments:</h3>
    <div style="margin-bottom:50px;">
        <label>
                                        <textarea class="form-control"
                                                  rows="3"
                                                  name="body"
                                                  placeholder="Leave a comment"
                                                  v-model="commentBox"></textarea>
        </label>
        <button class="btn btn-success"
                style="margin-top:10px"
                @click.prevent="postComment">Save Comment</button>
    </div>
</template>

<script>
const app = new Vue({
    el: '#app',
    data: {
        commentBox: '',
        comments: {},
        review: $review->toJson(),
          },

methods: {
    getComments() {
        console.log(this.commentBox)
        axios.get('/posts/'+ this.review.posts_id + '/' + this.review.id+'/comments')
            .then((response) => {
                this.comments = response.data
            })
            .catch(function (error) {
                    console.log(error);
                }
            );
    },
    mounted() {
        this.getComments();
    },
    postComment() {
        console.log('hello world!');
        axios.post('/reviews/'+ this.review.id+ '/comment', {
            // api_token: this.user.api_token,
            body: this.commentBox

        })
            .then((response) => {
                this.comments.unshift(response.data);
                this.commentBox = '';
            })
            .catch((error) => {
                console.log(error);

            })
    }
}
})
export default {
name: "comment"
}
</script>

<style scoped>

</style>
