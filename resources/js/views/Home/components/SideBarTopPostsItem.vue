<template>
    <div class="item">
        <div class="item__left">
            <router-link :to="'/profile/user/' + user.id">
                <img class="item__left--image" :src="(user !== null && user.profile_picture !== null) ? '/storage/ProfilePictures/' + user.profile_picture : Tyler" alt="">
            </router-link>
        </div>
        <div class="item__right">

            <router-link :to="'/profile/user/' + user.id">
                <h5 class="item__right--username">@{{ (user !== null) ? user.handle : "Gebruikersnaam" }}</h5>
            </router-link>

            <router-link :to="'/detail/' + post.id">
                <h2 class="item__right--title">{{ post.title }}</h2>
            </router-link>
            <p class="item__right--description">{{ post.description }}</p>
        </div>
    </div>
</template>

<script setup>
import Tyler from "../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
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
