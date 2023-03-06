<template>
    <div class="profile">
        <div class="profile__picture">
            <img class="profile__picture profile__picture--image" :src="(users.profile_picture !== '') ? '../../storage/ProfilePictures/' + users.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
        </div>

        <div class="profile__user">
            <p class="profile__user profile__user--name">{{users.username}}</p>
            <p class="profile__user profile__user--username">@{{users.handle}}</p>
            <p class="profile__user profile__user--description">{{users.about_me}}</p>
            
            <button class="profile__user profile__user__button profile__user__button--followers">{{users.followers}} volgers</button>
            <button class="profile__user profile__user__button profile__user__button--following">{{users.following}} volgend</button>
        </div>
    </div>
</template>

<script setup>
    import defaultProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
</script>

<script>
    export default {
        name: "Profile",
        props: [
            "users",
        ],
    }
</script>
