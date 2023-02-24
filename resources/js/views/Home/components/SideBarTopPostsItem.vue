<template>
    <div class="item">
        <div class="item__left">
            <img class="item__left--image" :src="(user !== null) ? user.profile_picture : Tyler" alt="">
        </div>
        <div class="item__right">
            <h4>@{{ (user !== null) ? user.handle : "Gebruikersnaam" }}</h4>
            <h2>{{ post.title }}</h2>
            <p>{{ post.description }}</p>
        </div>
    </div>
</template>

<script setup>
import Tyler from "../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
</script>

<style lang="scss" scoped>
.item {
    display: flex;
    width: 100%;
    gap: 10px;
    padding-bottom: 10px;

    &__left {
        width: 20%;

        &--image {
            height: 50px;
            width: 50px;
            border-radius: 100%;
            object-fit: cover;
        }
    }

    &__right {
        h4 {

        }

        h2 {

        }

        p {
            width: 80%;
            display: -webkit-inline-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
}
</style>

<script>
export default {
    name: "SideBarTopPostsItem",
    props: {
        user: {
            default: null,
        },
        post: {
            default: null,
        }
    }
}
</script>
