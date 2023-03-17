<template>
    <header class="header">
        <div class="header__inner">
            <div class="header__left">
                <img :src="logo" class="header__left--image"> <strong>Blog.</strong>
            </div>
            <div class="header__right">
                <router-link to="/home">Home</router-link>
                <router-link to="/explore">Ontdek</router-link>
                <router-link to="/following">Volgend</router-link>
                <router-link to="/categories">Categorieën</router-link>
                <router-link to="/posts/top">Top posts</router-link>
                <router-link to="/user/edit">Wijzig profiel</router-link>

                <span v-if="userID" @click="logout()" class="logout">Uitloggen</span>
                <!-- getting you to your own profile when you click on your profile picture, if you're logged in -->
                <img v-if="!userID" :src="userIcon" alt="default user icon">
                <router-link v-else :to="'/profile/user/' + userID">
                    <img :src="userIcon" alt="user icon">
                </router-link>
            </div>
        </div>
    </header>
</template>

<script setup>
    import logo from "../../assets/writing-wit.png"
</script>

<script>
    export default {
        name: "Header",
        props: {
            userIcon: {
                default: null,
            },
            
            userID: {
                default: null,
            }
        },
        methods: {
            logout(){
                localStorage.clear()
                this.$router.push("/")
                location.reload()
            }
        }
    }
</script>
