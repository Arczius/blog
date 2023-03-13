<template>
    <div class="blog__holder">
        <div class="blog__header">
            <div class="blog__header--inner-left">
                <template v-if="users">
                    <img class="blog__header__image--profilePicture" :src="(users.profile_picture !== '') ? '../../storage/ProfilePictures/' + users.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
                    <span class="blog__header__text blog__header__text--username">@{{users.handle}}</span> 
                </template>

                <div v-if="this.$route.path == '/home'" class="blog__header--inner-left">
                    <img class="blog__header__image--profilePicture" :src="(blog.profile_picture !== '') ? '../../storage/ProfilePictures/' + blog.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
                    <span class="blog__header__text blog__header__text--username">@{{blog.handle}}</span> 
                </div>

            </div>

            <div class="blog__header--inner-right">
                <span class="blog__header__text blog__header__text--timestamp">{{blog.created_at}}</span> 
                <button @click="editBlog()"><img class="blog__header__image blog__header__image--edit" :src="defaultEditIcon"></button>
                <button @click="deleteBlog()"><img class="blog__header__image blog__header__image--delete" :src="defaultDeleteIcon"></button>
            </div>
        </div>

        <div class="blog__content">
            <img class="blog__content blog__content--image" :src="(blog.coverFile !== '') ? 'storage/BlogPictures/' + blog.coverFile : defaultBlogPicture" alt="coverImage" loading="lazy">
            <p class="blog__content blog__content--title">{{blog.title}}</p>
            <p class="blog__content blog__content--description">{{blog.description}}</p> 
            <button class="blog__content blog__content--button">Lees verder</button>
        </div>

        <div class="blog__comments">
            <template v-if="users">
                <img class="blog__comments blog__comments--profilePicture" :src="(users.profile_picture !== '') ? '../../storage/ProfilePictures/' + users.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
            </template>
            <input class="blog__comments blog__comments--text" type="text" placeholder="Schrijf een opmerking...">
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
        'users'
    ],

    data() {
        return {
            
        };
    },

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
