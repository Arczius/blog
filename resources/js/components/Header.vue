<template>
    <header class="header">
        <div class="header__inner">
            <div class="header__left">
                <img :src="logo" class="header__left--image"> Blog.
            </div>
            <div class="header__right">
                <router-link to="/home">Home</router-link>
                <router-link to="/explore">Ontdek</router-link>
                <router-link to="/following">Volgend</router-link>
                <router-link to="/categories">Categorieen</router-link>
                <router-link to="/posts/top">Top posts</router-link>


                <img :src="user_image" alt="">
            </div>
        </div>
    </header>
</template>

<style scoped>
</style>

<script setup>
import logo from "../../assets/writing-wit.png"
import defaultUserIcon from "../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
</script>

<script>
export default {
    data(){
        return {
            'user_image': null
        }
    },
    methods: {
        setUserIcon(){
            const route = this.$route.path
            if(route === "/" || "/register"){
                this.user_image = defaultUserIcon
            }
            else{
                this.user_image = () => import('../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg')
            }
        },
    },
    mounted(){
        this.setUserIcon()
    }
}
</script>
