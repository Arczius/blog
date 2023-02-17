<template>
    <Header/>
    <router-link to="/" exact>home</router-link>
    <router-link to="/about">about</router-link>
    <router-view></router-view>
    <Footer/>
</template>


<script setup>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
</script>

<script>
export default {
    name: "app"
}
</script>
