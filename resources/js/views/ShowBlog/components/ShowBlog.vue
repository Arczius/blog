<template>
    <div class="blog__header">
        <img class="blog__header__image--profilePicture" :src="ProfilePicture">
        <span class="blog__header__text blog__header__text--username">@Gebruikersnaam</span>
        <span class="blog__header__text blog__header__text--timestamp">25 minuten geleden</span>
        <span><img  class="blog__header__image blog__header__image--edit" :src="defaultEditIcon"></span>
        <span ><img class="blog__header__image blog__header__image--delete" :src="defaultDeleteIcon"></span>
    </div>

    <div class="blog__content">
        <img class="blog__content--image" :src="ProfilePicture">
        <p class="blog__content--title">Dit is de titel van een blog</p>
        <textarea class="blog__content--description"></textarea>
        <button class="blog__content--button">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pretium elit rhoncus nulla pulvinar lacinia.</button>
    </div>
</template>


<script setup>
    import ProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import defaultEditIcon from '../../../../assets/bin.png'
    import defaultDeleteIcon from '../../../../assets/draw.png'
</script>

<script>
export default {
    name: "ShowBlog",

    data(){
        return {

        }
    },

    methods: {

    }
}
</script>
