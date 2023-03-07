<template>
    <div class="create__holder">
        <div class="create__form">
            <div v-if="this.$route.path == '/home'">
                <img class="create__image" :src="DefaultProfilePicture">
            </div>

            <div v-else>
                <img class="create__image--profile" :src="DefaultPicture">
            </div>

            <router-link :to="{name: 'store'}">
                <div class="create__input">
                    Maak een blog
                </div>
            </router-link>
        </div>
    </div>
</template>

<script setup>
    import DefaultProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import DefaultPicture from '../../../../assets/writing.png'
</script>

<script>
    export default {
        name: "BlogCreate",
        props: {
            'createImage': {
                default: DefaultPicture,
            }
        }
    }
</script>
