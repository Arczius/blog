<template>
    <div class="profile__banner">
        <img class="profile__banner profile__banner--image" :src="(users.profile_header !== '') ? '../../storage/ProfileBanners/' + users.profile_header : BannerPicture" alt="profileBanner" loading="lazy">
    </div>
</template>

<script setup>
    import BannerPicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
</script>

<script>
    export default {
        name: "ProfileBanner",
        props: [
            "users",
        ],
    }
</script>