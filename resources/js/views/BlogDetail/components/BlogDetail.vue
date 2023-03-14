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
                <span class="blog__header__text blog__header__text--timestamp">{{blogs.created_at}}</span>
                <button @click="editBlog()"><img class="blog__detail__header__image blog__detail__header__image--edit" :src="defaultEditIcon"></button>
                <button @click="deleteBlog()"><img class="blog__detail__header__image blog__detail__header__image--delete" :src="defaultDeleteIcon"></button>
            </div>
        </div>

        <div class="blog__detail__content">
            <p class="blog__detail__content blog__detail__content--title">{{blogs.title}}</p>
            <p class="blog__detail__content blog__detail__content--description">{{blogs.description}}</p>
            <img class="blog__detail__content blog__detail__content--image" :src="(blogs.coverFile !== '') ? '../../storage/BlogPictures/' + blogs.coverFile : defaultBlogPicture" alt="coverImage" loading="lazy">
            <img class="blog__detail__content blog__detail__content--image" :src="(blogs.coverFile !== '') ? '../../storage/BlogPictures/' + blogs.file : defaultBlogPicture" alt="Image" loading="lazy">
        </div>

        <div class="blog__detail__comments">
            <span class="blog__detail__comments blog__detail__comments--textComment">Reacties</span>

            <div class="blog__detail__commentsDiv">
                <img class="blog__detail__comments blog__detail__comments--profilePicture" :src="defaultCommentIcon">
                <input class="blog__detail__comments blog__detail__comments--text" type="text" placeholder="Schrijf een reactie...">
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
        ],

        methods: {
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
                    location.reload();
                    this.blog.id = response.data.id
                })
                .catch(function (error) {
                    console.warn(error);
                });
            },

            /* go to the edit route */
            editBlog(){
                this.$router.push('/edit/' + this.blog.id);
            },
        }
    };
</script>
