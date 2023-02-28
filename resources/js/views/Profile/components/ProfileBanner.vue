<template>
    <div class="profile__banner">
        <img class="profile__banner profile__banner--image" :src="bannerImage">
    </div>
</template>

<script setup>
import BannerPicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
</script>

<script>
export default {
    name: "ProfileBanner",
    props: {
        'bannerImage': {
            default: BannerPicture,
        }
    }
}
</script>