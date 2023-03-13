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

                <router-link to="/profile">
                    <img :src="userIcon" alt="">
                </router-link>
            </div>
        </div>
    </header>
</template>

<style scoped>
</style>

<script setup>
import logo from "../../assets/writing-wit.png"
</script>

<script>
export default {
    name: "Header",
    props: {
        userIcon: {
            default: null,
        }
    },
}
</script>
