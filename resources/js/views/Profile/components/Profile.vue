<template>
    <div class="profile">
        <div class="profile__picture">
            <img class="profile__picture profile__picture--image" :src="ProfilePicture">
        </div>

        <div class="profile__user">
            <p class="profile__user profile__user--name">Tyler</p>
            <p class="profile__user profile__user--username">@Gebruikersnaam</p>
            <p class="profile__user profile__user--description">Dit is een korte omschrijving die op het profiel komt te staan. Lorem ipsum dolor sit amet, consecteur adipiscing elit, aenean.</p>
            
            <button class="profile__user profile__user__button profile__user__button--followers">10.504 volgers</button>
            <button class="profile__user profile__user__button profile__user__button--following">127 volgend</button>
        </div>
    </div>
</template>

<script setup>
    import ProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
</script>

<script>
export default {
    name: "Profile",
}
</script>
