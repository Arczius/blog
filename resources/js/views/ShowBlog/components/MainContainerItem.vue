<template>
    <div class="blog__holder">
        <div class="blog__header">
            <!-- <img class="blog__header__image--profilePicture" v-if="user.profile_picture !== ''" :src="user.profile_picture" alt="" loading="lazy"> 
            <img class="blog__header__image--profilePicture" v-else :src="DefaultProfilePicture" alt="" loading="lazy"> 

            <span class="blog__header__text blog__header__text--username">@{{user.username}}</span>  -->

            <img class="blog__header__image--profilePicture" :src="DefaultProfilePicture" alt="" loading="lazy"> 
            <span class="blog__header__text blog__header__text--username">@Gebruikersnaam</span> 

            <span class="blog__header__text blog__header__text--timestamp">{{blog.created_at}}</span> 
            <span><img class="blog__header__image blog__header__image--edit" :src="defaultEditIcon"></span>
            <button  @click="deleteBlog()"><img class="blog__header__image blog__header__image--delete" :src="defaultDeleteIcon"></button>
        </div>

        <div class="blog__content">
            <img class="blog__content blog__content--image" :src="(blog.coverFile !== '') ? 'storage/BlogPictures/' + blog.coverFile : DefaultBlogPicture" alt="coverImage" loading="lazy">
            <p class="blog__content blog__content--title">{{blog.title}}</p>
            <p class="blog__content blog__content--description">{{blog.description}}</p> 
            <button class="blog__content blog__content--button">Lees verder</button>
        </div>

        <div class="blog__comments">
            <img class="blog__comments blog__comments--profilePicture" :src="DefaultProfilePicture">
            <input class="blog__comments blog__comments--text" type="text" placeholder="Schrijf een opmerking...">
        </div>
    </div>
</template>

<script setup>
    import DefaultProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import DefaultBlogPicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import defaultEditIcon from '../../../../assets/draw.png'
    import defaultDeleteIcon from '../../../../assets/bin.png'
</script>

<script>
import axios from 'axios'
export default {
    name: "MainContainerItem",
    props: [
        'blog',
    ],
    data() {
        return {
        };
    },
    methods: {
        deleteBlog() {
           axios.delete('/api/blog/destroy/' + this.blog.id, {
                'id': this.id,
            },
            {
                headers: { "Content-Type" : "application/json"}
            })
            .then((response) =>  {  
                console.log(response)
                location.reload();
                this.blog.id = response.data.id 
            })
            .catch(function (error) {  
                console.log(error);
            });
        },
    }
}
</script>
