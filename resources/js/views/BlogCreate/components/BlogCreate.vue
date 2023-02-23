<template>
    <div class="create__holder">
        <div class="create__form">
            <div>
                <img class="create__image" :src="ProfilePicture">
            </div>

            <router-link :to="{ name: 'store'}">
                <div class="create__input">
                    Maak een blog
                </div>
            </router-link>
        </div>
    </div>
</template>

<script setup>
    import ProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
</script>

<script>
    export default {
        name: "BlogCreate",

        data() {
            return {
            }
        },

        methods: {

        },
    }
</script>
