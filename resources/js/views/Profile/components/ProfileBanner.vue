<template>
    <div class="profile__banner">
        <img class="profile__banner profile__banner--image" :src="bannerImage">
    </div>
</template>

<script setup>
import BannerPicture from '../../../../assets/luca-bravo-O453M2Liufs-unsplash.jpg'
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