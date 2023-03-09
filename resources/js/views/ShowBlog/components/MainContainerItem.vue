<template>
    <div class="blog__holder">
        <div class="blog__header">
            <div class="blog__header--inner-left">
                <img class="blog__header__image--profilePicture" :src="defaultProfilePicture" alt="" loading="lazy"> 
                <span class="blog__header__text blog__header__text--username">@Gebruikersnaam</span> 
            </div>

            <div class="blog__header--inner-right">
                <span class="blog__header__text blog__header__text--timestamp">{{blog.created_at}}</span> 

                <div v-if="user !== null">
                    <div v-if="user.id === blog.user_id">
                        <button @click="editBlog()"><img class="blog__header__image blog__header__image--edit" :src="defaultEditIcon"></button>
                        <button @click="deleteBlog()"><img class="blog__header__image blog__header__image--delete" :src="defaultDeleteIcon"></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="blog__content">
            <img class="blog__content blog__content--image" :src="(blog.coverFile !== '') ? 'storage/BlogPictures/' + blog.coverFile : defaultBlogPicture" alt="coverImage" loading="lazy">
            <p class="blog__content blog__content--title">{{blog.title}}</p>
            <p class="blog__content blog__content--description">{{blog.description}}</p> 
            <button class="blog__content blog__content--button">Lees verder</button>
        </div>

        <div class="blog__comments">  
                <div class="blog__comments__existingComment">   
                    <div v-if="blog.comment !== null">
                        <div v-for="comments in blog.comments">
                            <img class="blog__comments blog__comments--profilePicture" :src="(comments.user.profile_picture !== '') ? 'storage/ProfilePictures/' + comments.user.profile_picture : defaultBlogPicture" alt="profilePicture" loading="lazy">
                            <span class="blog__comments blog__comments__existingComment--text">{{comments.comment}}</span>
                        </div>
                    </div>
                </div>

            <div class="blog__comments__add">
                <img class="blog__comments blog__comments--profilePicture" :src="defaultProfilePicture">
                <input class="blog__comments blog__comments--text" type="text" v-model="comment" placeholder="Schrijf een opmerking...">
                <button @click="addComment()">Plaats comment</button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import defaultProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import defaultBlogPicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import defaultEditIcon from '../../../../assets/draw.png'
    import defaultDeleteIcon from '../../../../assets/bin.png'
</script>

<script>
    import axios from 'axios'
    export default {
        name: "MainContainerItem",
        props: [
            'blog',
            'user',
            'comments'
        ],
        data() {
            return {
                'comment': null,
                'user_id': this.user.id,
                // 'user_id': 1,
                'posts_id': this.blog.id
            };
        },

        methods: {
            /* add a comment to a blog */
            addComment() {
			    axios.post('/api/blog/posts/' + this.posts_id + '/comment', {
                    'comment': this.comment,
                    'user_id': this.user_id,
                    'posts_id': this.posts_id
				})
                 /* reload the page */
                 .then((response) =>  {  
                    console.log(response)
                    location.reload();
                    this.blog.id = response.data.id 
                })
                .catch(function (error) {  
                    console.log(error);
                });
			},

            /* go to the destroy route with the id */
            deleteBlog() {
            axios.delete('/api/blog/destroy/' + this.blog.id, {
                    'id': this.id,
                },
                {
                    headers: { "Content-Type" : "application/json"}
                })
                /* reload the page */
                .then((response) =>  {  
                    console.log(response)
                    location.reload();
                    this.blog.id = response.data.id 
                })
                .catch(function (error) {  
                    console.log(error);
                });
            },

            /* go to the edit route */
            editBlog(){
                this.$router.push('/edit/' + this.blog.id);
            },
        }
    }
</script>
