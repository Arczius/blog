<template>
    <div class="item">
        <div class="item__left">
            <img class="item__left--image" :src="(user !== null && user.profile_picture !== null) ? user.profile_picture : Tyler" alt="">
        </div>
        <div class="item__right">
            <h5 class="item__right--username">@{{ (user !== null) ? user.handle : "Gebruikersnaam" }}</h5>
            <h2 class="item__right--title">{{ post.title }}</h2>
            <p class="item__right--description">{{ post.description }}</p>
        </div>
    </div>
</template>

<script setup>
import Tyler from "../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
</script>

<style lang="scss" scoped>
//.item {
//    display: flex;
//    width: 100%;
//    gap: 10px;
//    padding-bottom: 10px;
//
//    &__left {
//        width: 20%;
//
//        &--image {
//            height: 50px;
//            width: 50px;
//            border-radius: 100%;
//            object-fit: cover;
//        }
//    }
//
//    &__right {
//        flex-grow: 1;
//        h5 {
//            color: blue;
//        }
//
//        h2 {
//            color: blue;
//        }
//
//        p {
//            color: gray;
//            width: 80%;
//            display: -webkit-inline-box;
//            -webkit-box-orient: vertical;
//            -webkit-line-clamp: 3;
//            overflow: hidden;
//            text-overflow: ellipsis;
//        }
//    }
//}
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
