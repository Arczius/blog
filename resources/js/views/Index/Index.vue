<template>
    <div class="login__holder">
        <img class="login__background-image" :src="(Math.floor(Math.random() * 5) === 3 ) ? tyler : loginImage" alt="">
        <loginForm/>
    </div>
</template>

<style scoped>
</style>

<script setup>
    import loginForm from './components/LoginForm.vue';
    import tyler from '../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import loginImage from '../../../assets/writing.png';
</script>

<script>
    export default {
        name: "Index",
    }
</script>
