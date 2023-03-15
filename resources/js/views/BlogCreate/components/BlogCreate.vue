<template>
    <div class="create__holder">
        <div class="create__form">
            <div v-if="this.$route.path == '/home'">
                <img :src="userIcon" class="create__image" alt="user icon">
            </div>
            
            <div v-else>
                <img class="create__image--profile" :src="defaultPicture">
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
    import defaultPicture from '../../../../assets/writing.png'
</script>

<script>
    export default {
        name: "BlogCreate",
        props: {
            userIcon: {
                default: null,
            }
        },
    }
</script>
