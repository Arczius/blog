<template>
    <div class="login__holder">
        <img class="login__background-image" :src="LoginImage" alt="">
        <LoginForm/>
    </div>
</template>

<style scoped>
</style>

<script setup>
import LoginForm from './components/LoginForm.vue';
import LoginImage from '../../../assets/writing.png';
</script>

<script>
export default {
    name: "Index",
}
</script>
