<template>
    <div class="blog__header">
        <img class="blog__header__image--profilePicture" :src="ProfilePicture">
        <span class="blog__header__text blog__header__text--username">@Gebruikersnaam</span>
        <span class="blog__header__text blog__header__text--timestamp">25 minuten geleden</span>
        <span><img class="blog__header__image blog__header__image--edit" :src="defaultEditIcon"></span>
        <span ><img class="blog__header__image blog__header__image--delete" :src="defaultDeleteIcon"></span>
    </div>

    <div class="blog__content">
        <img class="blog__content blog__content--image" :src="BlogPicture">
        <p class="blog__content blog__content--title">Dit is de titel van een blog</p>
        <p class="blog__content blog__content--description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pretium elit rhoncus nulla pulvinar lacinia.</p>
        <button class="blog__content blog__content--button">Lees verder</button>
    </div>

    <div class="blog__comments">
        <img class="blog__comments blog__comments--profilePicture" :src="ProfilePicture">
        <input class="blog__comments blog__comments--text" type="text" placeholder="Schrijf een opmerking...">
    </div>
</template>


<script setup>
    import ProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import BlogPicture from '../../../..//assets/lukas-blazek-GnvurwJsKaY-unsplash.jpg'
    import defaultEditIcon from '../../../../assets/draw.png'
    import defaultDeleteIcon from '../../../../assets/bin.png'
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
