<template>
    <div class="blog__detail__holder">
        <div class="blog__detail__header">
            <div class="blog__detail__header--inner-left">
                <button class="blog__detail__header blog__header__categories">Creativiteit</button>
                <button class="blog__detail__header blog__header__categories">Cultuur</button>
                <button class="blog__detail__header blog__header__categories">Lifestyle</button>
                <button class="blog__detail__header blog__header__categories">Reizen</button>
            </div>

            <div class="blog__detail__header--inner-right">
                <span class="blog__header__text blog__header__text--timestamp">{{blogs[0].created_at}}</span>
                <!-- <button @click="editBlog()"><img class="blog__detail__header__image blog__detail__header__image--edit" :src="defaultEditIcon"></button>
                <button @click="deleteBlog()"><img class="blog__detail__header__image blog__detail__header__image--delete" :src="defaultDeleteIcon"></button> -->
            </div>
        </div>

        <div class="blog__detail__content">
            <p class="blog__detail__content blog__detail__content--title">{{blogs[0].title}}</p>
            <p class="blog__detail__content blog__detail__content--description">{{blogs[0].description}}</p>
            <img class="blog__detail__content blog__detail__content--image" :src="(blogs[0].coverFile !== '') ? '../../storage/BlogPictures/' + blogs[0].coverFile : defaultBlogPicture" alt="coverImage" loading="lazy">
            <img class="blog__detail__content blog__detail__content--image" :src="(blogs[0].coverFile !== '') ? '../../storage/BlogPictures/' + blogs[0].file : defaultBlogPicture" alt="Image" loading="lazy">
        </div>

        <div class="blog__detail__comments">
            <span class="blog__detail__comments blog__detail__comments--textComment">Reacties</span>

            <div v-if="blogs[0].comments !== null">
                <div v-for="comments in blogs[0].comments">
                    <img class="blog__comments blog__comments--profilePicture" :src="(comments.user.profile_picture !== '') ? '../../storage/ProfilePictures/' + comments.user.profile_picture : defaultBlogPicture" alt="profilePicture" loading="lazy">
                    <span class="blog__comments blog__comments__existingComment--text">{{comments.comment}}</span>
                    <span v-if="user !== null && user.id === comments.user_id">
                        <button @click="deleteComment()"><img class="blog__header__image blog__header__image--delete" :src="defaultDeleteIcon"></button>
                    </span>
                </div>
            </div>

            <div class="blog__detail__commentsDiv">
                <img class="blog__detail__comments blog__detail__comments--profilePicture" :src="defaultCommentIcon">
                <input class="blog__detail__comments blog__detail__comments--text" type="text" v-model="comment" placeholder="Schrijf een opmerking...">
                <button @click="addComment()">Plaats comment</button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import defaultBlogPicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import defaultCommentIcon from '../../../../assets/writing.png'
    import defaultEditIcon from '../../../../assets/draw.png'
    import defaultDeleteIcon from '../../../../assets/bin.png'
</script>

<script>
    import axios from 'axios'
    export default {
        name: "BlogDetail",
        props: [
            'blogs',
            'user'
        ],

        methods: {
            /* go to the destroy route with the id */
            deleteBlog() {
            axios.delete('/api/blog/destroy/' + this.blogs[0].id, {
                    'id': this.id,
                },
                {
                    headers: { "Content-Type" : "application/json"}
                })
                /* reload the page */
                .then((response) =>  {
                    location.reload();
                    this.blogs[0].id = response.data.id
                })
                .catch(function (error) {
                    console.warn(error);
                });
            },

            /* go to the edit route */
            editBlog(){
                this.$router.push('/edit/' + this.blogs[0].id);
            },

            /* add a comment to a blog */
            addComment() {
			    axios.post('/api/blog/posts/' + this.posts_id + '/comment', {
                    'comment': this.comment,
                    'user_id': this.user.id,
                    'posts_id': this.blogs[0].id
				})
                 /* reload the page */
                 .then((response) =>  {
                    this.$router.go()
                    this.blogs[0].id = response.data.id
                })
                .catch(function (error) {
                    console.warn(error);
                });
			},

            /* go to the destroy route with the id */
            deleteComment() {
                if(this.blogs[0].comments.length > 0){
                    var comment_id;
                        this.blogs[0].comments.forEach(comment => {
                            comment_id = comment.id
                        });
                }
                axios.delete('/api/blog/destroy/comment/' + comment_id, {
                    'id': this.blogComment_id,
                },)
                /* reload the page */
                .then((response) =>  {
                    this.$router.go()
                    this.blogs[0].id = response.data.id
                })
                .catch(function (error) {
                    console.warn(error);
                });
            },
        }
    };
</script>
