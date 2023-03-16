<template>
    <div class="item">
        <div class="item__left">
            <img class="item__left--image" :src="(user !== null && user.profile_picture !== null) ? '/storage/ProfilePictures/' + user.profile_picture : tyler" alt="">
        </div>
        <div class="item__right">
            <h5 class="item__right--username">@{{ (user !== null) ? user.handle : "Gebruikersnaam" }}</h5>
            <h2 class="item__right--title">{{post.title}}</h2>
            <p class="item__right--description">{{post.description}}</p>
        </div>
    </div>
</template>

<script setup>
    import tyler from "../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
</script>

<script>
    export default {
        name: "SideBarTopPostsItem",
        props: {
            user: {
                default: null,
                type: Object,
            },
            post: {
                default: null,
                type: Object,
            }
        }
    }
</script>
